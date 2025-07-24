<section>
    <div class="flex justify-between mb-5">
        <h2 class="text-3xl">{{__('Accounting')}}</h2>
        <div class="gap-5">
            @hasanyrole(\App\Enums\RolesEnum::ACCOUNTANT->value.'|'.
                        \App\Enums\RolesEnum::ADMIN->value)
            <a href="{{ route('csv.index') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Import CSV') }}</a>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    wire:click.prevent="$dispatch('openModal',{component: 'modals.fund-create'})">{{ __('Add a fund') }}</button>
            @endhasanyrole
        </div>
    </div>
    <div>
        <h3>
            {{ __('Principals funds') }}
        </h3>
        <ul class="grid grid-cols-4 gap-4 p-8">
            @foreach($this->principalFunds as $fund)
                <li wire:key="{{$fund->fund_id}}">
                    <livewire:accounting.fund-card :fund="$fund">
                    </livewire:accounting.fund-card>
                </li>
            @endforeach
        </ul>
        <h3>
            {{ __('Specifics funds') }}
        </h3>
        <ul class="grid grid-cols-4 gap-4 p-8">
            @foreach($this->specificFunds as $fund)
                <li wire:key="{{$fund->fund_id}}">
                    <livewire:accounting.fund-card :fund="$fund">
                    </livewire:accounting.fund-card>
                </li>
            @endforeach
        </ul>
        <h3>
            {{ __('Archived funds') }}
        </h3>
        <ul class="grid grid-cols-4 gap-4 p-8">
            @foreach($this->archivedFunds as $fund)
                <li wire:key="{{$fund->fund_id}}">
                    <livewire:accounting.fund-card :fund="$fund">
                    </livewire:accounting.fund-card>
                </li>
            @endforeach
        </ul>
    </div>
</section>
