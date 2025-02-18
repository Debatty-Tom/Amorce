<x-app-layout>
    <div class="flex justify-between items-center mb-8">
        <h1 class="font-bold text-2xl">
            {{ __('Stock') }}
        </h1>
        <a href="{{ route('team.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Add a folder') }}
        </a>
    </div>
    <ul class="grid grid-cols-5 gap-9 w-full p-8">
        @foreach($folders as $folder)
            <li class="flex justify-center">
                <livewire:stock.folder-card :$folder>
                </livewire:stock.folder-card>
            </li>
        @endforeach
    </ul>
</x-app-layout>
