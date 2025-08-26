<section class="space-y-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">
        {{ __('amorce.misc-import-csv') }}
    </h2>

    <!-- Import CSV -->
    <form wire:submit.prevent="import"
          class="flex items-end gap-5 bg-white p-6 rounded-xl shadow-lg"
          enctype="multipart/form-data">
        <div class="flex-1">
            <x-input-label for="csvFile" value="{{ __('amorce.misc-csv-file') }}"/>
            <input id="csvFile" type="file" wire:model="form.csvFile" accept=".csv,.txt"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm
                          focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
            @error('form.csvFile')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" wire:loading.attr="disabled" wire:target="import"
                class="px-5 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md
                   hover:bg-black hover:text-amber-400 transition ease-in-out duration-200
                   disabled:opacity-50 disabled:cursor-not-allowed">
            <span wire:loading.remove wire:target="import">
                {{ __('amorce.form-upload-file') }}
            </span>
            <span wire:loading wire:target="import" class="flex items-center">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ __('amorce.misc-processing') ?? 'Traitement...' }}
            </span>
        </button>
    </form>

    <!-- Barre de progression -->
    @if($totalRecords > 0 )
        <div class="bg-white p-4 rounded-xl shadow-lg">
            <div class="flex justify-between items-center text-sm text-gray-600 mb-2">
                <span class="font-medium">{{ __('amorce.import-progress') ?? 'Progression de l\'import' }}</span>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">
                    {{ $processedRecords }}/{{ $totalRecords }}
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                <div class="bg-indigo-600 h-3 transition-all duration-500 ease-out"
                     style="width: {{ $totalRecords > 0 ? ($processedRecords / $totalRecords) * 100 : 0 }}%">
                </div>
            </div>
            <div class="flex justify-between text-xs text-gray-500 mt-2">
                <span>{{ __('amorce.processed') ?? 'Traitées' }}: {{ $processedRecords }}</span>
                <span>{{ round($totalRecords > 0 ? ($processedRecords / $totalRecords) * 100 : 0, 1) }}%</span>
                <span>{{ __('amorce.remaining') ?? 'Restantes' }}: {{ $totalRecords - $processedRecords }}</span>
            </div>
        </div>
    @endif

    <!-- Formulaires de création -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Formulaire Donateur -->
        @if($showDonatorForm)
            <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-amber-400">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800">
                        {{ __('amorce.misc-create-donator') }}
                    </h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    {{ __('amorce.donator-not-found-help') ?? 'Ce donateur n\'a pas été trouvé. Veuillez créer un nouveau donateur.' }}
                </p>

                <form wire:submit.prevent="createDonator" class="space-y-4">
                    <div>
                        <x-input-label for="name" value="{{ __('amorce.form-name') }}" class="required"/>
                        <x-text-input id="name" type="text" wire:model.live="name"
                                      class="mt-1 w-full" required/>
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="email" value="{{ __('amorce.form-email') }}"/>
                        <x-text-input id="email" type="email" wire:model.live="email"
                                      class="mt-1 w-full"/>
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="phone" value="{{ __('amorce.form-phone') }}"/>
                        <x-text-input id="phone" type="tel" wire:model.live="phone"
                                      class="mt-1 w-full"/>
                        @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="address" value="{{ __('amorce.form-address') }}"/>
                        <x-text-input id="address" type="text" wire:model.live="address"
                                      class="mt-1 w-full"/>
                        @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" wire:click="cancelDonatorForm"
                                class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200">
                            {{ __('amorce.form-cancel') ?? 'Annuler' }}
                        </button>
                        <button type="submit" wire:loading.attr="disabled" wire:target="createDonator"
                                class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md
                                       hover:bg-black hover:text-amber-400 transition ease-in-out duration-200
                                       disabled:opacity-50">
                            <span wire:loading.remove wire:target="createDonator">
                                {{ __('amorce.misc-create-donator') }}
                            </span>
                            <span wire:loading wire:target="createDonator">
                                {{ __('amorce.misc-creating') ?? 'Création...' }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <!-- Formulaire Fund -->
        @if($showFundForm)
            <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-400">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800">
                        {{ __('amorce.misc-create-or-attach-fund') }}
                    </h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    {{ __('amorce.fund-selection-help') ?? 'Sélectionnez un fond existant ou créez-en un nouveau.' }}
                </p>

                <form wire:submit.prevent="createOrAssignFund" class="space-y-4">
                    <div>
                        <x-input-label for="type" value="{{ __('amorce.fund-existing') ?? 'Fond existant' }}" />
                        <select id="type" wire:model.live="type"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm
                                       focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">{{ __('amorce.fund-select') }}</option>
                            @foreach($existingFunds as $fund)
                                <option value="{{ $fund->id }}" wire:key="{{ $fund->id }}">
                                    {{ $fund->name }}
                                    <span class="text-gray-500">({{ $fund->type }})</span>
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">{{ __('amorce.or') ?? 'ou' }}</span>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="newFundName" value="{{ __('amorce.fund-new') }}" />
                        <x-text-input type="text" id="newFundName" wire:model.live="newFundName"
                                      placeholder="{{ __('amorce.fund-name') }}"
                                      class="mt-1 w-full"/>
                        @error('newFundName')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" wire:click="cancelFundForm"
                                class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200">
                            {{ __('amorce.form-cancel') ?? 'Annuler' }}
                        </button>
                        <button type="submit" wire:loading.attr="disabled" wire:target="createOrAssignFund"
                                class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md
                                       hover:bg-indigo-700 transition ease-in-out duration-200
                                       disabled:opacity-50">
                            <span wire:loading.remove wire:target="createOrAssignFund">
                                {{ __('amorce.misc-csv-fund-create') }}
                            </span>
                            <span wire:loading wire:target="createOrAssignFund">
                                {{ __('amorce.misc-processing') ?? 'Traitement...' }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <!-- Modal pour donateurs multiples -->
    @if($showMultipleDonatorsModal && count($multipleDonators) > 0)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <h3 class="text-lg font-bold text-gray-900">
                            {{ __('amorce.multiple-donators-found') ?? 'Plusieurs donateurs trouvés' }}
                        </h3>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ __('amorce.select-correct-donator') ?? 'Sélectionnez le bon donateur parmi les options suivantes :' }}
                    </p>

                    <div class="space-y-2 max-h-60 overflow-y-auto">
                        @foreach($multipleDonators as $donator)
                            <div wire:click="selectDonator({{ $donator['id'] }})"
                                 class="p-3 border rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200
                                        hover:border-indigo-300">
                                <div class="font-medium">{{ $donator['name'] }}</div>
                                @if($donator['address'])
                                    <div class="text-sm text-gray-600">{{ $donator['address'] }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between mt-6">
                        <button wire:click="skipRecord"
                                class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200">
                            {{ __('amorce.skip-record') ?? 'Ignorer cet enregistrement' }}
                        </button>
                        <button wire:click="createNewDonatorFromModal"
                                class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition duration-200">
                            {{ __('amorce.create-new-donator') ?? 'Créer un nouveau donateur' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
