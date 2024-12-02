<div>
    <h1 class="">
        {{ $fund->title }}
    </h1>
    <div class="grid grid-cols-[75%,1fr] gap-8 mb-8">
        <div class="bg-white rounded p-4">
            <h2>
                {{ __('Transfer money') }}
            </h2>
            <p>
                {{ __('Transfer money from this fund to another fund') }}
            </p>
        </div>
        <div class="bg-white rounded p-4">
            <h2>
                {{ __('fund informations') }}
            </h2>
            <div class="mt-2 mb-2">
                <p>
                    {{ __('Total amount') }}
                </p>
                <p>
                    {{ $fund->total }}
                </p>
            </div>
            <div class="mt-2 mb-2">
                <p>
                    {{ __('account number') }}
                </p>
            </div>
        </div>
    </div>
    <livewire:transactions.transactions-table :$fund>
    </livewire:transactions.transactions-table>
</div>
