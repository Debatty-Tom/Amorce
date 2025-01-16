<div x-data="{user_name:$wire.form.name}">
    <h2 class="text-3xl font-bold mb-5">
        <a class="text-indigo-400 hover:text-indigo-600"
           href="{{ route('accounting.index') }}" wire:navigate>{{ __('Create a new Draw') }}
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
            <x-input-label for="amount" value="{{ __('Amount') }}"/>
            <x-text-input
                id="amount"
                type="number"
                step="0.01"
                wire:model.blur="form.amount"
            />
            @error('form.amount')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
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
        <div class="flex justify-between">
            <p class="pb-8 pr-6 w-full lg:w-1/2">
                {{ __("The 3 nex participants") }}
            </p>
            @if(count($this->form->new_participants) === 0)
                <button wire:click.prevent="randomParticipants"
                        class="flex items-center btn-indigo ml-auto">
                    {{ __("Start random") }}
                </button>
            @endif

        </div>
        <ul class="grid grid-cols-3">
            @if(count($this->form->new_participants) > 0)
                @foreach($this->form->new_participants as $participant)
                    <li wire:key="{{ $participant->id }}">
                        <p>
                            {{ $participant->name }}
                        </p>
                    </li>
                @endforeach
            @endif
        </ul>
        <div class="flex justify-end">
            <button
                class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                {{ __("Create a Draw") }}
            </button>
        </div>
    </form>
</div>

