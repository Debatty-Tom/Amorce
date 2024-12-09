<div>
    <div>
        <div class="flex justify-between items-center mb-8">
            <h1 class="font-bold text-2xl">
                {{ __('Détentes') }}
            </h1>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click.prevent="$dispatch('openModal',{component: 'modals.draw-create'})">{{ __('Add a new draw') }}</button>
        </div>
        <livewire:draws.draws-list :draws="$draws">
        </livewire:draws.draws-list>
    </div>
    <div>
        <div class="flex justify-between items-center mb-8">
            <h1 class="font-bold text-2xl">
                {{ __('Participants') }}
            </h1>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click.prevent="$dispatch('openModal',{component: 'modals.random-start'})">{{ __('Start a random') }}</button>
        </div>
        <livewire:draws.participant-list>
        </livewire:draws.participant-list>
    </div>
</div>
