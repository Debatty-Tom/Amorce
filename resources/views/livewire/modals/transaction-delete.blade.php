<section>
    <h2 class="text-xl font-bold mb-4">{{ __('amorce.delete-confirm') }}</h2>
    <p>{{ __('amorce.delete-transaction') }}</p>
    <div class="mt-6 flex justify-end gap-3">
        <x-cancel-button click="cancelDelete"></x-cancel-button>
        <x-confirm-delete-button click="delete"></x-confirm-delete-button>
    </div>
</section>
