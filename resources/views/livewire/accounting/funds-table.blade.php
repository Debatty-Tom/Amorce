<div>
    <div class="flex justify-between align-middle">
        <h1>
            {{ __('Hello accounting') }}
        </h1>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click.prevent="$dispatch('openModal',{component: 'modals.fund-create'})">{{ __('Add a fund') }}
        </button>
    </div>
    <h2>
        {{ __('Principals funds') }}
    </h2>
    <ul class="grid grid-cols-4 gap-4 p-8">
        @foreach($principalFunds as $fund)
            <li>
                <livewire:accounting.fund-card :fund="$fund">
                </livewire:accounting.fund-card>
            </li>
        @endforeach
    </ul>
    <h2>
        {{ __('Specifics funds') }}
    </h2>
    <ul class="grid grid-cols-4 gap-4 p-8">
        @foreach($specificFunds as $fund)
            <li>
                <livewire:accounting.fund-card :fund="$fund">
                </livewire:accounting.fund-card>
            </li>
        @endforeach
    </ul>
</div>
