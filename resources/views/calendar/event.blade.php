<div
    @if($eventClickEnabled)
        wire:click.stop="onEventClick('{{ $event['id'] }}')"
    @endif
    class="rounded-lg border py-2 px-3 shadow-md cursor-pointer
            @if(str_contains($event['id'], 'draw')) bg-blue-200
            @else bg-white
            @endif"
>
    <p class="text-sm font-medium">
        {{ $event['title'] }}
    </p>
    <p class="mt-2 text-xs text-gray-600">
        {{ $event['description'] ?? 'Aucune description' }}
    </p>
</div>
