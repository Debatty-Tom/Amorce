<div
    id="wire-element-modal"
    x-data="{ open: @entangle('isOpen'), livewireComponent: @entangle($livewireComponent)}"
    x-show="open"
    x-cloak
    class="fixed inset-0 bg-black bg-opacity-50 z-40 center"
    x-on:keydown.escape.window="$dispatch('closeModal')"
    x-transition:enter="transition-opacity ease-out duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-in duration-500"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div
        class="fixed inset-y-0 right-0 w-1/2 bg-white shadow-lg z-50 flex flex-col transform"
        x-show="open"
        x-transition:enter="transition-transform ease-out duration-500"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform ease-in duration-500"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
    >
        <div class="flex justify-end p-4">
            <span wire:click="dispatch('closeModal')"
                  class="text-gray-600 hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </span>
        </div>
        <div x-show="livewireComponent" class="p-6">
            @if($livewireComponent)
                <livewire:dynamic-component
                    :component="$livewireComponent"
                    :key="$livewireComponent"
                    :params="$componentParams ?? []"
                />
            @endif
        </div>
    </div>
</div>
