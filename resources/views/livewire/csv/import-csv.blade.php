<section>
    <h2 class="text-3xl">{{__('Import CSV')}}</h2>
    <form wire:submit.prevent="import" class="fex flex-row gap-5" enctype="multipart/form-data">
        <div>
            <x-input-label for="csvFile" value="{{ __('CSV file') }}"/>
            <input
                id="csvFile"
                type="file"
                wire:model="form.csvFile"
                class="rounded"
            />
            @error('form.csvFile')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <button
            class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
            {{ __("Upload file") }}
        </button>
    </form>
    <div class="grid grid-cols-2">
        @if($showDonatorForm)
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">{{ __('Create a donator') }}</h2>
                <form wire:submit.prevent="createDonator" enctype="multipart/form-data">
                    <div class="flex gap-2 flex-col">
                        <x-input-label for="name" value="{{ __('Name') }}"/>
                        <x-text-input
                            id="name"
                            type="text"
                            wire:model.blur="name"
                        />
                        @error('form.name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-input-label for="email" value="{{ __('Email') }}"/>
                        <x-text-input
                            id="email"
                            type="email"
                            wire:model.blur="form.email"
                        />
                        @error('form.email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <x-input-label for="phone" value="{{ __('Phone') }}"/>
                        <x-text-input
                            id="phone"
                            type="tel"
                            wire:model.blur="form.phone"
                        />
                        @error('form.phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <x-input-label for="address" value="{{ __('Address') }}"/>
                        <x-text-input
                            id="address"
                            type="text"
                            wire:model.blur="address"
                        />
                        @error('form.address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex justify-end">
                        <button
                            class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                            {{ __("Create a Donator") }}
                        </button>
                    </div>
                </form>
            </div>
        @endif
            @if($showFundForm)
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">{{ __('Créer ou associer un fonds') }}</h2>
                    <form wire:submit.prevent="createOrAssignFund">
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">{{ __('Type de fonds') }}</label>
                            <select
                                id="type"
                                wire:model="type"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                <option value="">{{ __('Sélectionnez un fonds') }}</option>
                                @foreach ($existingFunds as $fund)
                                    <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                                @endforeach
                            </select>
                            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="newFundName" class="block text-sm font-medium text-gray-700">{{ __('Nouveau fonds') }}</label>
                            <input
                                type="text"
                                id="newFundName"
                                wire:model="newFundName"
                                placeholder="{{ __('Nom du fonds') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            >
                            @error('newFundName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">
                            {{ __('Créer ou associer le fonds') }}
                        </button>
                    </form>
                </div>
            @endif
    </div>

</section>
