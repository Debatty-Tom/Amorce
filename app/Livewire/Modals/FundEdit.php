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
            abort(403, 'Vous n’avez pas la permission d’ajouter ou modifier des membres.');
        }
        $this->form->update();
        $this->feedback = 'Fund updated successfully';

        $this->dispatch('closeModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
        $this->dispatch('refresh-fund');
    }
    public function render()
    {
        return view('livewire.modals.fund-edit');
    }
}
