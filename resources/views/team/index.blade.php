<x-app-layout>
    <h1>
        {{ __('Hello team') }}
    </h1>
    <ul class="grid grid-cols-3 gap-9 w-full p-8">
        @foreach($users as $user)
            <li class="flex justify-center">
                <livewire:team.member-card :$user>
                </livewire:team.member-card>
            </li>
        @endforeach
    </ul>
</x-app-layout>
