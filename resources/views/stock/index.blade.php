<x-app-layout>
    <h1>
        {{ __('Hello stock') }}
    </h1>
    <ul class="grid grid-cols-5 gap-9 w-full p-8">
        @foreach($folders as $folder)
            <li class="flex justify-center">
                <livewire:stock.folder-card :$folder>
                </livewire:stock.folder-card>
            </li>
        @endforeach
    </ul>
</x-app-layout>
