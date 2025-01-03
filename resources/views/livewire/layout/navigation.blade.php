<aside>
    <div class="w-[20vw] h-[100vh] flex justify-start items-center bg-white fixed">
        <div class="w-full h-full pt-6 bg-bg-light flex flex-col justify-start items-center gap-6">
            <!-- Titre -->
            <p class="text-primary text-2xl font-extrabold">L’Amorce</p>

            <!-- Menu de navigation -->
            <nav class="w-full flex flex-col">
                <ul class=" grid gap-2 p-4 ">
                    <li>
                        <livewire:links.navigation :href="route('dashboard.index')" icon="icons.dashboard" label="Dashboard">
                        </livewire:links.navigation>
                    </li>
                    <li>
                        <livewire:links.navigation :href="route('team.index')" icon="icons.team" label="Team">
                        </livewire:links.navigation>
                    </li>
                    <li>
                        <livewire:links.navigation :href="route('draw.index')" icon="icons.nine" label="Les 9">
                        </livewire:links.navigation>
                    </li>
                    <li>
                        <livewire:links.navigation :href="route('calendar.index')" icon="icons.calendar" label="Calendrier">
                        </livewire:links.navigation>
                    </li>
                    <li>
                        <livewire:links.navigation :href="route('stock.index')" icon="icons.stock" label="Stockage">
                        </livewire:links.navigation>
                    </li>
                    <li>
                        <livewire:links.navigation :href="route('accounting.index')" icon="icons.accounting" label="Comptabilité">
                        </livewire:links.navigation>
                    </li>
                    <li>
                        <livewire:links.navigation :href="route('mailing.index')" icon="icons.mailing" label="Mailing">
                        </livewire:links.navigation>
                    </li>
                    <li>
                        <livewire:links.navigation :href="route('todo.index')" icon="icons.todo" label="To Do">
                        </livewire:links.navigation>
                    </li>
                    <li>
                        <livewire:links.navigation :href="route('projects.index')" icon="icons.project" label="Projets">
                        </livewire:links.navigation>
                    </li>
                </ul>
            </nav>

            <!-- Options supplémentaires -->
            <div class="w-full mt-auto flex flex-col gap-4">
                <div class="w-full px-6 py-2 flex items-center gap-4">
                    <span class="text-secondary text-lg font-medium font-['LineAwesome']"></span>
                    <p class="text-secondary text-base font-bold font-['Nunito Sans']">Options</p>
                </div>
                <div class="w-full px-6 py-2 flex items-center gap-4">
                    <span class="text-secondary text-lg font-medium font-['LineAwesome']"></span>
                    <p class="text-secondary text-base font-bold font-['Nunito Sans']">Déconnexion</p>
                </div>
            </div>
        </div>
    </div>
</aside>
