<section>
    <h2 class="font-medium text-3xl pb-3">
        {{ __("Draw from ").date_format(($this->draw->date), 'd/m/Y') }}
    </h2>
    <div>
        <h3 class="text-2xl">
            {{ __("Draw's members :") }}
        </h3>
        <ul class="grid grid-cols-4">
            @foreach($this->draw->donators as $member)
                <li class="relative p-8 bg-white flex flex-col m-2.5 rounded" wire:key="{{$member->id}}">
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
</section>
