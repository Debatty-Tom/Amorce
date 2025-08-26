<section class="space-y-12">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold text-gray-800">{{ __('amorce.navigation-accounting') }}</h2>
        <div class="gap-5">
            @hasanyrole(\App\Enums\RolesEnum::ACCOUNTANT->value.'|'.
                        \App\Enums\RolesEnum::ADMIN->value)
            <a href="{{ route('csv.index') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('amorce.misc-import-csv') }}</a>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    wire:click.prevent="$dispatch('openModal',{component: 'modals.fund-create'})">{{ __('amorce.create-fund') }}</button>
            @endhasanyrole
        </div>
    </div>
    <div>
        <section class="mb-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <h3 class="text-2xl font-semibold text-gray-700">
                    {{ __('amorce.funds-principal') }}
                </h3>
                <div>
                    <x-search-field>
                        searches.principal
                    </x-search-field>
                    @foreach($this->categories as $key => $label)
                        <button wire:key="principal-button-{{ $key }}"
                                wire:click="toggleSort('principal', '{{ $key }}', 'refresh-funds')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ $label }}
                            @if ($sorts['principal']['field'] === $key)
                                {{ $sorts['principal']['direction'] === 'desc' ? '▼' : '▲' }}
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
            <ul class="grid gap-6 p-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($this->principalFunds as $fund)
                    <livewire:accounting.fund-card :fund="$fund" wire:key="principal-{{$fund->fund_id}}">
                    </livewire:accounting.fund-card>
                @endforeach
            </ul>
            {{ $this->principalFunds->links(data: ['scrollTo' => false]) }}
        </section>
        <section class="mb-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <h3 class="text-2xl font-semibold text-gray-700">
                    {{ __('amorce.funds-specific') }}
                </h3>
                <div>
                    <x-search-field>
                        searches.specific
                    </x-search-field>
                    @foreach($this->categories as $key => $label)
                        <button wire:key="specific-button-{{ $key }}"
                                wire:click="toggleSort('specific', '{{ $key }}', 'refresh-funds')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ $label }}
                            @if ($sorts['specific']['field'] === $key)
                                {{ $sorts['specific']['direction'] === 'desc' ? '▼' : '▲' }}
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
            <ul class="grid gap-6 p-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($this->specificFunds as $fund)
                    <livewire:accounting.fund-card :fund="$fund" wire:key="specific-{{$fund->fund_id}}">
                    </livewire:accounting.fund-card>
                @endforeach
            </ul>
            {{ $this->specificFunds->links(data: ['scrollTo' => false]) }}
        </section>

        <section class="mb-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <h3 class="text-2xl font-semibold text-gray-700">
                    {{ __('amorce.page-funds-archived') }}
                </h3>
                <div>
                    <x-search-field>
                        searches.archived
                    </x-search-field>
                    @foreach($this->categories as $key => $label)
                        <button wire:key="achived-button-{{ $key }}"
                                wire:click="toggleSort('archived', '{{ $key }}', 'refresh-funds')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ $label }}
                            @if ($sorts['archived']['field'] === $key)
                                {{ $sorts['archived']['direction'] === 'desc' ? '▼' : '▲' }}
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
            @if($this->archivedFunds->isNotEmpty())
                <ul class="grid gap-6 p-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($this->archivedFunds as $fund)
                        <livewire:accounting.fund-card :fund="$fund" wire:key="archived-{{$fund->fund_id}}">
                        </livewire:accounting.fund-card>
                    @endforeach
                </ul>
            @else
                <div class="p-8 text-center text-gray-500">
                    <p>{{ __('amorce.fund-archived-none') . '.' }}</p>
                </div>
            @endif
            {{ $this->archivedFunds->links(data: ['scrollTo' => false]) }}
        </section>
    </div>
</section>
