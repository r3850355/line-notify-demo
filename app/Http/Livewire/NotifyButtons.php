<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LineNotify;
use Auth;

class NotifyButtons extends Component
{
    public $inputText = null;

    public function pushTestMessage()
    {
        LineNotify::push(Auth::user()->line_notify_token, '這是測試訊息');
    }

    public function pushInputMessage()
    {
        if ($this->inputText) {
            LineNotify::push(Auth::user()->line_notify_token, $this->inputText);
        }
    }


    public function render()
    {
        return view('livewire.notify-buttons');
    }

}
