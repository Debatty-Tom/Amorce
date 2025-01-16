<?php

namespace App\Traits;

trait
ModalTrait
{
    public function openModal($componentName, $params = null)
    {
        $this->dispatch('open-modal',$componentName, $params);
    }

    public function closeModal($componentName)
    {
        $this->dispatch('close-modal', $componentName);
    }
}
