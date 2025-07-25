<section>
    <div class="flex justify-between mb-5">
        <h2 class="text-3xl">{{__('Projects')}}</h2>
        @hasanyrole(\App\Enums\RolesEnum::PROJECTMANAGER->value.'|'.
                    \App\Enums\RolesEnum::ADMIN->value)
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                wire:click.prevent="$dispatch('openModal',{component: 'modals.project-create'})">{{ __('Add a project') }}</button>
        @endhasanyrole
    </div>
    <div class="mb-4">
        <h3 class="text-2xl pb-3">
            {{__("Pending projects")}}
        </h3>
        <ul class="grid grid-cols-4 gap-4 w-full">
            @foreach($this->pendingProjects as $project)
                <li class="flex justify-center">
                    <div class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3">
                        <a href="#" class="inset-0 absolute z-10" x-data="{ model: @js($project) }"
                           wire:click.prevent="$dispatch('openCardModal',{component: 'modals.project-show', params: { project: { id: {{ $project->id }} } }})">
                            <span class="sr-only">{{ __("See project") }}</span>
                        </a>
                        <p class="text-center text-[#202224] text-lg font-bold">{{ $project->title }}</p>
                        <p>
                            {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="pt-4 mb-4">
        <h3 class="text-2xl pb-3">
            {{__("Next draw's projects")}}
        </h3>
        <ul class="grid grid-cols-4 gap-4 w-full">
            @foreach($this->nextDrawProjects as $project)
                <li class="flex justify-center">
                    <div class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3">
                        <a href="#" class="inset-0 absolute z-10" x-data="{ model: @js($project) }"
                           wire:click.prevent="$dispatch('openCardModal',{component: 'modals.project-show', params: { project: { id: {{ $project->id }} } }})">
                            <span class="sr-only">{{ __("See project") }}</span>
                        </a>
                        <p class="text-center text-[#202224] text-lg font-bold">{{ $project->title }}</p>
                        <p>
                            {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="pt-4 mb-4">
        <h3 class="text-2xl pb-3">
            {{__('funded projects')}}
        </h3>
        <ul class="grid grid-cols-4 gap-4 w-full">
            @foreach($this->fundedProjects as $project)
                <li class="flex justify-center">
                    <div class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3">
                        <a href="#" class="inset-0 absolute z-10" x-data="{ model: @js($project) }"
                           wire:click.prevent="$dispatch('openCardModal',{component: 'modals.project-show', params: { project: { id: {{ $project->id }} } }})">
                            <span class="sr-only">{{ __("See project") }}</span>
                        </a>
                        <p class="text-center text-[#202224] text-lg font-bold">{{ $project->title }}</p>
                        <p>
                            {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>
