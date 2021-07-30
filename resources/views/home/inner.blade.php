<div class="ui main text container">
  <h1 class="ui header">Step 1. 登入 LINE</h1>
  <p>請點選下方按鈕登入</p>
  @if(!$user)
  <button class="ui button" onClick="window.location='{{ url("auth/redirect") }}'">登入</button>
  @else
  <button class="ui disabled button">已經登入</button>
  @endif
</div>

<div class="ui main text container">
  <h1 class="ui header">Step 2. 綁定 Line Notify</h1>
  <p>請點選下方按鈕綁定</p>
  <button class="ui button" onClick="window.location='{{ url("auth/notify_redirect") }}'">點我綁定</button>
</div>

<div class="ui main text container">
  <h1 class="ui header">Step 3. 發送 Notify 訊息</h1>
  <p>請點選下方按鈕發送</p>
  <button class="ui button">發送測試訊息</button>
  <button class="ui button">發送現在日期</button>
  <button class="ui button">發送現在時間</button>
</div>
