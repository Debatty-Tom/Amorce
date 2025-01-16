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
                {{ __("The 3 next participants :") }}
            </p>
            @if(count($this->form->new_participants) === 0)
                <button wire:click.prevent="randomParticipants"
                        class="flex items-center btn-indigo ml-auto">
                    {{ __("Start random") }}
                </button>
            @endif
            <ul class="grid grid-cols-3 gap-5">
                @if(count($this->form->new_participants) > 0)
                    @foreach($this->form->new_participants as $participant)
                        <li wire:key="{{ $participant->id }}" class="bg-slate-100 shadow-md rounded-lg p-6 flex flex-col justify-between items-start">
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $participant->name }}
                            </p>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <p>
            {{ __("Select the projects you want in this draw") }}
        </p>
        <ul class="grid grid-cols-3 gap-5">
            @foreach ($projects as $project)
                <li class="w-full bg-slate-100 shadow-md rounded-lg flex flex-col justify-between items-start" wire:key="{{ $project->id }}">
                    <div class="flex items-center gap-4">
                        <input id="{{ $project->id }}"
                               type="checkbox"
                               name="{{ __("projects[]") }}"
                               wire:model="selectedProjects"
                               class="h-4 w-4 ml-6 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                               value="{{ $project->id }}">
                        <label for="{{ $project->id }}" class="w-full pt-6 pb-6 pr-6 text-lg font-semibold text-gray-800">{{ $project->title }}</label>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="flex justify-end">
            <button
                class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                {{ __("Create a Draw") }}
            </button>
        </div>
    </form>
</div>

