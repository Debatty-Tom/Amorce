<section class="space-y-12">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold text-gray-800">{{ __('amorce.navigation-profile') }}</h2>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                wire:click.prevent="$dispatch('openCardModal',{component: 'modals.profile-edit'})">{{ __('amorce.misc-edit-profile') }}</button>
    </div>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <div class="flex items-center space-x-6">
                <div class="flex-shrink-0">
                    @if($user->picture_path)
                        <img src="{{ asset($user->picture_path) }}" alt="Profile Picture"
                             class="w-40 h-30 rounded-full">
                    @else
                        <img src="{{ asset('images/default-user.jpg') }}" alt="Default Profile Picture"
                             class="w-24 h-24 rounded-full">
                    @endif
                </div>
                <div>
                    <p class="text-2xl font-semibold text-gray-900">{{ $user->name }}</p>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
