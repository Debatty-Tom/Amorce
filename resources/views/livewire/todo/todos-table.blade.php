<section class="flex flex-col gap-6">
    <div class="flex flex-wrap justify-between items-center gap-4">
        <div class="flex flex-wrap items-center gap-6">
            <h2 class="text-3xl font-semibold text-gray-800">{{ __('amorce.page-todos') }}</h2>
            <div class="flex flex-wrap items-center gap-3">
                <x-search-field>
                    searches.todo
                </x-search-field>
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
