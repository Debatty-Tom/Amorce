<div>
    <table class="w-full bg-white rounded mb-4">
        <thead>
        <tr class="bg-gray-200">
            <th class="text-left  p-4">
                {{ __('Date') }}
            </th>
            <th class="text-left">
                {{ __('Montant délibéré') }}
            </th>
            <th class="text-left">
                {{ __('Projets retenus') }}
            </th>
            <th class="text-left">
                {{ __('edit/delete') }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->draws as $draw)
            <tr class="relative" wire:key="{{$draw->id}}">
                <td class=" p-4">
                    <a href="#" class="inset-0 absolute"></a>
                    {{ date_format(($draw->date), 'd/m/Y') }}
                </td>
                <td>
                    <p>
                        {{ number_format(($draw->amount/100),2, ',',' ')."€" }}
                    </p>
                </td>
                <td>
                    {{ $draw->description }}
                </td>
                <td>
                    <a href="{{--{{ route('transactions.edit', $fund->id, $draw->id,) }}--}}">
                        {{ __('edit') }}
                    </a>
                    <a href="{{--{{ route('transactions.destroy', $draw->id, $fund->id) }}--}}">
                        {{ __('delete') }}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        {{ $this->draws->links() }}
</div>
