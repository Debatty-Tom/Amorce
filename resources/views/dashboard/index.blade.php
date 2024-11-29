<x-app-layout>
    <div class="flex flex-row h-full p-8 gap-5">
        <!-- component -->
        <livewire:calendar>
        </livewire:calendar>
        <section class="max-w-md w-full h-full flex flex-col justify-between">
            <!-- Section des événements -->
            <div class="w-full flex flex-col gap-6">
                <!-- Prochaine réunion -->
                <article class="w-full p-8 bg-white rounded-lg shadow-md flex flex-row justify-between gap-4">
                    <div class="flex flex-col gap-5">
                        <h2 class="text-xl font-bold text-black">Prochaine réunion</h2>
                        <p class="text-xl font-semibold text-gray-500">13/04/2024</p>
                    </div>
                    <div class="relative w-14 h-14">
                        <x-icons.reunion>
                        </x-icons.reunion>
                    </div>
                </article>

                <!-- Prochain événement -->
                <article class="w-full p-8 bg-white rounded-lg shadow-md flex flex-row justify-between gap-4">
                    <div class="flex flex-col gap-5">
                        <h2 class="text-xl font-bold text-black">Prochain évenement</h2>
                        <p class="text-xl font-semibold text-gray-500">13/04/2024</p>
                    </div>
                    <div class="relative w-14 h-14">
                        <x-icons.reunion>
                        </x-icons.reunion>
                    </div>
                </article>

                <!-- Prochaine détente -->
                <article class="w-full p-8 bg-white rounded-lg shadow-md flex flex-row justify-between gap-4">
                    <div class="flex flex-col gap-5">
                        <h2 class="text-xl font-bold text-black">Prochaine détente</h2>
                        <p class="text-xl font-semibold text-gray-500">13/04/2024</p>
                    </div>
                    <div class="relative w-14 h-14">
                        <x-icons.reunion>
                        </x-icons.reunion>
                    </div>
                </article>
            </div>

            <!-- Tâches attribuées -->
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
</x-app-layout>
