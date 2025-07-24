<div x-data="{user_name:$wire.form.name}">
    <h2 class="text-3xl font-bold mb-5">
        <a class="text-indigo-400 hover:text-indigo-600"
           href="{{ route('team.index') }}" wire:navigate>{{ __('Edit a team member') }}
        </a>
    </h2>
    <form wire:submit.prevent="save" enctype="multipart/form-data"
          class="flex flex-col gap-3">
        <div class="flex gap-2 flex-col">
            <x-input-label for="name" value="Nom"/>
            <x-text-input
                id="name"
                type="text"
                placeholder="John Doe"
                wire:model.blur="form.name"
            />
            @error('form.name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="email" value="Email"/>
            <x-text-input
                id="email"
                type="email"
                placeholder="johndoe@example.be"
                wire:model.blur="form.email"
            />
            @error('form.email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div>
            <x-input-label for="password" value="Mot de passe"/>
            <x-text-input
                id="password"
                type="password"
                wire:model.blur="form.password"
            />
            @error('form.password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div>
            <x-input-label for="image" value="Photo de profil"/>
            <input
                id="image"
                type="file"
                wire:model="form.image"
                class="rounded"
            />
            @error('form.image')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div class="flex justify-end gap-4">
            <x-delete-button click="confirmDelete">
            </x-delete-button>
            <button
                class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                {{ __("Edit Team member") }}
            </button>
        </div>
    </form>
    @if($showDeleteModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div class="bg-white p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4">Confirmer la suppression</h2>
                <p>Êtes-vous sûr de vouloir supprimer ce fond ? Cette action est irréversible.</p>
                <div class="mt-6 flex justify-end gap-3">
                    <x-cancel-button click="cancelDelete"></x-cancel-button>
                    <x-confirm-delete-button click="deleteTeam"></x-confirm-delete-button>
                </div>
            </div>
        </div>
    @endif
</div>

