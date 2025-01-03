<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DrawForm;
use App\Models\Donator;
use App\Models\Draw;
use Livewire\Component;
use function Pest\Laravel\get;

class DrawCreate extends Component
{
    public $feedback = '';
    public DrawForm $form;
    public $loading;
    public Draw $draw;
    public string $test;

    public function mount(Draw $draw)
    {
        $this->form->setDraw($draw);
        $this->draw = $draw;
    }
    public function normalizeNumber($input) {
        if (strpos($input, '.') !== false) {
            return str_replace('.', '', $input);
        } else {
            return $input * 100;
        }
    }

    public function save(){
        $this->form->amount = $this->normalizeNumber($this->form->amount);
        $this->draw = $this->form->create();
        $this->feedback='Draw created successfully';
        foreach ($this->form->new_participants as $participant) {
            $participantContact = $this->getdonatorContact($participant);
            $this->draw->donators()->attach($participant, ['contact' => $participantContact, 'status' => 'pending']);
        }

        $this->dispatch('closeModal');
    }
    public function getdonatorContact($participant): string
    {
        if($participant->email === null) {
            if ($participant->phone === null) {
                return $participant->address;
            } else {
                return $participant->phone;
            }
        }
        return $participant->email;
    }
    public function randomParticipants()
    {
        $this->form->new_participants = Donator::inRandomOrder()->limit(3)->get();
    }
    public function render()
    {
        return view('livewire.modals.draw-create');
    }
}
