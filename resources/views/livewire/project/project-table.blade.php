<li class="flex justify-center">
    <div class="relative w-full max-w-sm bg-white rounded-2xl shadow-md p-4 flex flex-col gap-2 hover:shadow-lg transition-shadow duration-200">
        <a href="#" class="inset-0 absolute z-10"
           wire:click.prevent="$dispatch('openCardModal',{component: 'modals.project-show', params: { project: { id: {{ $project->id }} } }})">
            <span class="sr-only">{{ __('amorce.project-see') }}</span>
        </a>
        <p class="text-center text-gray-900 font-bold text-lg truncate">{{ $project->title }}</p>
        <p class="text-gray-600 text-sm">
            {{ $this->descriptionLimited() }}
        </p>
    </div>
</li>
