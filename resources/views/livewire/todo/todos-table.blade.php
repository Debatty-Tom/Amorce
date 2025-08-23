<section class="flex flex-col gap-2.5">
    <div class="flex justify-between">
        <div class="flex flex-row gap-10">
            <h2 class="text-3xl">{{__('amorce.page-todos')}}</h2>
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
                wire:click.prevent="$dispatch('openModal',{component: 'modals.todo-create'})">{{ __('amorce.create-todo') }}</button>
    </div>
    <ul class="grid grid-cols-4 gap-5 ">
        @foreach($this->todos as $todo)
            <livewire:todo.todo-card :todo="$todo" wire:key="{{$todo->id}}">
            </livewire:todo.todo-card>
        @endforeach
    </ul>
    {{ $this->todos->links(data: ['scrollTo' => false]) }}
</section>
