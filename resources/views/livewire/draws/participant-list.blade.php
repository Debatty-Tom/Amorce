<div>
    <table class="w-full bg-white rounded mb-4">
        <thead>
        <tr class="bg-gray-200">
            <th class="text-left  p-4">
                {{ __('amorce.form-name') }}
            </th>
            <th class="text-left">
                {{ __('amorce.draw-lasting') }}
            </th>
            <th class="text-left">
                {{ __('amorce.misc-contact') }}
            </th>
            <th class="text-left">
                {{ __('amorce.action-edit') . '/' . __('amorce.action-delete') }}
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
                    @if($participant->email === null)
                        @if($participant->phone === null)
                            {{ $participant->address }}
                        @else
                            {{ $participant->phone }}
                        @endif
                    @else
                        {{ $participant->email }}
                    @endif
                </td>
                <td>
                    <a href="{{--{{ route('transactions.edit', $fund->id, $participant->id,) }}--}}">
                        {{ __('amorce.action-edit') }}
                    </a>
                    <a href="{{--{{ route('transactions.destroy', $participant->id, $fund->id) }}--}}">
                        {{ __('amorce.action-delete') }}
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
