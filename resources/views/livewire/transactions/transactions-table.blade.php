<div>
    <div class="flex flex-row gap-10 mb-4">
        <h3 class="text-2xl">
            {{ __('Transactions') }}
        </h3>
        <div>
            <input type="text" wire:model.live.debounce.100ms="searches.transaction"
                   placeholder="Rechercher une description"
                   class="border rounded px-3 py-2 w-full md:w-auto">
            @foreach ($this->categories as $key => $label)
                <button wire:click="toggleSort('transaction', '{{ $key }}', 'refresh-transactions')"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ $label }}
                    @if ($sorts['transaction']['field'] === $key)
                        {{ $sorts['transaction']['direction'] === 'desc' ? '▼' : '▲' }}
                    @endif
                </button>
            @endforeach
        </div>
    </div>
    <table class="w-full bg-white rounded mb-4">
        <thead>
        <tr class="bg-gray-200">
            <th class="text-left  p-4">
                {{ __('Date') }}
            </th>
            <th class="text-left">
                {{ __('Description') }}
            </th>
            <th class="text-right">
                {{ __('Amount') }}
            </th>
            @hasanyrole(\App\Enums\RolesEnum::ACCOUNTANT->value.'|'.
                        \App\Enums\RolesEnum::ADMIN->value)
            <th class="text-right p-4">
                {{ __('edit/delete') }}
            </th>
            @endhasanyrole
        </tr>
        </thead>
        <tbody>
        @foreach($this->transactions as $transaction)
            <tr wire:key="{{$transaction->id}}">
                <td class=" p-4">
                    {{ date_format(($transaction->date), 'd/m/Y') }}
                </td>
                <td>
                    {{ $transaction->description }}
                </td>
                <td class="text-right">
                    @if (str_contains($transaction->amount, '-') !== false)
                        <p class="text-red-500">
                            {{ number_format(($transaction->amount/100),2, ',',' ')."€" }}
                        </p>
                    @else
                        <p class="text-green-400">
                            {{ number_format(($transaction->amount/100),2, ',',' ')."€" }}
                        </p>
                    @endif
                </td>
                @hasanyrole(\App\Enums\RolesEnum::ACCOUNTANT->value.'|'.
                        \App\Enums\RolesEnum::ADMIN->value)
                @if(!$transaction->trashed())
                <td class="p-4 flex gap-2 justify-end">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        wire:click.prevent="$dispatch('openCardModal',{component: 'modals.transaction-edit', params: { id: {{ $transaction->id }} } })">{{ __('Edit') }}</button>

                    <button
                        type="button"
                        class="w-fit py-3 px-4 bg-red-500 text-white hover:bg-black hover:hover:bg-red-700 transition ease-in text-sm rounded-lg"
                        wire:click.prevent="$dispatch('openCardModal',{component: 'modals.transaction-delete', params: { id: {{ $transaction->id }} } })">
                        {{ __('Supprimer') }}
                    </button>
                </td>
                @else
                    <td class="p-4 flex gap-2 justify-end">
                        <p>{{ __('Transaction supprimée') }}</p>
                    </td>
                @endif
                @endhasanyrole
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $this->transactions->links(data: ['scrollTo' => false]) }}
</div>
