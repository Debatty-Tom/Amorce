<div>
    <livewire:layout.header
        :title="__('Accounting')"
        :button-text="__('Add a fund')"
        :modal-component="'modals.fund-create'">
    </livewire:layout.header>
    <div>
        <h2>
            {{ __('Principals funds') }}
        </h2>
        <ul class="grid grid-cols-4 gap-4 p-8">
            @foreach($this->principalFunds as $fund)
                <li wire:key="{{$fund->fund_id}}">
                    <livewire:accounting.fund-card :fund="$fund">
                    </livewire:accounting.fund-card>
                </li>
            @endforeach
        </ul>
        <h2>
            {{ __('Specifics funds') }}
        </h2>
        <ul class="grid grid-cols-4 gap-4 p-8">

            @foreach($this->specificFunds as $fund)
                <li wire:key="{{$fund->fund_id}}">
                    <livewire:accounting.fund-card :fund="$fund">
                    </livewire:accounting.fund-card>
                </li>
            @endforeach
        </ul>
    </div>
</div>
