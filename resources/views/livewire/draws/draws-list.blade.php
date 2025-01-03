<div>
<<<<<<< Updated upstream
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
        @foreach($draws as $draw)
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
=======
    <ul class="p-4 flex max-w-fit flex-wrap">
        @foreach($this->draws as $draw)
            <li class="relative p-8 bg-white flex flex-col m-2.5 rounded" wire:key="{{$draw->id}}">
                <a href="{{ route('draw.show',$draw->id)}}" class="inset-0 absolute"></a>
                {{ date_format(($draw->date), 'd/m/Y') }}
                <p>
                    {{ number_format(($draw->amount/100),2, ',',' ')."€" }}
                </p>
                <p>
>>>>>>> Stashed changes
                    {{ $draw->description }}
                </p>
                <div>
                    <a href="{{--{{ route('transactions.edit', $fund->id, $draw->id,) }}--}}">
                        {{ __('edit') }}
                    </a>
                    <a href="{{--{{ route('transactions.destroy', $draw->id, $fund->id) }}--}}">
                        {{ __('delete') }}
                    </a>
                </div>
            </li>
        @endforeach
<<<<<<< Updated upstream
        </tbody>
    </table>
{{--        {{ $draws->links() }}--}}
=======
    </ul>
    {{ $this->draws->links() }}
>>>>>>> Stashed changes
</div>
