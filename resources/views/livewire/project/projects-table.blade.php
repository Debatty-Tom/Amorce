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
                    <livewire:project.project-table :$project/>
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
                    <livewire:project.project-table :$project/>
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
                    <livewire:project.project-table :$project/>
                </li>
            @endforeach
        </ul>
    </div>
</section>
