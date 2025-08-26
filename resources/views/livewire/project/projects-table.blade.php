<section class="space-y-12">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">{{ __('amorce.page-projects') }}</h2>
        @hasanyrole(\App\Enums\RolesEnum::PROJECTMANAGER->value.'|'.
                    \App\Enums\RolesEnum::ADMIN->value)
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                wire:click.prevent="$dispatch('openModal',{component: 'modals.project-create'})">{{ __('amorce.create-project') }}</button>
        @endhasanyrole
    </div>
    <section class="space-y-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h3 class="text-2xl font-semibold text-gray-700">{{ __('amorce.project-pending') }}</h3>
            <div>
                <x-search-field>
                    searches.pending
                </x-search-field>
                @foreach($this->categories as $key => $label)
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
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($this->pendingProjects as $project)
                <livewire:project.project-table :project="$project" wire:key="pending-{{ $project->id }}">
                </livewire:project.project-table>
            @endforeach
        </ul>
        {{ $this->pendingProjects->links(data: ['scrollTo' => false]) }}
    </section>
    <section class="space-y-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h3 class="text-2xl font-semibold text-gray-700">{{__('amorce.project-next-draw')}}</h3>
            <div>
                <x-search-field>
                    searches.next
                </x-search-field>
                @foreach($this->categories as $key => $label)
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
                <livewire:project.project-table :project="$project" wire:key="next-{{ $project->id }}">
                </livewire:project.project-table>
            @endforeach
        </ul>
        {{ $this->nextDrawProjects->links(data: ['scrollTo' => false]) }}
    </section>
    <section class="space-y-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h3 class="text-2xl font-semibold text-gray-700">{{__('amorce.project-funded')}}</h3>
            <div>
                <x-search-field>
                    searches.funded
                </x-search-field>
                @foreach($this->categories as $key => $label)
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
                <livewire:project.project-table :project="$project" wire:key="funded-{{ $project->id }}">
                </livewire:project.project-table>
            @endforeach
        </ul>
        {{ $this->fundedProjects->links(data: ['scrollTo' => false]) }}
    </section>
</section>
