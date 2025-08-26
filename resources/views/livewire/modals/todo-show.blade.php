<section>
    <h2 class="text-3xl font-bold mb-5 text-indigo-400">
        {{ __('amorce.todo-details') }}
    </h2>
    <div class="flex flex-col gap-3">
        <p class="text-gray-700 font-semibold">{{ $todo->title }}</p>

        <p class="text-gray-700">{{ $todo->description }}</p>

        <div class="flex justify-between">
            <div class="flex flex-col gap-1 w-1/2">
                <p class="text-gray-800 font-semibold">{{ __('amorce.form-final-date') }}:</p>
                <p class="text-gray-700">{{ \Carbon\Carbon::parse($todo->date)->format('d/m/Y') }}</p>
            </div>
            <div class="flex flex-col gap-1 w-1/2">
                <p class="text-gray-800 font-semibold">{{ __('amorce.misc-assigned-by') }}:</p>
                <p class="text-gray-700">{{ $todo->assignments[0]->assignedBy->name ?? __('amorce.message-unknown') }}</p>
            </div>
        </div>
        <div>
            <p class="text-gray-800 font-semibold">{{ __('amorce.misc-assigned-users') }}:</p>
            <ul class="list-disc pl-5">
                @foreach ($todo->users as $user)
                    @if($user->trashed())
                        <span
                            class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded">{{ __('amorce.todo-deleted-user') }}</span>
                    @else
                        <li class="text-gray-700">{{ $user->name }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        @if(auth()->user()->hasRole(\App\Enums\RolesEnum::ADMIN->value) || auth()->id() === $todo->assignments[0]->assignedBy->id && !$todo->trashed())
            <div class="flex justify-end gap-4 mt-4">
                <x-delete-button click="confirmDelete"/>
                <button
                    wire:click.prevent="$dispatch('openModal',{component: 'modals.todo-edit', params: { id: {{ $todo->id }} }})"
                    class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                    {{ __('amorce.todo-edit') }}
                </button>
            </div>
        @endif
    </div>

    @if($showDeleteModal)
        <div
            x-data
            x-on:keydown.escape.window="$wire.set('showDeleteModal', false)"
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50"
            x-on:click.self="$wire.set('showDeleteModal', false)">
            <div class="bg-white p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4">{{ __('amorce.delete-confirm') }}</h2>
                <p>{{ __('amorce.delete-todo') }}</p>
                <div class="mt-6 flex justify-end gap-3">
                    <x-cancel-button click="cancelDelete"/>
                    <x-confirm-delete-button click="deleteTodo"/>
                </div>
            </div>
        </div>
    @endif
</section>
