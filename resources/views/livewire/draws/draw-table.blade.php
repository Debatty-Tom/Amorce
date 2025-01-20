<section>
    <h2 class="font-medium text-3xl pb-3">
        {{ __("Draw from ").date_format(($this->draw->date), 'd/m/Y') }}
    </h2>
    <div>
        <h3 class="text-2xl mb-2">
            {{ __("Draw's members :") }}
        </h3>
        <ul class="grid grid-cols-4 gap-5 mb-4">
            @foreach($this->draw->donators as $member)
                <li class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3" wire:key="{{$member->id}}">
                    <a href="" class="inset-0 absolute"></a>
                    <p>
                        {{ $member->name }}
                    </p>
                    <p>
                        {{ $member->email }}
                    </p>
                    <p>
                        {{ $member->phone }}
                    </p>
                    <div>
                        <a href="#">
                            {{ __('edit') }}
                        </a>
                        <a href="#">
                            {{ __('delete') }}
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div>
        <h3 class="text-2xl mb-2">
            {{ __("Draw's projects :") }}
        </h3>
        <ul class="grid grid-cols-4 gap-5">
            @foreach($this->draw->projects as $project)
                <li class="flex justify-center" wire:key="{{$project->title}}">
                    <livewire:project.project-table :$project/>
                </li>
            @endforeach
        </ul>
    </div>
</section>
