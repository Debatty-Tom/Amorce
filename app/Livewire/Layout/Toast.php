<?php

namespace App\Livewire\Layout;

use Livewire\Attributes\On;
use Livewire\Component;

class Toast extends Component
{
    public $message;
    public $openAlert = false;

    protected $listeners = ['openalert' => 'showAlert'];

    #[on('openalert')]
    public function showAlert($message)
    {
        $this->message = $message;
        $this->openAlert = true;
        dd($this->message);
    }

    public function render()
    {
        return view('livewire.layout.toast', ['message' => $this->message]);
    }
}
