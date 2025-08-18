<section>
    <div class="flex justify-between mb-5">
        <h2 class="text-3xl">{{__('amorce.page-projects')}}</h2>
        @hasanyrole(\App\Enums\RolesEnum::PROJECTMANAGER->value.'|'.
                    \App\Enums\RolesEnum::ADMIN->value)
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                wire:click.prevent="$dispatch('openModal',{component: 'modals.project-create'})">{{ __('amorce.create-project') }}</button>
        @endhasanyrole
    </div>
    <div class="mb-4 flex flex-col gap-3">
        <div class="flex flex-row gap-10">
            <h3 class="text-2xl pb-3">
                {{ __('amorce.project-pending') }}
            </h3>
            <div>
                <input type="text" wire:model.live.debounce.100ms="searches.pending"
                       placeholder="Rechercher un Nom"
                       class="border rounded px-3 py-2 w-full md:w-auto">
                @foreach ($this->categories as $key => $label)
                    <button wire:click="toggleSort('pending', '{{ $key }}', 'refresh-projects')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ $label }}
                        @if ($sorts['pending']['field'] === $key)
                            {{ $sorts['pending']['direction'] === 'desc' ? '▼' : '▲' }}
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
        <ul class="grid grid-cols-4 gap-4 w-full">
            @foreach($this->pendingProjects as $project)
                <li class="flex justify-center">
                    <div class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3">
                        <a href="#" class="inset-0 absolute z-10" x-data="{ model: @js($project) }"
                           wire:click.prevent="$dispatch('openCardModal',{component: 'modals.project-show', params: { project: { id: {{ $project->id }} } }})">
                            <span class="sr-only">{{ __('amorce.project-see') }}</span>
                        </a>
                        <p class="text-center text-[#202224] text-lg font-bold">{{ $project->title }}</p>
                        <p>
                            {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $this->pendingProjects->links(data: ['scrollTo' => false]) }}
    </div>
    <div class="pt-4 mb-4 flex flex-col gap-3">
        <div class="flex flex-row gap-10">
            <h3 class="text-2xl pb-3">
                {{__('amorce.project-next-draw')}}
            </h3>
            <div>
                <input type="text" wire:model.live.debounce.100ms="searches.next"
                       placeholder="Rechercher un Nom"
                       class="border rounded px-3 py-2 w-full md:w-auto">
                @foreach ($this->categories as $key => $label)
                    <button wire:click="toggleSort('next', '{{ $key }}', 'refresh-projects')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ $label }}
                        @if ($sorts['next']['field'] === $key)
                            {{ $sorts['next']['direction'] === 'desc' ? '▼' : '▲' }}
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
        <ul class="grid grid-cols-4 gap-4 w-full">
            @foreach($this->nextDrawProjects as $project)
                <li class="flex justify-center">
                    <div class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3">
                        <a href="#" class="inset-0 absolute z-10" x-data="{ model: @js($project) }"
                           wire:click.prevent="$dispatch('openCardModal',{component: 'modals.project-show', params: { project: { id: {{ $project->id }} } }})">
                            <span class="sr-only">{{ __('amorce.project-see') }}</span>
                        </a>
                        <p class="text-center text-[#202224] text-lg font-bold">{{ $project->title }}</p>
                        <p>
                            {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $this->nextDrawProjects->links(data: ['scrollTo' => false]) }}
    </div>
    <div class="pt-4 mb-4 flex flex-col gap-3">
        <div class="flex flex-row gap-10">
            <h3 class="text-2xl">
                {{__('amorce.project-funded')}}
            </h3>
            <div>
                <input type="text" wire:model.live.debounce.100ms="searches.funded"
                       placeholder="Rechercher un Nom"
                       class="border rounded px-3 py-2 w-full md:w-auto">
                @foreach ($this->categories as $key => $label)
                    <button wire:click="toggleSort('funded', '{{ $key }}', 'refresh-projects')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ $label }}
                        @if ($sorts['funded']['field'] === $key)
                            {{ $sorts['funded']['direction'] === 'desc' ? '▼' : '▲' }}
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
        <ul class="grid grid-cols-4 gap-4 w-full">
            @foreach($this->fundedProjects as $project)
                <li class="flex justify-center">
                    <div class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3">
                        <a href="#" class="inset-0 absolute z-10" x-data="{ model: @js($project) }"
                           wire:click.prevent="$dispatch('openCardModal',{component: 'modals.project-show', params: { project: { id: {{ $project->id }} } }})">
                            <span class="sr-only">{{ __('amorce.project-see') }}</span>
                        </a>
                        <p class="text-center text-[#202224] text-lg font-bold">{{ $project->title }}</p>
                        <p>
                            {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $this->fundedProjects->links(data: ['scrollTo' => false]) }}
    </div>
</section>
