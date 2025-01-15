<nav class="bg-white flex flex-col gap-3 p-4">
    <h1 class="justify-self-center p-4 mt-5 font-bold text-3xl text-center">{{ __('Amorce') }}</h1>
    <ul class="flex flex-col gap-2 justify-center p-8">
        @foreach ($links as $link)
            <livewire:links.navigation
                    :href="$link['href']"
                    :label="$link['label']"
                    :icon="$link['icon']"
                    wire:key="$link['href']"
            />
        @endforeach
    </ul>
</nav>
