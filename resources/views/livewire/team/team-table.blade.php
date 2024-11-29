<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="font-bold text-2xl">
            {{ __('Team') }}
        </h1>
        <a href="{{ route('team.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Add a member') }}
        </a>
    </div>

    <ul class="grid grid-cols-3 gap-9 w-full">
        @foreach($users as $user)
            <li class="flex justify-center">
                <livewire:team.member-card :$user>
                </livewire:team.member-card>
            </li>
        @endforeach
    </ul>
</div>
