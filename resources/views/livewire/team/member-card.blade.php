<li class="flex justify-center @if($this->user->trashed()) opacity-50 @endif">
    <div class="relative w-full">
        @hasanyrole(\App\Enums\RolesEnum::USERMANAGER->value.'|'.
                            \App\Enums\RolesEnum::ADMIN->value)
        <a href="" class="inset-0 absolute z-10"
           wire:click.prevent="$dispatch('openCardModal',{component: 'modals.team-edit', params: { id: {{ $user->id }} }})">
            <span class="sr-only">{{ __('amorce.team-edit') }}</span>
        </a>
        @endhasanyrole
        <div class="max-w-sm bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md pb-6">
            <div class="relative w-full h-0 pb-[76.67%] rounded-t-2xl overflow-hidden bg-[#db6262]">
                <img
                    class="absolute w-full h-full object-cover"
                    src="{{ $user->picture_path ?? 'https://amorce.s3.eu-north-1.amazonaws.com/images/users/Hh7AwsnLfcMKSCpSHtvgggSDKRpvu8SXhqvsP7Pr.webp' }}"
                    alt="{{ __('amorce.team-picture') }}"
                />
            </div>
            <p class="text-center text-[#202224] text-lg font-bold">{{ $user->name }}</p>
            <p class="opacity-60 text-center text-[#202224] text-sm font-normal">
                {{ $user->email }}
            </p>
        </div>
    </div>
</li>
