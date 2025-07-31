<section class="flex flex-col gap-2.5">
    <div class="flex justify-between">
        <div class="flex flex-row gap-10">
            <h2 class="text-3xl">{{__('To do')}}</h2>
            <div>
                <input type="text" wire:model.live.debounce.100ms="searches.todo"
                       placeholder="Rechercher un Nom"
                       class="border rounded px-3 py-2 w-full md:w-auto">
                @foreach ($this->categories as $key => $label)
                    <button wire:click="toggleSort('todo', '{{ $key }}', 'refresh-todos')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ $label }}
                        @if ($sorts['todo']['field'] === $key)
                            {{ $sorts['todo']['direction'] === 'desc' ? '▼' : '▲' }}
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                wire:click.prevent="$dispatch('openModal',{component: 'modals.todo-create'})">{{ __('Add a todo') }}</button>
    </div>
    <ul class="grid grid-cols-4 gap-5 ">
        @foreach($this->todos as $todo)
            <li class="flex flex-col justify-between gap-3 bg-white p-4 rounded-2xl relative shadow @if($todo->trashed()) opacity-50 @endif"
                wire:key="{{$todo->id}}">
                <a href="#" class="inset-0 absolute z-10" x-data="{ model: @js($todo) }"
                   wire:click.prevent="$dispatch('openCardModal',{component: 'modals.todo-show', params: { todo: { id: {{ $todo->id }} } }})">
                    <span class="sr-only">{{ __("See to do") }}</span>
                </a>
                <h3 class="min-w-20">
                    {{ $todo->title }}
                </h3>
                <p class="max-w-screen-lg">
                    {{ \Illuminate\Support\Str::limit($todo->description, 100) }}
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
                <div>
                    <p>
                        {{ __("Todo's assigned by : ") }}
                    </p>
                    <p>
                        Assigné par : {{ $todo->assignments[0]->assignedBy->name ?? 'Inconnu' }}
                    </p>
                </div>
            </li>
        @endforeach
    </ul>
    {{ $this->todos->links(data: ['scrollTo' => false]) }}
</section>
