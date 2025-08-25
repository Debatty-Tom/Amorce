<div>
    <h2 class="text-3xl font-bold mb-5 text-indigo-400">
        {{ __('amorce.misc-edit-profile') }}
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
                {{ __('amorce.misc-edit-profile') }}
            </button>
        </div>
    </form>
    @if($showDeleteModal)
        <div
            x-data
            x-on:keydown.escape.window="$wire.set('showDeleteModal', false)"
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50"
            x-on:click.self="$wire.set('showDeleteModal', false)">
            <div class="bg-white p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4">{{ __('amorce.delete-confirm') }}</h2>
                <p>{{ __('amorce.delete-profile') }}</p>
                <div class="mt-6 flex justify-end gap-3">
                    <x-cancel-button click="cancelDelete"></x-cancel-button>
                    <x-confirm-delete-button click="deleteProfile"></x-confirm-delete-button>
                </div>
            </div>
        </div>
    @endif
</div>

