<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\FundForm;
use App\Models\Fund;
use App\Traits\DeleteModalTrait;
use Livewire\Component;

class FundEdit extends Component
{
    public $feedback = '';
    public FundForm $form;
    public $fund;

    public function mount(Fund $fund)
    {
        $this->fund = $fund;
        $this->form->setFund($this->fund);
    }

    public function save()
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::ACCOUNTANT->value, RolesEnum::ADMIN->value)) {
            abort(403, __('amorce.message-permission-denied-edit-member') . '.');
        }
        if ($this->fund->id === 1) {
            abort(403, __('amorce.message-permission-denied-edit-fund') . '.');
        }
        $this->form->update();
        $this->feedback = __('amorce.message-toast-success-edit-fund');

        $this->dispatch('closeModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
        $this->dispatch('refresh-fund');
    }
    public function render()
    {
        return view('livewire.modals.fund-edit');
    }
}
