<div class="flex flex-col h-full gap-5">
    <h2 class="text-3xl">{{ __('Bienvenue ' . auth()->user()->name) }}</h2>

    <section class="w-full h-[65vh] overflow-hidden">
        <div class="h-full">
            <livewire:appointments-calendar
                week-starts-at="1"
                calendar-view="calendar.calendar"
                day-of-week-view="calendar.days-name"
                day-view="calendar.day"
                event-view="calendar.event"
                :event-click-enabled="false"
            />
        </div>
    </section>

    <section class="flex justify-between w-full flex-row gap-6">
        @php
            $redirect = $this->draw ? route('draw.show', ['id' => $this->draw->id]) : null;
        @endphp

        <x-dashboard-card
            icon="icons.nine"
            text="{{ $this->draw?->date?->format('d/m/Y') ?? 'Il n’y a pas de réunion prévue prochainement' }}"
            :redirect="$redirect">
            {{ __('Prochaine réunion') }}
        </x-dashboard-card>

        @php
            $click = $this->nextEvent
                ? "dispatch('openCardModal', {component: 'modals.event-show', params: { id: {$this->nextEvent->id}, date: '{$this->nextEvent->date?->format('Y-m-d')}' }})"
                : null;
        @endphp

        <x-dashboard-card
            icon="icons.calendar"
            text="{{ $this->nextEvent?->date?->format('d/m/Y') ?? 'Il n’y a pas d’événement prévu prochainement' }}"
            :click="$click">
            {{ __('Prochain événement') }}
        </x-dashboard-card>

        @php
            $click = $this->todo
                ? "dispatch('openCardModal', {component: 'modals.todo-show', params: { id: {$this->todo->id} }})"
                : null;
        @endphp

        <x-dashboard-card
            icon="icons.todo"
            text="{{ $this->todo?->date?->format('d/m/Y') ?? 'Vous avez effectué toutes vos tâches'}}"
            :click="$click">
            {{ __('Prochaine tâche') }}
        </x-dashboard-card>
    </section>
</div>
