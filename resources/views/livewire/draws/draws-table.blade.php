<section class="space-y-12">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold text-gray-800">{{ __('amorce.draws') }}</h2>
        @hasanyrole(\App\Enums\RolesEnum::DRAWMANAGER->value.'|'.
                        \App\Enums\RolesEnum::ADMIN->value)
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                wire:click.prevent="$dispatch('openModal',{component: 'modals.draw-create'})">{{ __('amorce.create-draw') }}</button>
        @endhasanyrole
    </div>
    <div class="space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h3 class="text-2xl font-semibold text-gray-700">
                {{ __('amorce.draw-waiting') }}
            </h3>
            <div class="flex flex-wrap gap-3">
                <x-search-field>
                    searches.pending
                </x-search-field>
                @foreach ($this->categories as $key => $label)
                    <button wire:click="toggleSort('pending', '{{ $key }}', 'refresh-draws')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ $label }}
                        @if ($sorts['pending']['field'] === $key)
                            {{ $sorts['pending']['direction'] === 'desc' ? '▼' : '▲' }}
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
        <ul class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($this->pendingDraws as $draw)
                <livewire:draws.draws-list :draw="$draw" wire:key="pending-{{$draw->id}}">
                </livewire:draws.draws-list>
            @endforeach
        </ul>
        {{ $this->pendingDraws->links(data: ['scrollTo' => false]) }}
    </div>
    <div class="space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h3 class="text-2xl font-semibold text-gray-700">
                {{ __('amorce.page-draws-archived') }}
            </h3>
            <div class="flex flex-wrap gap-3">
                <x-search-field>
                    searches.archived
                </x-search-field>
                @foreach ($this->categories as $key => $label)
                    <button wire:click="toggleSort('archived', '{{ $key }}', 'refresh-draws')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ $label }}
                        @if ($sorts['archived']['field'] === $key)
                            {{ $sorts['archived']['direction'] === 'desc' ? '▼' : '▲' }}
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
        @if($this->archivedDraws->isNotEmpty())
            <ul class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($this->archivedDraws as $draw)
                    <livewire:draws.draws-list :draw="$draw" wire:key="archived-{{$draw->id}}">
                    </livewire:draws.draws-list>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 text-center italic mt-8">
                {{ __('amorce.draw-archived-none') }}
            </p>
        @endif
        {{ $this->archivedDraws->links(data: ['scrollTo' => false]) }}
    </div>
    <div class="mt-10">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-2xl text-gray-800">
                {{ __('amorce.draw-members') }}
            </h1>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                {{ __('amorce.create-donator') }}
            </button>
        </div>
    </div>
</section>
