<div>
  <button class="ui button" wire:click="pushTestMessage">發送測試訊息</button>
  <p style="margin-top: 15px">or</p>
  <div class="ui action input" >
    <input type="text" placeholder="輸入文字..." wire:model="inputText">
    <button class="ui button" wire:click="pushInputMessage">發送</button>
  </div>
</div>
