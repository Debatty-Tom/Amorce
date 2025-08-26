<li class="flex flex-col gap-3 bg-white p-5 rounded-2xl relative shadow-md hover:shadow-lg transition @if($this->todo->trashed()) opacity-50 @endif">

    <a href="#" class="absolute inset-0 z-10 rounded-2xl"
       x-data="{ model: @js($this->todo) }"
       wire:click.prevent="$dispatch('openCardModal',{component: 'modals.todo-show', params: { id: {{ $this->todo->id }} }})">
        <span class="sr-only">{{ __('amorce.todo-see') }}</span>
    </a>

    <p class="text-lg font-semibold text-gray-800 truncate">
        {{ $this->todo->title }}
    </p>

    <p class="text-sm text-gray-600 line-clamp-3">
        {{ \Illuminate\Support\Str::limit($this->todo->description, 100) }}
    </p>

    <div class="text-sm text-gray-700">
        <p class="font-semibold">{{ __('amorce.todo-members') }}</p>
        @if($this->todo->users && $this->todo->users->count())
            <ul class="pl-4 list-disc space-y-1 mt-1">
                @foreach($this->todo->users as $user)
                    @if($user->trashed())
                        <li class="list-none">
                            <span class="bg-red-100 text-red-700 text-xs font-medium px-2 py-0.5 rounded">
                                {{ __('amorce.todo-deleted-user') }}
                            </span>
                        </li>
                    @else
                        <li>{{ $user->name }}</li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>

    <div class="text-sm text-gray-700">
        <p class="font-semibold">{{ __('amorce.todo-assigned-by') }} :</p>
        <p class="text-gray-600">
            {{ $this->todo->assignments[0]->assignedBy->name ?? __('amorce.message-unknown') }}
        </p>
    </div>
</li>
