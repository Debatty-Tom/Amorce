<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\TeamForm;
use App\Models\User;
use App\Traits\handlesImagesUpload;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TeamCreate extends Component
{
    use WithFileUploads, handlesImagesUpload;
    public $feedback = '';
    public TeamForm $form;

    public function save(){
        $this->validate();
        $data = $this->form->all();
        if ($this->form->image) {
            $data['picture_path'] = Storage::disk('public')
                ->put('images/users', $data['image']);
        }
        User::create($data);
        $this->feedback='Team member created successfully';

        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.modals.team-create');
    }
}
