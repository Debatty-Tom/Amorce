<header>
    <div class="flex justify-between align-middle">
        <h>
            {{ $title }}
        </h>
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            wire:click.prevent="$dispatch('openModal', {component: $modalComponent})">
            {{ $buttonText }}
        </button>
    </div>
</header>
