<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="font-bold text-2xl">
            {{ __('To do') }}
        </h1>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click.prevent="$dispatch('openModal',{component: 'modals.todo-create'})">{{ __('Add a todo') }}</button>
    </div>
    <ul class="flex gap-3 flex-col ">
        @foreach($todos as $todo)
            <li class="flex justify-between gap-3 bg-white p-4 rounded">
                <p class="min-w-20">
                    {{ $todo->title }}
                </p>
                <p class="max-w-screen-lg">
                    {{ $todo->description }}
                </p>
            </li>
        @endforeach
    </ul>
</div>
