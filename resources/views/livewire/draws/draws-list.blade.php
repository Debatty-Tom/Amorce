<li class="relative bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6 flex flex-col gap-4">
    <a href="{{ route('draw.show', $this->draw->id) }}" wire:navigate class="absolute inset-0 z-0"></a>

    <div class="flex justify-between text-sm text-gray-600">
        <div>
            <p class="font-medium">{{ __('amorce.form-date') }}</p>
            <p class="text-gray-800">{{ $this->draw->date->format('d/m/Y') }}</p>
        </div>
        <div>
            <p class="font-medium">{{ __('amorce.form-amount') }}</p>
            <p class="text-gray-800 font-semibold">{{ $this->amount }}</p>
        </div>
    </div>

    <div class="space-y-2">
        <p class="font-medium text-gray-700">{{ __('amorce.page-projects') }}</p>
        <ul class="pl-5 list-disc text-gray-600 text-sm">
            @foreach($this->draw->projects as $project)
                <li>
                    {{ $project->title }}
                    @if($project->pivot->amount > 0)
                        <span class="text-blue-600">: {{ $project->pivot->amount }}€</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</li>
