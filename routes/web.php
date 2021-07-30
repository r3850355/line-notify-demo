<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Libs\LineNotify;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class, 'getIndex']);

// LINE LOGIN

Route::get('/auth/redirect', function () {
  return Socialite::driver('line')->redirect();
});

Route::get('/auth/callback', function () {
  $user = Socialite::driver('line')->user();
  $account = User::where('line_user_id', $user->id)->first();
  if (!$account) {
    $account = User::create([
      'line_user_id' => $user->id,
      'line_user_name' => $user->name
    ]);
  }
  Auth::login($account);
  return redirect()->to('/');
});

// LINE NOTIFY

Route::get('/auth/notify_redirect', function () {
  return LineNotify::redirect();
});

Route::post('/auth/notify_callback', function (Request $request) {
  return LineNotify::regirest($request->all());
});