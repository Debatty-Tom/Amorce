@props([
    'click' => null,
    'redirect' => null,
    'text' => '',
    'icon' => '',
])

<article class="w-full p-8 bg-white rounded-lg shadow-md flex flex-row justify-between gap-4 relative">
    @if($redirect || $click)
        <a
            class="inset-0 absolute z-10"
            @if($redirect)
                href="{{ $redirect }}"
            wire:navigate
            @else
                href="#"
            wire:click.prevent="{{ $click }}"
            @endif
        ></a>
    @endif

    <div class="w-full flex flex-col gap-5">
        <h2 class="text-xl font-bold text-black">{{ $slot }}</h2>
        <div class="w-full flex flex-row justify-between">
            <p class="text-xl font-semibold text-gray-500">{{ $text }}</p>
            <div>
                <x-dynamic-component :component="$icon"/>
            </div>
        </div>
    </div>
</article>
