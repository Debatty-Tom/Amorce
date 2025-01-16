<section>
    <div class="flex justify-between mb-5">
        <h2 class="text-3xl">{{__('To do')}}</h2>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click.prevent="$dispatch('openModal',{component: 'modals.todo-create'})">{{ __('Add a todo') }}</button>
    </div>
    <ul class="grid grid-cols-4 gap-5 ">
        @foreach($todos as $todo)
            <li class="flex flex-col justify-between gap-3 bg-white p-4 rounded" wire:key="{{$todo->id}}">
                <h3 class="min-w-20">
                    {{ $todo->title }}
                </h3>
                <p class="max-w-screen-lg">
                    {{ $todo->descriptionLimited }}
                </p>
                <div>
                    <p>
                        {{ __("Todo's members") }}
                    </p>
                    @if($todo->users)
                        <ul class="pl-3">
                            @foreach($todo->users as $user)
                                <li class="list-disc">
                                    {{ $user->name }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </li>
        @endforeach
    </ul>
</section>
