<section>
    <div class="flex justify-between mb-5">
        <h2 class="text-3xl">{{__('Team')}}</h2>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click.prevent="$dispatch('openModal',{component: 'modals.team-create'})">{{ __('Add a member') }}</button>
    </div>
    <ul class="grid grid-cols-4 gap-9 w-full">
        @foreach($this->users as $user)
            <li class="flex justify-center" wire:key="{{ $user->id }}">
                <livewire:team.member-card :$user>
                </livewire:team.member-card>
            </li>
        @endforeach
    </ul>
</section>
