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
  <p>若尚未綁定，請點選下方按鈕綁定</p>
  <p>已綁定若想要解除或是重新綁定，請先點選解除綁定按鈕</p>
  @if(!$user)
  <button class="ui button disabled">請先登入</button>
  @else
    @if(!$user->line_notify_token)
      <button class="ui button" onClick="window.location='{{ url("auth/notify_redirect") }}'">點我綁定</button>
    @else
      <button class="ui button" onClick="window.location='{{ url("auth/notify_revoke") }}'">解除綁定</button>
    @endif
  @endif
</div>

<div class="ui main text container" style="margin-bottom: 7em">
  <h1 class="ui header">Step 3. 發送 Notify 訊息</h1>
  <p>請點選下方按鈕發送</p>
  @if(!$user || !$user->line_notify_token)
    <button class="ui button disabled">需要先登入與綁定</button>
  @else
    <livewire:notify-buttons />
  @endif
</div>
