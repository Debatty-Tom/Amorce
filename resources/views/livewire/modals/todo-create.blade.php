<div x-data="{user_name:$wire.form.name}">
    <h2 class="text-3xl font-bold mb-5">
        <a class="text-indigo-400 hover:text-indigo-600"
           href="{{ route('todo.index') }}" wire:navigate>{{ __('Create a new todo') }}
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
            <x-input-label for="date" value="{{ __('Date') }}"/>
            <x-text-input
                id="date"
                type="date"
                wire:model.blur="form.date"
            />
            @error('form.date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <p>
            {{ __("Select the members you need to do the task") }}
        </p>
        <div class="grid grid-cols-3">
            @foreach ($users as $user)
                <div class="w-96 flex justify-between items-center">
                    <div>
                        <input id="{{ $user->id }}"
                               type="checkbox"
                               name="{{ __("users[]") }}"
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
                {{ __("Create Team member") }}
            </button>
        </div>
    </form>
</div>

