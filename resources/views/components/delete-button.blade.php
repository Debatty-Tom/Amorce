@props([
    'click' => null
])

<button
    @if($click)
        wire:click="{{ $click }}"
    @endif
    type="button"
    class="w-fit py-3 px-4 bg-red-500 text-white hover:bg-black hover:hover:bg-red-700 transition ease-in text-sm rounded-lg">
    {{ __('amorce.action-delete') }}
</button>
