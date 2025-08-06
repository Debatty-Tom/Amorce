<div class="space-y-6">
    <h2 class="text-xl font-bold">{{ __('Attention, il reste de l’argent sur ce fond! Redistribution du fond :') . ' ' . $this->sourceFund->title }}</h2>
    <p class="text-gray-700">💰 {{ __('Solde disponible :') }} <strong>{{ $this->amount }}</strong></p>

    @foreach($this->targetFunds as $fund)
        <div class="border p-4 rounded shadow-sm">
            <h3 class="font-semibold">{{ $fund->title }}</h3>

            <div x-data="{ value: 0 }" class="flex items-center gap-4 mt-2">
                <input
                        type="range"
                        min="0"
                        max="{{ $this->rangeMax }}"
                        step="0.01"
                        class="w-full"
                        x-model.number="value"
                />

                <input
                        type="number"
                        step="0.01"
                        min="0"
                        :max="{{ $this->rangeMax }}"
                        class="border p-2 rounded w-24"
                        x-model.number="value"
                />
                <button
                        type="button"
                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-800"
                        @click="$wire.assign({{ $fund->id }}, value)">
                    {{ __('Attribuer') }}
                </button>
            </div>
        </div>
    @endforeach


    <div class="mt-6 flex justify-end">
        @if($this->sourceFundView->total_amount > 0)
            <x-cancel-button click="cancelDelete"></x-cancel-button>
        @else
            <button
                wire:click="deleteFund"
                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">
                {{ __('Fermer') }}
            </button>
        @endif
    </div>
</div>
