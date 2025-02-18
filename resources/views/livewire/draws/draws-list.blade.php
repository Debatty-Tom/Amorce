<ul class="p-4 grid grid-cols-4 gap 4">
    @foreach($draws as $draw)
        <li class="relative p-8 bg-white flex flex-col gap-5 m-2.5 rounded-2xl shadow" wire:key="{{$draw->id}}">
            <a href="{{ route('draw.show',$draw->id)}}" class="inset-0 absolute"></a>
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
                        {{__('Amount :')}}
                    </p>
                    <p>
                        {{ number_format(($draw->amount/100),2, ',',' ')."€" }}
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
