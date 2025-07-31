<div>
    <h2 class="text-3xl font-bold mb-5 text-indigo-400">
        {{ __('Todo details') }}
    </h2>
    <div class="flex flex-col gap-3">
        <p class="text-gray-700 font-semibold">{{ $todo->title }}</p>

        <p class="text-gray-700">{{ $todo->description }}</p>

        <div class="flex justify-between">
            <div class="flex flex-col gap-1 w-1/2">
                <p class="text-gray-800 font-semibold">{{ __('Final date') }}:</p>
                <p class="text-gray-700">{{ \Carbon\Carbon::parse($todo->date)->format('d/m/Y') }}</p>
            </div>
            <div class="flex flex-col gap-1 w-1/2">
                <p class="text-gray-800 font-semibold">{{ __('Assigned by') }}:</p>
                <p class="text-gray-700">{{ $todo->assignments[0]->assignedBy->name ?? 'inconnu' }}</p>
            </div>
        </div>
        <div>
            <p class="text-gray-800 font-semibold">{{ __('Assigned Users') }}:</p>
            <ul class="list-disc pl-5">
                @foreach ($todo->users as $user)
                    <li class="text-gray-700">{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>

        @if(auth()->user()->hasRole(\App\Enums\RolesEnum::ADMIN->value) || auth()->id() === $todo->assignments[0]->assignedBy->id)
            <div class="flex justify-end gap-4 mt-4">
                <x-delete-button click="confirmDelete"/>
                <button
                    wire:click.prevent="$dispatch('openModal',{component: 'modals.todo-edit', params: { todo: { id: {{ $todo->id }} } }})"
                    class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                    {{ __('Edit this todo') }}
                </button>
            </div>
        @endif
    </div>

    @if($showDeleteModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div class="bg-white p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4">Confirmer la suppression</h2>
                <p>Êtes-vous sûr de vouloir supprimer ce todo ? Cette action est irréversible.</p>
                <div class="mt-6 flex justify-end gap-3">
                    <x-cancel-button click="cancelDelete"/>
                    <x-confirm-delete-button click="deleteTodo"/>
                </div>
            </div>
        </div>
    @endif
</div>
