<div class="space-y-6">
    <h2 class="text-xl font-bold">Maintenant que la détente est terminée, il faut attribuer le budget aux différents
        projets!</h2>
    <p class="text-gray-700">💰 Solde disponible : <strong>{{ $this->amount }}</strong></p>

    @error('redistributions') <p class="text-red-600">test</p> @enderror
    @foreach($this->draw->projects as $project)
        <div class="border p-4 rounded shadow-sm">
            <h3 class="font-semibold">{{ $project->title }}</h3>
            @if($project->pivot->status === \App\Enums\EnumsDrawAssignmentsStatuses::pending->value)
                <div x-data="{ value: 0 }" class="flex items-center gap-4 mt-2">
                    <input
                        type="range"
                        min="0"
                        max="{{ $this->rangeMax }}"
                        step="0.01"
                        class="w-full"
                        x-model.number="value"
                    />

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        :max="{{ $this->rangeMax }}"
                        class="border p-2 rounded w-24"
                        x-model.number="value"
                    />

                    <button
                        type="button"
                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-800"
                        @click="$wire.assign({{ $project->id }}, value)">
                        Attribuer
                    </button>
                </div>
            @else
                <p class="text-gray-500 mt-2">Budget déjà attribué : {{ $project->pivot->amount }} €</p>
            @endif
        </div>
    @endforeach


    <div class="mt-6 flex justify-end">
        <button
            wire:click="deleteDraw"
            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">
            Fermer
        </button>
    </div>
</div>
