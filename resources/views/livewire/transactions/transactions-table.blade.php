<div>
    <h3>
        {{ __('Transactions') }}
    </h3>
    <table class="w-full bg-white rounded mb-4">
        <thead>
        <tr class="bg-gray-200">
            <th class="text-left  p-4">
                {{ __('Date') }}
            </th>
            <th class="text-left">
                {{ __('Description') }}
            </th>
            <th class="text-left">
                {{ __('Amount') }}
            </th>
            <th class="text-left">
                {{ __('edit/delete') }}
            </th>
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
                <td>
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
                <td>
                    <a href="{{ route('transactions.edit', $fund->id, $transaction->id,) }}">
                        {{ __('edit') }}
                    </a>
                    <a href="{{ route('transactions.destroy', $transaction->id, $fund->id) }}">
                        {{ __('delete') }}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $this->transactions->links() }}
</div>
