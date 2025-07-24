<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\FundForm;
use App\Models\Fund;
use App\Traits\DeleteModalTrait;
use Livewire\Component;

class FundEdit extends Component
{
    use DeleteModalTrait;
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
        $this->form->update();
        $this->feedback = 'Fund updated successfully';

        $this->dispatch('closeModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
        $this->dispatch('refresh-fund');
    }

    public function deleteFund()
    {
        $this->fund->delete();

        $this->feedback='Fund deleted successfully';

        $this->dispatch('refresh-funds');
        $this->showDeleteModal = false;
        $this->dispatch('closeModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
    }
    public function render()
    {
        return view('livewire.modals.fund-edit');
    }
}
