<div class="space-y-6">
    <h2 class="text-xl font-bold">{{ __('amorce.fund-redistribution') . ' : ' . $this->sourceFund->title }}</h2>
    <p class="text-gray-700">💰 {{ __('amorce.fund-balance') . ' :' }} <strong>{{ $this->amount }}</strong></p>
    @if($this->sourceFundView->total_amount > 0)
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
                        {{ __('amorce.action-assign') }}
                    </button>
                </div>
            </div>
        @endforeach
    @else
        <div class="flex flex-col items-center justify-center gap-4 p-6 bg-green-50 border border-green-200 rounded-xl shadow-inner text-center">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100 text-green-600">
                ✔
            </div>

            <h3 class="text-lg font-semibold text-green-700">
                {{ __('amorce.fund-fully-assigned') }}
            </h3>
            <p class="text-sm text-green-600 max-w-sm">
                🎉 Vous avez attribué tout l'argent restant.
                Vous pouvez maintenant fermer définitivement ce fonds.
            </p>
        </div>
    @endif


    <div class="mt-6 flex justify-end">
        @if($this->sourceFundView->total_amount > 0)
            <x-cancel-button click="cancelDelete"></x-cancel-button>
        @else
            <button
                wire:click="deleteFund"
                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">
                {{ __('amorce.action-close') }}
            </button>
        @endif
    </div>
</div>
