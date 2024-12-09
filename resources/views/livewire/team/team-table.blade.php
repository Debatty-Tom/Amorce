<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="font-bold text-2xl">
            {{ __('Team') }}
        </h1>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click.prevent="$dispatch('openModal',{component: 'modals.team-create'})">{{ __('Add a member') }}</button>
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
