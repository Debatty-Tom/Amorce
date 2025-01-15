<section>
    <div class="flex justify-between mb-5">
        <h2 class="text-3xl font-medium">{{__('Accounting')}}</h2>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                wire:click.prevent="$dispatch('openModal',{component: 'modals.draw-create'})">{{ __('Add a new draw') }}</button>
    </div>
    <div>
        <h3 class="text-2xl">
            {{ __('Next draws list') }}
        </h3>
        <livewire:draws.draws-list :draws="$this->nextDraws">
        </livewire:draws.draws-list>
    </div>
    <div>
        <h3 class="text-2xl">
            {{ __('Past draws list') }}
        </h3>
        <livewire:draws.draws-list :draws="$this->pastDraws">
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
</section>
