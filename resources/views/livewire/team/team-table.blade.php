<section class="flex flex-col gap-6">
    <div class="flex flex-wrap justify-between items-center gap-4">
        <div class="flex flex-wrap items-center gap-6">
            <h2 class="text-3xl font-semibold text-gray-800">{{ __('amorce.team') }}</h2>
            <div class="flex flex-wrap items-center gap-3">
                <x-search-field>
                    searches.team
                </x-search-field>
                @foreach ($this->categories as $key => $label)
                    <button wire:click="toggleSort('team', '{{ $key }}', 'refresh-users')"
                            class="flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg shadow transition">
                        {{ $label }}
                        @if ($sorts['team']['field'] === $key)
                            <span class="text-xs">{{ $sorts['team']['direction'] === 'desc' ? '▼' : '▲' }}</span>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
        @hasanyrole(\App\Enums\RolesEnum::USERMANAGER->value.'|'.\App\Enums\RolesEnum::ADMIN->value)
        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-5 rounded-lg shadow transition"
                wire:click.prevent="$dispatch('openModal',{component: 'modals.team-create'})">
            {{ __('amorce.create-member') }}
        </button>
        @endhasanyrole
    </div>
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 w-full">
        @foreach($this->users as $user)
            <livewire:team.member-card :user="$user" wire:key="user-{{ $user->id }}" />
        @endforeach

        @hasanyrole(\App\Enums\RolesEnum::USERMANAGER->value.'|'.\App\Enums\RolesEnum::ADMIN->value)
        @foreach($this->trashedUsers as $user)
            <livewire:team.member-card :user="$user" wire:key="trashed-{{ $user->id }}" />
        @endforeach
        @endhasanyrole
    </ul>
    <div class="pt-4">
        {{ $this->users->links(data: ['scrollTo' => false]) }}
    </div>
</section>
