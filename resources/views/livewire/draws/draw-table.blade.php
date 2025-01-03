<div>
    <h1 class="font-bold text-2xl">
        Détentes du {{ date_format(($this->draw->date), 'd/m/Y') }}
    </h1>
    <h2>
        Les membres de la détente :
    </h2>
    <ul class="p-4 flex max-w-fit flex-wrap">
        @foreach($this->draw->donators as $member)
            <li class="relative p-8 bg-white flex flex-col m-2.5 rounded" wire:key="{{$member->id}}">
                <a href="" class="inset-0 absolute"></a>
                {{ $member->name }}
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
