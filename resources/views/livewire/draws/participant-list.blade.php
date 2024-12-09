<div>
    <table class="w-full bg-white rounded mb-4">
        <thead>
        <tr class="bg-gray-200">
            <th class="text-left  p-4">
                {{ __('Nom') }}
            </th>
            <th class="text-left">
                {{ __('Détentes restantes') }}
            </th>
            <th class="text-left">
                {{ __('Contact') }}
            </th>
            <th class="text-left">
                {{ __('edit/delete') }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($participants as $participant)
            <tr wire:key="{{$participant->id}}">
                <td class=" p-4">
                    {{ $participant->name }}
                </td>
                <td>
                    {{ $participant->name }}
                </td>
                <td>
                    {{ $participant->email }}
                </td>
                <td>
                    <a href="{{--{{ route('transactions.edit', $fund->id, $participant->id,) }}--}}">
                        {{ __('edit') }}
                    </a>
                    <a href="{{--{{ route('transactions.destroy', $participant->id, $fund->id) }}--}}">
                        {{ __('delete') }}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{--
        {{ $this->transactions->links() }}
    --}}
</div>
