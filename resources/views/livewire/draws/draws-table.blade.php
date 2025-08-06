<section>
    <div class="flex justify-between mb-5">
        <h2 class="text-3xl font-medium">{{__('Draws')}}</h2>
        @hasanyrole(\App\Enums\RolesEnum::DRAWMANAGER->value.'|'.
                        \App\Enums\RolesEnum::ADMIN->value)
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                wire:click.prevent="$dispatch('openModal',{component: 'modals.draw-create'})">{{ __('Add a new draw') }}</button>
        @endhasanyrole
    </div>
    <div>
        <div class="flex flex-row gap-10">
            <h3 class="text-2xl">
                {{ __('Waiting draws list') }}
            </h3>
            <div>
                <input type="text" wire:model.live.debounce.100ms="searches.pending" placeholder="Rechercher un titre"
                       class="border rounded px-3 py-2 w-full md:w-auto">
                @foreach ($this->categories as $key => $label)
                    <button wire:click="toggleSort('pending', '{{ $key }}', 'refresh-draws')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ $label }}
                        @if ($sorts['pending']['field'] === $key)
                            {{ $sorts['pending']['direction'] === 'desc' ? '▼' : '▲' }}
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
        <ul class="p-4 grid grid-cols-4 gap 4">
            @foreach($this->pendingDraws as $draw)
                <li class="relative p-8 bg-white flex flex-col gap-5 m-2.5 rounded-2xl shadow" wire:key="{{$draw->id}}">
                    <a href="{{ route('draw.show',$draw->id)}}" wire:navigate class="inset-0 absolute"></a>
                    <div class="flex flex-row gap-10">
                        <div>
                            <p>
                                {{__('Date :')}}
                            </p>
                            <p>
                                {{ date_format(($draw->date), 'd/m/Y') }}
                            </p>
                        </div>
                        <div>
                            <p>
                                {{__('Amount') . ' :'}}
                            </p>
                            <p>
                                {{ $this->amount($draw) }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <p>
                            {{__('Projects :')}}
                        </p>
                        <ul class="pl-3">
                            @foreach($draw->projects as $project)
                                <li class="list-disc">
                                    <p>
                                        {{$project->title }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $this->pendingDraws->links(data: ['scrollTo' => false]) }}
    </div>
    <div>
        <div class="flex flex-row gap-10">
            <h3 class="text-2xl">
                {{ __('Archived draws list') }}
            </h3>
            <div>
                <input type="text" wire:model.live.debounce.100ms="searches.archived" placeholder="Rechercher un titre"
                       class="border rounded px-3 py-2 w-full md:w-auto">
                @foreach ($this->categories as $key => $label)
                    <button wire:click="toggleSort('archived', '{{ $key }}', 'refresh-draws')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ $label }}
                        @if ($sorts['archived']['field'] === $key)
                            {{ $sorts['archived']['direction'] === 'desc' ? '▼' : '▲' }}
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
        @if($this->archivedDraws->isNotEmpty())
            <ul class="p-4 grid grid-cols-4 gap 4">
                @foreach($this->archivedDraws as $draw)
                    <li class="relative p-8 bg-white flex flex-col gap-5 m-2.5 rounded-2xl shadow"
                        wire:key="{{$draw->id}}">
                        <a href="{{ route('draw.show',$draw->id)}}" wire:navigate class="inset-0 absolute"></a>
                        <div class="flex flex-row gap-10">
                            <div>
                                <p>
                                    {{__('Date :')}}
                                </p>
                                <p>
                                    {{ date_format(($draw->date), 'd/m/Y') }}
                                </p>
                            </div>
                            <div>
                                <p>
                                    {{__('Amount' . ' :')}}
                                </p>
                                <p>
                                    {{ $this->amount($draw) }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <p>
                                {{__('Projects :')}}
                            </p>
                            <ul class="pl-3">
                                @foreach($draw->projects as $project)
                                    <li class="list-disc">
                                        <p>
                                            @if($project->pivot->amount > 0)
                                                {{$project->title }}&nbsp;:&nbsp;{{ $project->pivot->amount }}€
                                            @else
                                                {{$project->title }}
                                            @endif
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 text-center mt-9 mb-9">{{ __('No archived draws found.') }}</p>
        @endif
        {{ $this->archivedDraws->links(data: ['scrollTo' => false]) }}
    </div>
    <div class="mt-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="font-bold text-2xl">
                {{ __('Participants') }}
            </h1>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    wire:click.prevent="$dispatch('openModal',{component: 'modals.donator-create'})">{{ __('Add a new donator') }}
            </button>
        </div>
    </div>
</section>
