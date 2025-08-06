<?php

namespace App\Livewire\Layout;

use Livewire\Attributes\On;
use Livewire\Component;

class Toast extends Component
{
    public $message;
    public $type = 'valid';
    public $openAlert = false;

    #[on('openalert')]
    public function showAlert($params)
    {
        $this->message = $params['message'] ?? __('Alerte');
        $this->type = $params['type'] ?? 'valid';
        $this->openAlert = true;
    }

    public function render()
    {
        return view('livewire.layout.toast');
    }
}
