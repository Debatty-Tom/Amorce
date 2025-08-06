<div class="relative w-full">
    @hasanyrole(\App\Enums\RolesEnum::USERMANAGER->value.'|'.
                        \App\Enums\RolesEnum::ADMIN->value)
    <a href="" class="inset-0 absolute z-10" x-data="{ model: @js($user) }"
       wire:click.prevent="$dispatch('openCardModal',{component: 'modals.team-edit', params: { user: { id: {{ $user->id }} } }})">
        <span class="sr-only">{{ __("Edit team member") }}</span>
    </a>
    @endhasanyrole
    <div class="max-w-sm bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md pb-6">
        <div class="relative w-full h-0 pb-[76.67%] rounded-t-2xl overflow-hidden bg-[#db6262]">
            <img
                class="absolute w-full h-full object-cover"
                src=
                    @if($user->picture_path)
                        "{{ $user->picture_path }}"
                @else
                    {{asset('storage/images/users/default_user.webp')}}
                @endif
                alt="{{ __("Team member picture") }}"
            />
        </div>
        <h3 class="text-center text-[#202224] text-lg font-bold">{{ $user->name }}</h3>
        <p class="opacity-60 text-center text-[#202224] text-sm font-normal">
            {{ $user->email }}
        </p>
    </div>
</div>
