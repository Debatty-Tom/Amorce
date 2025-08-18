<section>
    <div class="flex justify-between mb-5">
        <h2 class="font-medium text-3xl pb-3">
            {{ __('amorce.draw-from') . ' ' .date_format(($this->draw->date), 'd/m/Y') }}
        </h2>
        @hasanyrole(\App\Enums\RolesEnum::DRAWMANAGER->value.'|'.
                            \App\Enums\RolesEnum::ADMIN->value)
            @if(!$this->draw->trashed())
                <div>
                    <x-delete-button click="confirmDelete">
                    </x-delete-button>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            wire:click.prevent="$dispatch('openModal',{component: 'modals.draw-edit', params: { draw: {{ $this->draw->id }} }})">{{ __('amorce.draw-edit') }}</button>
                </div>
            @endif
        @endhasanyrole
    </div>
    <div>
        <h3 class="text-2xl mb-2">
            {{ __('amorce.draw-members') . ' :' }}
        </h3>
        <ul class="grid grid-cols-4 gap-5 mb-4">
            @foreach($this->draw->donators as $member)
                <li class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3"
                    wire:key="{{$member->id}}">
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
                </li>
            @endforeach
        </ul>
    </div>
    <div>
        <h3 class="text-2xl mb-2">
            {{ __('amorce.draw-projects') . ' :' }}
        </h3>
        <ul class="grid grid-cols-4 gap-5">
            @foreach($this->draw->projects as $project)
                <li class="flex justify-center" wire:key="{{$project->title}}">
                    <div
                        class="relative max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md p-3">
                        <p class="text-center text-[#202224] text-lg font-bold">{{ $project->title }}</p>
                        <p>
                            {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    @if($showDeleteModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div class="bg-white p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4">{{ __('amorce.archive-confirm') }}</h2>
                <p>{{ __('amorce.delete-fund') }}</p>
                <div class="mt-6 flex justify-end gap-3">
                    <x-cancel-button click="cancelDelete"></x-cancel-button>
                    <x-confirm-delete-button click="tryDeleteOptions"></x-confirm-delete-button>
                </div>
            </div>
        </div>
    @endif
</section>
