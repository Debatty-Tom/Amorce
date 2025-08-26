<section class="space-y-6">
    <div class="flex flex-wrap justify-between items-center gap-4">
        <h3 class="text-2xl font-semibold text-gray-800">
            {{ __('amorce.misc-transactions') }}
        </h3>
        <div class="flex flex-wrap items-center gap-3">
            <x-search-field>
                searches.transaction
            </x-search-field>
            @foreach($this->categories as $key => $label)
                <button wire:click="toggleSort('transaction', '{{ $key }}', 'refresh-transactions')"
                        class="flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg shadow transition">
                    {{ $label }}
                    @if ($sorts['transaction']['field'] === $key)
                        <span class="text-xs">{{ $sorts['transaction']['direction'] === 'desc' ? '▼' : '▲' }}</span>
                    @endif
                </button>
            @endforeach
        </div>
    </div>

    <div class="overflow-hidden rounded-xl shadow bg-white">
        <table class="w-full text-sm">
            <thead>
            <tr class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <th class="text-left px-6 py-3">{{ __('amorce.form-date') }}</th>
                <th class="text-left px-6 py-3">{{ __('amorce.form-description') }}</th>
                <th class="text-right px-6 py-3">{{ __('amorce.misc-amount') }}</th>
                @hasanyrole(\App\Enums\RolesEnum::ACCOUNTANT->value.'|'.\App\Enums\RolesEnum::ADMIN->value)
                <th class="text-right px-6 py-3">{{ __('amorce.action-edit') }}/{{ __('amorce.action-delete') }}</th>
                @endhasanyrole
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($this->transactions as $transaction)
                <tr class="hover:bg-gray-50 transition" wire:key="{{$transaction->id}}">
                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                        {{ $transaction->date->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $transaction->description }}
                    </td>
                    <td class="px-6 py-4 text-right font-medium">
                        @if (str_contains($transaction->amount, '-') !== false)
                            <span class="text-red-500">
                                {{ number_format(($transaction->amount/100),2, ',',' ')."€" }}
                            </span>
                        @else
                            <span class="text-green-600">
                                {{ number_format(($transaction->amount/100),2, ',',' ')."€" }}
                            </span>
                        @endif
                    </td>
                    @hasanyrole(\App\Enums\RolesEnum::ACCOUNTANT->value.'|'.\App\Enums\RolesEnum::ADMIN->value)
                    <td class="px-6 py-4 text-right">
                        @if(!$transaction->trashed())
                            <div class="flex justify-end gap-2">
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition"
                                    wire:click.prevent="$dispatch('openCardModal',{component: 'modals.transaction-edit', params: { id: {{ $transaction->id }} } })">
                                    {{ __('amorce.action-edit') }}
                                </button>
                                <button
                                    type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition"
                                    wire:click.prevent="$dispatch('openCardModal',{component: 'modals.transaction-delete', params: { id: {{ $transaction->id }} } })">
                                    {{ __('amorce.action-delete') }}
                                </button>
                            </div>
                        @else
                            <p class="text-gray-400 italic">{{ __('amorce.message-transaction-deleted') }}</p>
                        @endif
                    </td>
                    @endhasanyrole
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="pt-4">
        {{ $this->transactions->links(data: ['scrollTo' => false]) }}
    </div>
</section>
