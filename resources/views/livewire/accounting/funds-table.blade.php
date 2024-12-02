<div>
    <h1>
        {{ __('Hello accounting') }}
    </h1>
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
