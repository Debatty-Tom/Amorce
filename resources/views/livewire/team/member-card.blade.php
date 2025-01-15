<div class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md pb-6">
{{--    <a href="" class="inset-0 absolute" x-data="{ model: @js($user) }" wire:click.prevent="$dispatch('openModal',{component: 'modals.team-edit', params:'model'})" >--}}
{{--    </a>--}}
    <!-- Image de couverture -->
    <div class="relative w-full h-0 pb-[76.67%] rounded-t-2xl overflow-hidden bg-[#db6262]">
        <img
            class="absolute inset-0 w-full h-full object-cover"
            src=
                @if($user->picture_path)
                    "{{ $user->picture_path }}"
                @else
                    {{asset('storage/images/users/default_user.webp')}}
                @endif
            alt="{{ __("Team member picture") }}"
        />
    </div>
    <!-- Informations personnelles -->
    <p class="text-center text-[#202224] text-lg font-bold">{{ $user->name }}</p>
    <p class="opacity-60 text-center text-[#202224] text-sm font-normal">
        {{ $user->email }}
    </p>
</div>
