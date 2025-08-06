<div x-data="{ user_name: @js($project->name) }">
    <h2 class="text-3xl font-bold mb-5 text-indigo-400">
        {{ __('Project details') }}
    </h2>

    <div class="flex flex-col gap-3">
        <p class="text-gray-800 text-xl">{{ $project->title }}</p>
        <p class="text-gray-800">{{ $project->description }}</p>
        <p class="text-gray-800">{{ $project->email }}</p>

        @hasanyrole(\App\Enums\RolesEnum::PROJECTMANAGER->value.'|'.
                            \App\Enums\RolesEnum::ADMIN->value)
        <div class="flex justify-end gap-4">
            <x-delete-button click="confirmDelete">
            </x-delete-button>
            <button
                wire:click.prevent="$dispatch('openModal',{component: 'modals.project-edit', params: { project: { id: {{ $project->id }} } }})"
                class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                {{ __("Edit this project") }}
            </button>
        </div>
        @endhasanyrole
    </div>

    @if($showDeleteModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div class="bg-white p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4">{{ __'Confirmer la suppression' }}</h2>
                <p>{{ __('Êtes-vous sûr de vouloir supprimer ce projet ? Cette action est irréversible.') }}</p>
                <div class="mt-6 flex justify-end gap-3">
                    <x-cancel-button click="cancelDelete"/>
                    <x-confirm-delete-button click="deleteProject"/>
                </div>
            </div>
        </div>
    @endif
</div>
