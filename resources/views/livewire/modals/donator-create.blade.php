<div x-data="{user_name:$wire.form.name}">
    <h2 class="text-3xl font-bold mb-5">
        <a class="text-indigo-400 hover:text-indigo-600"
           href="{{ route('mailing.index') }}" wire:navigate>{{ __('Create a new Donator') }}
        </a>
    </h2>
    <form wire:submit.prevent="save" enctype="multipart/form-data"
          class="flex flex-col gap-3">
        <div class="flex gap-2 flex-col">
            <x-input-label for="name" value="{{ __('Name') }}"/>
            <x-text-input
                id="name"
                type="text"
                wire:model.blur="form.name"
            />
            @error('form.name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="email" value="{{ __('Email') }}"/>
            <x-text-input
                id="email"
                type="email"
                wire:model.blur="form.email"
            />
            @error('form.email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div>
            <x-input-label for="phone" value="{{ __('Phone') }}"/>
            <x-text-input
                id="phone"
                type="tel"
                wire:model.blur="form.phone"
            />
            @error('form.phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div>
            <x-input-label for="address" value="{{ __('Address') }}"/>
            <x-text-input
                id="address"
                type="text"
                wire:model.blur="form.address"
            />
            @error('form.address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div class="flex justify-end">
            <button
                class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                {{ __("Create a Donator") }}
            </button>
        </div>
    </form>
</div>
