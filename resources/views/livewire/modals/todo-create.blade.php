<section x-data="{user_name:$wire.form.name}">
    <h2 class="text-3xl font-bold mb-5 text-indigo-400">
        {{ __('amorce.misc-create-new-todo') }}
    </h2>
    <form wire:submit.prevent="save" enctype="multipart/form-data"
          class="flex flex-col gap-3">
        <div class="flex gap-2 flex-col">
            <x-input-label for="title" value="{{ __('amorce.form-title') }}"/>
            <x-text-input
                id="title"
                type="text"
                wire:model.blur="form.title"
            />
            @error('form.title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="description" value="{{ __('amorce.form-description') }}"/>
            <x-text-area
                id="description"
                rows="4"
                wire:model.blur="form.description"
            ></x-text-area>
            @error('form.description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <x-input-label for="date" value="{{ __('amorce.form-date') }}"/>
            <x-text-input
                id="date"
                type="date"
                wire:model.blur="form.date"
            />
            @error('form.date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <p>
            {{ __('amorce.todo-select-members') }}
        </p>
        <div class="grid grid-cols-3">
            @foreach($users as $user)
                <div class="w-96 flex justify-between items-center">
                    <div>
                        <input id="{{ $user->id }}"
                               type="checkbox"
                               name="users[]"
                               wire:model="selectedUsers"
                               class="h-4 w-4"
                               value="{{ $user->id }}">
                        <label for="{{ $user->id }}">{{ $user->name }}</label>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-end">
            <button
                class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                {{ __('amorce.todo-create') }}
            </button>
        </div>
    </form>
</section>

