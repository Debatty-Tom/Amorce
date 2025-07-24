<?php

namespace App\Traits;

trait DeleteModalTrait
{
    public $showDeleteModal = false;
    public function confirmDelete()
    {
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
    }
}
