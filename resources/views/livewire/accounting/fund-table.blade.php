<div>
    <div class="flex justify-between mb-5">
        <h2 class="text-3xl font-medium pb-4">
            {{ $this->fund->title }}
        </h2>
        @hasanyrole(\App\Enums\RolesEnum::ACCOUNTANT->value.'|'.
                            \App\Enums\RolesEnum::ADMIN->value)
        @if($this->fund->trashed())
            <button
                wire:click="unarchiveFund"
                type="button"
                class="w-fit py-3 px-4 bg-red-500 text-white hover:bg-black hover:hover:bg-red-700 transition ease-in text-sm rounded-lg">
                Désarchiver ce fond
            </button>
        @else
            <div class="flex gap-4">
                <x-delete-button click="confirmDelete">
                </x-delete-button>
                <button
                    x-data="{ model: @js($this->fund) }"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    wire:click.prevent="$dispatch('openModal',{component: 'modals.fund-edit', params: { fund: {{ $this->fund->id }} }})">{{ __('Edit this fund') }}</button>
            </div>
        @endif
        @endhasanyrole
    </div>
    <div class="grid grid-cols-[75%,1fr] gap-8 mb-8">
        <div class="bg-white rounded p-4">
            <h3 class="text-2xl">
                {{ __('Transfer money') }}
            </h3>
            <p>
                {{ __('Transfer money from this fund to another fund') }}
            </p>
        </div>
        <div class="bg-white rounded p-4">
            <h3 class="text-2xl">
                {{ __('fund information') }}
            </h3>
            <div class="mt-2 mb-2">
                <p>
                    {{ __('Total amount') }}
                </p>
                <p>
                    {{ $this->amount }}
                </p>
            </div>

        </div>
    </div>
    <livewire:transactions.transactions-table :fund="$this->fund">
    </livewire:transactions.transactions-table>

    @if($showDeleteModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div class="bg-white p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4">Confirmer la suppression</h2>
                <p>Êtes-vous sûr de vouloir supprimer ce fond ? Cette action est irréversible.</p>
                <div class="mt-6 flex justify-end gap-3">
                    <x-cancel-button click="cancelDelete"></x-cancel-button>
                    <x-confirm-delete-button click="tryDeleteOptions"></x-confirm-delete-button>
                </div>
            </div>
        </div>
    @endif
</div>
