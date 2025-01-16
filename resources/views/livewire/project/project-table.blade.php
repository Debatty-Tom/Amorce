<div class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3">
    {{--    <a href="" class="inset-0 absolute" x-data="{ model: @js($user) }" wire:click.prevent="$dispatch('openModal',{component: 'modals.team-edit', params:'model'})" >--}}
    {{--    </a>--}}
    <!-- Informations personnelles -->
    <p class="text-center text-[#202224] text-lg font-bold">{{ $project->title }}</p>
    <p >
        {{ $project->descriptionLimited }}
    </p>
</div>
