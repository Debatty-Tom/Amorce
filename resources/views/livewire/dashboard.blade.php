<div class="flex flex-col h-full p-8 gap-5">
    <h2 class="text-3xl">{{__('Bienvenue ' . auth()->user()->name)}}</h2>
    <section class="w-full h-full flex flex-row justify-between gap-8">
        <livewire:calendar>
        </livewire:calendar>
        <div class="w-full max-w-80 flex flex-col gap-6">
            @php
                $redirect = $this->draw ? route('draw.show', ['id' => $this->draw->id]) : null;
            @endphp
            <x-dashboard-card
                icon="icons.nine"
                text="{{ $this->draw?->date?->format('d/m/Y') ?? 'Il n’y a pas de réunion prévue prochainement' }}"
                redirect="{{$redirect}}">
                Prochaine réunion
            </x-dashboard-card>
            <x-dashboard-card
                icon="icons.calendar"
                text="{{ $this->todo?->date?->format('d/m/Y') ?? 'Il n’y a pas d’événement prévu prochainement' }}">
                Prochain événement
            </x-dashboard-card>
            @php
                $click = $this->todo
                    ? "dispatch('openCardModal', {component: 'modals.todo-show', params: { id: {$this->todo->id} }})"
                    : null;
            @endphp
            <x-dashboard-card
                icon="icons.todo"
                text="{{ $this->todo?->date?->format('d/m/Y') ?? 'Vous avez éffectué toutes vos tâches'}}"
                :click="$click">
                Prochaine tâche
            </x-dashboard-card>
        </div>
    </section>
</div>
