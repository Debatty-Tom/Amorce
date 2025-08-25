<section class="space-y-12">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h2 class="text-3xl font-bold text-gray-800">
            {{ $this->fund->title }}
        </h2>
        @hasanyrole(\App\Enums\RolesEnum::ACCOUNTANT->value.'|'.
                            \App\Enums\RolesEnum::ADMIN->value)
        @if($this->fund->trashed())
            <button
                wire:click="unarchiveFund"
                type="button"
                class="w-fit py-3 px-4 bg-red-500 text-white hover:bg-black hover:hover:bg-red-700 transition ease-in text-sm rounded-lg">
                {{ __('amorce.fund-unarchive') }}
            </button>
        @else
            @if($this->fund->id !== 1)
                <div class="flex gap-4">
                    <x-delete-button click="tryDeleteOptions">
                    </x-delete-button>
                    <button
                        x-data="{ model: @js($this->fund) }"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        wire:click.prevent="$dispatch('openModal',{component: 'modals.fund-edit', params: { fund: {{ $this->fund->id }} }})">{{ __('amorce.fund-edit') }}</button>
                </div>
            @endif
        @endif
        @endhasanyrole
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-[2fr,1fr] gap-8">
        @hasanyrole(\App\Enums\RolesEnum::ACCOUNTANT->value.'|'.
                                \App\Enums\RolesEnum::ADMIN->value)
        <section class="p-5 px-8 bg-white rounded-lg ">
            <h3 class="text-2xl font-medium mb-4">{{ __('amorce.create-transaction') }}</h3>
            <form wire:submit.prevent="newTransfer" class="flex flex-col gap-4">
                <div class="grid lg:grid-cols-2 sm:grid-rows-1 gap-4">
                    <div class="flex flex-col gap-2">
                        <x-input-label for="target" value="Fond concerné"/>
                        <select id="target" name="target" wire:model="form.target"
                                class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full box-border">
                            <option value="default" selected>{{ __('amorce.action-choose-fund') }}</option>
                            @foreach($this->funds as $fund)
                                <option value="{{$fund->id}}">{{$fund->title}}</option>
                            @endforeach
                        </select>
                        @error('form.target')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex gap-2 flex-col">
                        <x-input-label for="transaction_type" value="Type de transaction"/>
                        <select name="transaction_type" id="transaction_type" wire:model="form.transaction_type"
                                class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full box-border">
                            <option value="default" selected>{{ __('amorce.action-choose-transaction') }}</option>
                            <option
                                value="{{ \App\Enums\TransactionTypesEnum::DEPOSIT->value }}">{{ __('amorce.misc-deposit') }}</option>
                            <option
                                value="{{ \App\Enums\TransactionTypesEnum::WITHDRAWAL->value }}">{{ __('amorce.misc-withdrawal') }}</option>
                        </select>
                        @error('form.transaction_type')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid lg:grid-cols-3 sm:grid-rows-1 gap-4">
                    <div class="flex gap-2 flex-col">
                        <x-input-label for="donator" value="Nom du donateur"/>
                        <x-text-input id="donator" type="text" placeholder="Nom du donator" wire:model="form.donator"/>
                        @error('form.donator')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex gap-2 flex-col">
                        <x-input-label for="donator_email" value="Email du donateur"/>
                        <x-text-input id="donator_email" type="text" placeholder="Email du donateur"
                                      wire:model="form.donator_email"/>
                        @error('form.donator_email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex gap-2 flex-col">
                        <x-input-label for="amount" value="Montant"/>
                        <x-text-input id="amount" type="text" placeholder="100" wire:model="form.amount"/>
                        @error('form.amount')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex gap-2 flex-col">
                    <x-input-label for="description" value="description"/>
                    <x-text-input id="description" type="text" placeholder="Don vers le fond général"
                                  wire:model="form.description"/>
                    @error('form.description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="px-4 py-3 text-white bg-blue-500 hover:bg-blue-700  transition rounded-lg">
                    {{ __('amorce.action-send-transfer') }}
                </button>
            </form>
        </section>
        @endhasanyrole
        <aside class="p-6 bg-white rounded-2xl shadow-sm">
            <h3 class="text-2xl font-semibold text-gray-800 mb-3">{{ __('amorce.fund-information') }}</h3>
            <div class="space-y-1">
                <p class="text-gray-600 text-sm">{{ __('amorce.form-total-amount') }}</p>
                <p class="text-xl font-bold text-gray-800">{{ $this->amount }}</p>
            </div>
        </aside>
    </div>
    <livewire:transactions.transactions-table :fund="$this->fund">
    </livewire:transactions.transactions-table>
</section>
