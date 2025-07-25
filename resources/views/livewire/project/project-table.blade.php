<div class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3">
    <a href="" class="inset-0 absolute z-10" x-data="{ model: @js($user) }"
       wire:click.prevent="$dispatch('openCardModal',{component: 'modals.team-edit', params: { user: { id: {{ $user->id }} } }})">
        <span class="sr-only">{{ __("Edit team member") }}</span>
    </a>
    <p class="text-center text-[#202224] text-lg font-bold">{{ $this->project->title }}</p>
    <p >
        {{ $this->descriptionLimited }}
    </p>
</div>
