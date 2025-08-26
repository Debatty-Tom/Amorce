<section x-data="{user_name:$wire.form.name}">
    <h2 class="text-3xl font-bold mb-5 text-indigo-400">
        {{ __('amorce.team-edit') }}
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
        <div>
            <x-input-label for="role" value="Rôle de l'utilisateur"/>

            <select id="role"
                    wire:model.defer="form.role"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                <option value="">-- Choisir un rôle --</option>
                @foreach($this->roles as $role)
                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                @endforeach
            </select>

            @error('form.role')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        @if($this->user->trashed())
            <button
                wire:click="unarchiveUser"
                type="button"
                class="w-fit py-3 px-4 bg-red-500 text-white hover:bg-black hover:hover:bg-red-700 transition ease-in text-sm rounded-lg">
                {{ __('amorce.misc-unarchive-user') }}
            </button>
        @else
            <div class="flex justify-end gap-4">
                <x-delete-button click="confirmDelete">
                </x-delete-button>
                <button
                    class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                    {{ __('amorce.team-edit') }}
                </button>
            </div>
        @endif
    </form>
    @if($showDeleteModal)
        <div
            x-data
            x-on:keydown.escape.window="$wire.set('showDeleteModal', false)"
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50"
            x-on:click.self="$wire.set('showDeleteModal', false)">
            <div class="bg-white p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4">{{ __('amorce.delete-confirm') }}</h2>
                <p>{{ __('amorce.delete-user') }}</p>
                <div class="mt-6 flex justify-end gap-3">
                    <x-cancel-button click="cancelDelete"></x-cancel-button>
                    <x-confirm-delete-button click="deleteTeam"></x-confirm-delete-button>
                </div>
            </div>
        </div>
    @endif
</section>

