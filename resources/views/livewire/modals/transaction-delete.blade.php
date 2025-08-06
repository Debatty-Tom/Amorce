<div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
    <div class="bg-white p-6 rounded-lg">
        <h2 class="text-xl font-bold mb-4">{{ __('Confirmer la suppression') }}</h2>
        <p>{{ __('Êtes-vous sûr de vouloir annuler cette transaction ? Cette action va créer une transaction inverse.') }}</p>
        <div class="mt-6 flex justify-end gap-3">
            <x-cancel-button click="cancelDelete"></x-cancel-button>
            <x-confirm-delete-button click="delete"></x-confirm-delete-button>
        </div>
    </div>
</div>
