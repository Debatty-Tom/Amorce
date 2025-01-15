<div class="flex w-full">
    <ul class="p-4 flex-row flex-wrap w-full">
        @foreach($draws as $draw)
            <li class="relative p-8 bg-white flex gap-10 m-2.5 rounded w-full" wire:key="{{$draw->id}}">
                <a href="{{ route('draw.show',$draw->id)}}" class="inset-0 absolute"></a>
                {{ date_format(($draw->date), 'd/m/Y') }}
                <p>
                    {{ number_format(($draw->amount/100),2, ',',' ')."€" }}
                </p>
                <ul>
                    @foreach($draw->projects as $project)
                        <li>
                            {{ $project->title }}
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
