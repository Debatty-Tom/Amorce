<div class="flex flex-col h-full p-8 gap-5">
    <h2 class="text-3xl">{{__('Bienvenue ' . auth()->user()->name)}}</h2>
    <section class="w-full h-full flex flex-row justify-between gap-8">
            <livewire:calendar>
            </livewire:calendar>
        <div class="max-w-ld min-w-ld flex flex-col justify-around h-full">
            <div class="w-full flex flex-col gap-6">
                <x-dashboard-card
                    icon="icons.nine"
                    text="{{ $this->draw->date ?? 'Il n’y a pas de réunion prévue prochainement' }}">
                    Prochaine réunion
                </x-dashboard-card>
                <x-dashboard-card
                    icon="icons.todo"
                    text="{{ date_format(Illuminate\Support\Carbon::parse($this->todo->date, 'y-m-d')) ?? 'Vous avez éffectué toutes vos tâches' }}">
                    Prochaine réunion
                </x-dashboard-card>
                <x-dashboard-card
                    icon="icons.nine"
                    text="{{ $this->draw->date ?? 'Il n’y a pas de réunion prévue prochainement' }}">
                    Prochaine réunion
                </x-dashboard-card>
            </div>

            <article class="w-full p-8 bg-white rounded-lg shadow-md flex flex-row justify-between gap-4">
                <div class="flex flex-col gap-5">
                    <h2 class="text-xl font-bold text-black">Tâches attribuées</h2>
                    <p class="text-xl font-semibold text-gray-500">13/04/2024</p>
                </div>
                <div class="relative w-14 h-14">
                    <x-icons.reunion>
                    </x-icons.reunion>
                </div>
            </article>
        </div>
    </section>
</div>
