<div
    id="wire-element-modal"
    class="fixed inset-0 z-50 flex justify-end bg-black bg-opacity-50"
    x-data="{ open: @entangle('isOpen')}"
    x-show="open"
    x-cloak
    x-on:keydown.escape.window="$dispatch('closeModal')"
    x-transition:enter="transform transition-transform duration-300 ease-out"
    x-transition:enter-start="translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transform transition-transform duration-300 ease-in"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
>
    <!-- Modal Content -->
    <div class="bg-white w-1/2 h-full shadow-lg p-6">
        <!-- Close Button -->
        <button
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"
            aria-label="Close"
            wire:click="dispatch('closeModal')"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div x-show="$livewireComponent">
            @if($livewireComponent)
                <livewire:dynamic-component :component="$livewireComponent" :key="$livewireComponent" />
            @endif
        </div>
    </div>
</div>
