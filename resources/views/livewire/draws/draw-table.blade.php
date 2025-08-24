<section class="flex flex-col gap-8">
    <div class="flex justify-between items-center border-b pb-4">
        <h2 class="font-semibold text-3xl text-gray-800">
            {{ __('amorce.draw-from') . ' ' . date_format(($this->draw->date), 'd/m/Y') }}
        </h2>

        @hasanyrole(\App\Enums\RolesEnum::DRAWMANAGER->value.'|'.\App\Enums\RolesEnum::ADMIN->value)
        @if(!$this->draw->trashed())
            <div class="flex gap-3">
                <x-delete-button click="confirmDelete">
                    {{ __('amorce.action-end') }}
                </x-delete-button>
                <button
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl shadow transition"
                    wire:click.prevent="$dispatch('openModal',{component: 'modals.draw-edit', params: { draw: {{ $this->draw->id }} }})">
                    {{ __('amorce.draw-edit') }}
                </button>
            </div>
        @endif
        @endhasanyrole
    </div>

    <div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">
            {{ __('amorce.draw-members') . ' :' }}
        </h3>

        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($this->draw->donators as $member)
                <li class="relative bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex flex-col gap-2 items-center text-center"
                    wire:key="{{$member->id}}">
                    <a href="#" class="absolute inset-0 z-10"></a>

                    <p class="text-lg font-semibold text-gray-800">{{ $member->name }}</p>
                    <p class="text-sm text-gray-500">{{ $member->email }}</p>
                    <p class="text-sm text-gray-500">{{ $member->phone }}</p>
                </li>
            @endforeach
        </ul>
    </div>

    <div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">
            {{ __('amorce.draw-projects') . ' :' }}
        </h3>

        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($this->draw->projects as $project)
                <livewire:project.project-table :project="$project" wire:key="project-{{ $project->id }}">
                </livewire:project.project-table>
            @endforeach
        </ul>
    </div>

    @if($showDeleteModal)
        <div
            x-data
            x-on:keydown.escape.window="$wire.set('showDeleteModal', false)"
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50"
            x-on:click.self="$wire.set('showDeleteModal', false)">
            <div class="bg-white p-6 rounded-2xl shadow-lg w-full max-w-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">{{ __('amorce.archive-confirm') }}</h2>
                <p class="text-gray-600">{{ __('amorce.delete-draw') }}</p>

                <div class="mt-6 flex justify-end gap-3">
                    <x-cancel-button click="cancelDelete" />
                    <x-confirm-delete-button click="tryDeleteOptions" />
                </div>
            </div>
        </div>
    @endif
</section>
