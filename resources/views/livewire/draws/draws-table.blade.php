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
        <h3 class="text-2xl">
            {{ __('Next draws list') }}
        </h3>
        <ul class="p-4 grid grid-cols-4 gap 4">
            @foreach($this->nextDraws as $this->draw)
                <li class="relative p-8 bg-white flex flex-col gap-5 m-2.5 rounded-2xl shadow" wire:key="{{$this->draw->id}}">
                    <a href="{{ route('draw.show',$this->draw->id)}}" class="inset-0 absolute"></a>
                    <div class="flex flex-row gap-10">
                        <div>
                            <p>
                                {{__('Date :')}}
                            </p>
                            <p>
                                {{ date_format(($this->draw->date), 'd/m/Y') }}
                            </p>
                        </div>
                        <div>
                            <p>
                                {{__('Amount :')}}
                            </p>
                            <p>
                                {{ number_format(($this->draw->amount/100),2, ',',' ')."€" }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <p>
                            {{__('Projects :')}}
                        </p>
                        <ul class="pl-3">
                            @foreach($this->draw->projects as $project)
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
    </div>
    <div>
        <h3 class="text-2xl">
            {{ __('Past draws list') }}
        </h3>
        <ul class="p-4 grid grid-cols-4 gap 4">
            @foreach($this->pastDraws as $this->draw)
                <li class="relative p-8 bg-white flex flex-col gap-5 m-2.5 rounded-2xl shadow" wire:key="{{$this->draw->id}}">
                    <a href="{{ route('draw.show',$this->draw->id)}}" class="inset-0 absolute"></a>
                    <div class="flex flex-row gap-10">
                        <div>
                            <p>
                                {{__('Date :')}}
                            </p>
                            <p>
                                {{ date_format(($this->draw->date), 'd/m/Y') }}
                            </p>
                        </div>
                        <div>
                            <p>
                                {{__('Amount :')}}
                            </p>
                            <p>
                                {{ number_format(($this->draw->amount/100),2, ',',' ')."€" }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <p>
                            {{__('Projects :')}}
                        </p>
                        <ul class="pl-3">
                            @foreach($this->draw->projects as $project)
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
