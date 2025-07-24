<div
    id="card-modal"
    x-data="{ open: @entangle('isCardOpen'), livewireComponent: @entangle($livewireComponent) }"
    x-show="open"
    x-cloak
    class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 flex items-center justify-center"
    x-on:keydown.escape.window="$dispatch('closeCardModal')"
    x-transition:enter="transition-opacity ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div
        class="bg-white w-full max-w-xl mx-auto rounded-2xl shadow-xl p-6 relative"
        x-show="open"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="scale-95 opacity-0"
        x-transition:enter-end="scale-100 opacity-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="scale-100 opacity-100"
        x-transition:leave-end="scale-95 opacity-0"
    >
        <button
            wire:click="$dispatch('closeCardModal')"
            class="absolute top-4 right-4 text-gray-500 hover:text-black"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div x-show="livewireComponent">
            @if($livewireComponent)
                @livewire($livewireComponent, $componentParams, key($livewireComponent))
            @endif
        </div>
    </div>
</div>
