<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>

    @forelse ($events as $event)
        <div class="mb-4 p-4 bg-white shadow rounded">
            <h3 class="text-lg font-semibold">{{ $event['title'] }}</h3>
            <p class="text-gray-600">{{ $event['description'] ?? __('amorce.message-no-description') . '.' }}</p>
        </div>
    @empty
        <p>{{ __('amorce.dashboard-no-events') . '.' }}</p>
    @endforelse
</div>
