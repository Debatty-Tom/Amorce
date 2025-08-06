<section>
    <div class="flex justify-between mb-5">
        <h2 class="text-3xl">{{__('Accounting')}}</h2>
        <div class="gap-5">
            @hasanyrole(\App\Enums\RolesEnum::ACCOUNTANT->value.'|'.
                        \App\Enums\RolesEnum::ADMIN->value)
            <a href="{{ route('csv.index') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Import CSV') }}</a>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    wire:click.prevent="$dispatch('openModal',{component: 'modals.fund-create'})">{{ __('Add a fund') }}</button>
            @endhasanyrole
        </div>
    </div>
    <div>
        <section class="flex flex-col gap 3">
            <div class="flex flex-row gap-10">
                <h3 class="text-2xl">
                    {{ __('Principals funds') }}
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
                    <li wire:key="{{$fund->fund_id}}">
                        <div
                            class="max-w-sm h-64 w-full p-8 bg-white rounded-2xl flex flex-col justify-between gap-2 shadow-md relative">
                            <a class="absolute inset-0 z-10" href="{{ route('accounting.show', $fund->fund_id) }}"></a>
                            <div class="flex flex-col items-center">
                                <h4 class="text-lg font-bold text-[#202224]">{{ Illuminate\Support\Str::limit($fund->fund_title, 25, preserveWords: true) }}</h4>
                                <p class="text-sm font-medium text-[#202224] text-center opacity-60">{{ Illuminate\Support\Str::limit($fund->fund_description, 50, preserveWords: true) }}</p>
                            </div>
                            <div class="flex flex-col items-center pb-3 gap-4">
                                <p class="text-[#4880ff] text-[46px] font-extrabold ">{{ Brick\Money\Money::ofMinor($fund->total_amount, 'EUR')->formatTo('fr_BE') }}</p>
                                <p class="text-[#4880ff] text-base font-bold">{{ __('See the fund') }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{ $this->principalFunds->links(data: ['scrollTo' => false]) }}
        </section>
        <section class="flex flex-col gap 3">
            <div class="flex flex-row gap-10">
                <h3 class="text-2xl">
                    {{ __('Specifics funds') }}
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
                    <li wire:key="{{$fund->fund_id}}">
                        <div
                            class="max-w-sm h-64 w-full p-8 bg-white rounded-2xl flex flex-col justify-between gap-2 shadow-md relative">
                            <a class="absolute inset-0 z-10" href="{{ route('accounting.show', $fund->fund_id) }}"></a>
                            <div class="flex flex-col items-center">
                                <h4 class="text-lg font-bold text-[#202224]">{{ Illuminate\Support\Str::limit($fund->fund_title, 25, preserveWords: true) }}</h4>
                                <p class="text-sm font-medium text-[#202224] text-center opacity-60">{{ Illuminate\Support\Str::limit($fund->fund_description, 50, preserveWords: true) }}</p>
                            </div>
                            <div class="flex flex-col items-center pb-3 gap-4">
                                <p class="text-[#4880ff] text-[46px] font-extrabold ">{{ Brick\Money\Money::ofMinor($fund->total_amount, 'EUR')->formatTo('fr_BE') }}</p>
                                <p class="text-[#4880ff] text-base font-bold">{{ __('See the fund') }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{ $this->specificFunds->links(data: ['scrollTo' => false]) }}
        </section>

        <section class="flex flex-col gap 3">
            <div class="flex flex-row gap-10">
                <h3 class="text-2xl">
                    {{ __('Archived funds') }}
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
                        <li wire:key="{{$fund->fund_id}}">
                            <div
                                class="max-w-sm h-64 w-full p-8 bg-white rounded-2xl flex flex-col justify-between gap-2 shadow-md relative">
                                <a class="absolute inset-0 z-10"
                                   href="{{ route('accounting.show', $fund->fund_id) }}"></a>
                                <div class="flex flex-col items-center">
                                    <h4 class="text-lg font-bold text-[#202224]">{{ Illuminate\Support\Str::limit($fund->fund_title, 25, preserveWords: true) }}</h4>
                                    <p class="text-sm font-medium text-[#202224] text-center opacity-60">{{ Illuminate\Support\Str::limit($fund->fund_description, 50, preserveWords: true) }}</p>
                                </div>
                                <div class="flex flex-col items-center pb-3 gap-4">
                                    <p class="text-[#4880ff] text-[46px] font-extrabold ">{{ Brick\Money\Money::ofMinor($fund->total_amount, 'EUR')->formatTo('fr_BE') }}</p>
                                    <p class="text-[#4880ff] text-base font-bold">{{ __('See the fund') }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="p-8 text-center text-gray-500">
                    <p>{{ __('No archived funds found.') }}</p>
                </div>
            @endif
            {{ $this->archivedFunds->links(data: ['scrollTo' => false]) }}
        </section>
    </div>
</section>
