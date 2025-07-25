<div x-data="{user_name:$wire.form.name}">
    <h2 class="text-3xl font-bold mb-5">
        <a class="text-indigo-400 hover:text-indigo-600"
           href="{{ route('projects.index') }}" wire:navigate>{{ __('Edit this project') }}
        </a>
    </h2>
    <form wire:submit.prevent="save" enctype="multipart/form-data"
          class="flex flex-col gap-3">
        <div class="flex gap-2 flex-col">
            <x-input-label for="title" value="{{ __('Title') }}"/>
            <x-text-input
                id="title"
                type="text"
                wire:model.blur="form.title"
            />
            @error('form.title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="description" value="{{ __('Description') }}"/>
            <x-text-input
                id="description"
                type="text"
                wire:model.blur="form.description"
            />
            @error('form.description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
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
        <div class="flex justify-end gap-4">
            <x-delete-button click="confirmDelete">
            </x-delete-button>
            <button
                class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                {{ __("Edit this project") }}
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
                    <x-confirm-delete-button click="deleteProject"></x-confirm-delete-button>
                </div>
            </div>
        </div>
    @endif
</div>

