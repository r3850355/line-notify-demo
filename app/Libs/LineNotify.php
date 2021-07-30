<?php
    namespace App\Libs;
    use Illuminate\Support\Facades\Redirect;
    use App\Models\User;
    use Auth;

    class LineNotify {

        public static function push ($token, $msg) {
            if ($token && $msg) {
                // configs
                $url = 'https://notify-api.line.me/api/notify';
                $header = array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer '. $token
                );
                $body = array(
                    'message' => $msg
                );
                // curl
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
                $res = json_decode(curl_exec($ch), true);
                curl_close($ch);
            }
        }

        public static function redirect () {
            $user = Auth::user();
            if (!$user) {
                return false;
            }
            $url = 'https://notify-bot.line.me/oauth/authorize?response_type=code&scope=notify&response_mode=form_post&client_id='. env('LINE_NOTIFY_ID') .'&redirect_uri='. url(env('LINE_NOTIFY_REDIRECT_URI')) .'&state='. $user->line_user_id;
            return Redirect::to($url);
        }

        public static function regirest ($req) {
            // LINE NOTIFY
            $code = $req['code'];
            $state = $req['state'];
            if ($code && $state) {
                $user = User::where('line_user_id', $state)->first();
                if ($user) {
                    $getCodeBody = array(
                        'grant_type' => 'authorization_code',
                        'code' => $code,
                        'redirect_uri' => url('auth/notify_callback'),
                        'client_id' => env('LINE_NOTIFY_ID'),
                        'client_secret' => env('LINE_NOTIFY_SECRET')
                    );
                    // 拿 token
                    $url = 'https://notify-bot.line.me/oauth/token';
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($getCodeBody));
                    $res = json_decode(curl_exec($ch), true);
                    curl_close($ch);
                    //
                    if ($res['access_token']) {
                        $user->line_notify_token = $res['access_token'];
                        $user->save();
                        return redirect()->to('/');
                    }
                }
            }
        }

        public static function revoke ($token) {
            // CALL LINE REVOKE API
            $url = 'https://notify-api.line.me/api/revoke';
            $header = array (
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer '. $token
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $res = json_decode(curl_exec($ch), true);
            curl_close($ch);
        }
    }