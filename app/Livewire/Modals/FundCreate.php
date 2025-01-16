<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\FundForm;
use App\Models\Fund;
use Livewire\Component;

class FundCreate extends Component
{
    public $feedback = '';
    public FundForm $form;
    public $loading;
    public Fund $fund;

    public function mount(Fund $fund)
    {
        $this->form->setFund($fund);

        $this->fund = $fund;
    }
    public function save(){
        $this->form->create();
        $this->feedback='Fund created successfully';

        $this->dispatch('closeModal');

        $this->redirect(route('accounting.index'), navigate: true);
    }
    public function render()
    {
        return view('livewire.modals.fund-create');
    }
}
