<div>
    <h2 class="text-3xl font-medium pb-4">
        {{ $fund->title }}
    </h2>
    <div class="grid grid-cols-[75%,1fr] gap-8 mb-8">
        <div class="bg-white rounded p-4">
            <h3 class="text-2xl">
                {{ __('Transfer money') }}
            </h3>
            <p>
                {{ __('Transfer money from this fund to another fund') }}
            </p>
        </div>
        <div class="bg-white rounded p-4">
            <h3 class="text-2xl">
                {{ __('fund information') }}
            </h3>
            <div class="mt-2 mb-2">
                <p>
                    {{ __('Total amount') }}
                </p>
                <p>
                    {{ number_format(($fund_view->total_amount/100),2, ',',' ')."€" }}
                </p>
            </div>

        </div>
    </div>
    <livewire:transactions.transactions-table :$fund>
    </livewire:transactions.transactions-table>
</div>
