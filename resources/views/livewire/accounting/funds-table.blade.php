<section>
    <div class="flex justify-between mb-5">
        <h2 class="text-3xl">{{__('amorce.navigation-accounting')}}</h2>
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
        <section class="flex flex-col gap 3">
            <div class="flex flex-row gap-10">
                <h3 class="text-2xl">
                    {{ __('amorce.funds-principal') }}
                </h3>
                <div>
                    <input type="text" wire:model.live.debounce.100ms="searches.principal"
                           placeholder="Rechercher un Nom"
                           class="border rounded px-3 py-2 w-full md:w-auto">
                    @foreach ($this->categories as $key => $label)
                        <button wire:click="toggleSort('principal', '{{ $key }}', 'refresh-funds')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ $label }}
                            @if ($sorts['principal']['field'] === $key)
                                {{ $sorts['principal']['direction'] === 'desc' ? '▼' : '▲' }}
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
            <ul class="grid grid-cols-4 gap-4 p-8">
                @foreach($this->principalFunds as $fund)
                    <li wire:key="principal-{{$fund->fund_id}}">
                        <livewire:accounting.fund-card :fund="$fund">
                        </livewire:accounting.fund-card>
                    </li>
                @endforeach
            </ul>
            {{ $this->principalFunds->links(data: ['scrollTo' => false]) }}
        </section>
        <section class="flex flex-col gap 3">
            <div class="flex flex-row gap-10">
                <h3 class="text-2xl">
                    {{ __('amorce.funds-specific') }}
                </h3>
                <div>
                    <input type="text" wire:model.live.debounce.100ms="searches.specific"
                           placeholder="Rechercher un Nom"
                           class="border rounded px-3 py-2 w-full md:w-auto">
                    @foreach ($this->categories as $key => $label)
                        <button wire:click="toggleSort('specific', '{{ $key }}', 'refresh-funds')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ $label }}
                            @if ($sorts['specific']['field'] === $key)
                                {{ $sorts['specific']['direction'] === 'desc' ? '▼' : '▲' }}
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
            <ul class="grid grid-cols-4 gap-4 p-8">
                @foreach($this->specificFunds as $fund)
                    <li wire:key="specific-{{$fund->fund_id}}">
                        <livewire:accounting.fund-card :fund="$fund">
                        </livewire:accounting.fund-card>
                    </li>
                @endforeach
            </ul>
            {{ $this->specificFunds->links(data: ['scrollTo' => false]) }}
        </section>

        <section class="flex flex-col gap 3">
            <div class="flex flex-row gap-10">
                <h3 class="text-2xl">
                    {{ __('amorce.page-funds-archived') }}
                </h3>
                <div>
                    <input type="text" wire:model.live.debounce.100ms="searches.archived"
                           placeholder="Rechercher un Nom"
                           class="border rounded px-3 py-2 w-full md:w-auto">
                    @foreach ($this->categories as $key => $label)
                        <button wire:click="toggleSort('archived', '{{ $key }}', 'refresh-funds')"
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
                <ul class="grid grid-cols-4 gap-4 p-8">
                    @foreach($this->archivedFunds as $fund)
                        <li wire:key="archived-{{$fund->fund_id}}">
                            <livewire:accounting.fund-card :fund="$fund">
                            </livewire:accounting.fund-card>
                        </li>
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
