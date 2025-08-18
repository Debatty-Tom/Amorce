<li class="relative p-8 bg-white flex flex-col gap-5 m-2.5 rounded-2xl shadow" wire:key="{{$this->draw->id}}">
    <a href="{{ route('draw.show',$this->draw->id)}}" class="inset-0 absolute"></a>
    <div class="flex flex-row gap-10">
        <div>
            <p>
                {{__('amorce.form-date') . ' :'}}
            </p>
            <p>
                {{ date_format(($this->draw->date), 'd/m/Y') }}
            </p>
        </div>
        <div>
            <p>
                {{__('amorce.form-amount') . ' :'}}
            </p>
            <p>
                {{ number_format(($this->draw->amount/100),2, ',',' ')."€" }}
            </p>
        </div>
    </div>
    <div>
        <p>
            {{__('amorce.page-projects') . ' :'}}
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
