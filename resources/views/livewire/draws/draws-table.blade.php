<div>
    <div>
        <div class="flex justify-between items-center mb-8">
            <h1 class="font-bold text-2xl">
                {{ __('Détentes') }}
            </h1>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    wire:click.prevent="$dispatch('openModal',{component: 'modals.draw-create'})">{{ __('Add a new draw') }}</button>
        </div>
        <div>
            <h2>
                {{ __('Next draws list') }}
            </h2>
            <livewire:draws.draws-list :draws="$this->nextDraws" >
            </livewire:draws.draws-list>
        </div>
        <div>
            <h2>
                {{ __('Last draws list') }}
            </h2>
            <livewire:draws.draws-list :draws="$this->pastDraws" >
            </livewire:draws.draws-list>
        </div>
        <div class="mt-4">
            <div class="flex justify-between items-center mb-8">
                <h1 class="font-bold text-2xl">
                    {{ __('Participants') }}
                </h1>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        wire:click.prevent="$dispatch('openModal',{component: 'modals.donator-create'})">{{ __('Add a new donator') }}
                </button>
            </div>
        </div>
    </div>
</div>
