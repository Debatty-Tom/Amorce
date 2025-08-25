<div>
    <h2 class="text-3xl font-bold mb-5 text-indigo-400">
        {{ __('amorce.misc-create-new-draw') }}
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

        <div
            class="flex items-center gap-4 mt-2">
            <input
                type="range"
                min="0"
                max="{{ $this->rangeMax }}"
                step="0.01"
                class="w-full"
                wire:model.blur="form.amount"
            />

            <input
                type="number"
                step="0.01"
                min="0"
                :max="{{ $this->rangeMax }}"
                class="border p-2 rounded w-24"
                wire:model.blur="form.amount"
            />
            @error('form.amount')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
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
        <div class="flex justify-between">
            <p class="pb-8 pr-6 w-full lg:w-1/2">
                {{ __('amorce.draw-next-participants') . ' :' }}
            </p>
            <ul class="grid grid-cols-3 gap-5">
                @foreach($this->form->new_participants as $participant)
                    <li wire:key="{{ $participant->id }}"
                        class="bg-slate-100 shadow-md rounded-lg p-6 flex flex-col justify-between items-start">
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $participant->name }}
                        </p>
                    </li>
                @endforeach
            </ul>
            @if($this->randomButton)
                <button wire:click.prevent="addNewParticipants"
                        class="flex items-center btn-indigo ml-auto">
                    {{ __('amorce.draw-start-random') }}
                </button>
            @endif
        </div>
        <p>
            {{ __('amorce.draw-select-projects') }}
        </p>
        <ul class="grid grid-cols-3 gap-5">
            @foreach ($projects as $project)
                <li class="w-full bg-slate-100 shadow-md rounded-lg flex flex-col justify-between items-start"
                    wire:key="{{ $project->id }}">
                    <div class="flex items-center gap-4">
                        <input id="{{ $project->id }}"
                               type="checkbox"
                               name="projects[]"
                               wire:model="selectedProjects"
                               class="h-4 w-4 ml-6 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                               value="{{ $project->id }}">
                        <label for="{{ $project->id }}"
                               class="w-full pt-6 pb-6 pr-6 text-lg font-semibold text-gray-800">{{ $project->title }}</label>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="flex justify-end">
            <button
                class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                {{ __('amorce.draw-create') }}
            </button>
        </div>
    </form>
</div>

