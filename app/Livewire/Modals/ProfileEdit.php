<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileEdit extends Component
{
    use WithFileUploads;

    public User $user;
    public $form = [
        'name' => '',
        'email' => '',
        'new_password' => '',
        'new_password_confirmation' => '',
        'image' => null,
    ];

    public function updateProfile()
    {
        $this->validate([
            'form.name' => 'required|string|max:255',
            'form.email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'form.new_password' => 'nullable|string|min:8',
            'form.image' => 'nullable|image|max:1024',
        ]);

        $user = Auth::user();

        $user->name = $this->form['name'];
        $user->email = $this->form['email'];

        if ($this->form['new_password']) {
            $user->password = Hash::make($this->form['new_password']);
        }

        if ($this->form['image']) {
            $path = $this->form['image']->store('profile-pictures', 'public');
            $user->picture_path = $path;
        }

        $user->save();
        $this->dispatch('refresh-profile');
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.modals.profile-edit');
    }
}
