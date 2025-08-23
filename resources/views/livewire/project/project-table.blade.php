<li class="flex justify-center">
    <div
        class="relative w-full max-w-sm bg-white rounded-2xl shadow-md p-4 flex flex-col gap-2 hover:shadow-lg transition-shadow duration-200">
        @if($project->pivot)
            @if($project->pivot->status === 'funded')
                <span class="absolute top-3 right-3 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-lg border border-green-300 shadow-sm">
                {{ $project->pivot->amount }} €
            </span>
            @elseif($project->pivot->status === 'refused')
                <span class="absolute top-3 right-3 bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-lg border border-red-300 shadow-sm">
                {{ $project->pivot->status }}
            </span>
            @endif
        @elseif($this->project->draws->isNotEmpty())
            @if($this->project->draws->first()->pivot->status === 'funded')
                <span class="absolute top-3 right-3 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-lg border border-green-300 shadow-sm">
                {{ $this->project->draws->first()->pivot->amount }} €
            </span>
            @elseif($this->project->draws->first()->pivot->status === 'refused')
                <span class="absolute top-3 right-3 bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-lg border border-red-300 shadow-sm">
                {{ $this->project->draws->first()->pivot->status }}
            </span>
            @endif
        @endif
        <a href="#" class="absolute inset-0 z-10"
           wire:click.prevent="$dispatch('openCardModal',{component: 'modals.project-show', params: { project: { id: {{ $project->id }} } }})">
            <span class="sr-only">{{ __('amorce.project-see') }}</span>
        </a>

        <p class="text-center text-gray-900 font-bold text-lg truncate">
            {{ $project->title }}
        </p>
        <p class="text-gray-600 text-sm">
            {{ $this->descriptionLimited() }}
        </p>
    </div>
</li>
