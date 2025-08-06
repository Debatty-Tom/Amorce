@props([
    'click' => null
])

<button
    type="button"
    class="py-2 px-4 bg-amber-400 rounded"
    @if($click)
        wire:click="{{ $click }}"
    @endif >
    Supprimer
</button>
