<aside>
    <div class="w-[15vw] h-[100vh] flex justify-start items-center bg-white">
        <div class="w-full h-full pt-6 bg-bg-light flex flex-col justify-start items-center gap-6">
            <!-- Titre -->
            <p class="text-primary text-2xl font-extrabold">L’Amorce</p>

            <!-- Menu de navigation -->
            <nav class="w-full flex flex-col gap-4">
                <ul>
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



{{--
<aside>
    <div class="w-[239px] h-[1070px] justify-start items-center inline-flex">
        <div class="w-[239px] h-[1070px] pt-[23px] bg-white flex-col justify-start items-center gap-9 inline-flex">
            <p class="text-[#4880ff] text-2xl font-extrabold font-['Nunito Sans']">L’Amorce</p>
            <nav class="self-stretch h-[450px] flex-col justify-start items-start flex">
                <div class="self-stretch h-[50px] px-[25px] py-3 bg-white justify-start items-center gap-4 inline-flex">
                    <div class="w-[190px] h-[50px] px-4 bg-[#4880ff] rounded-lg justify-start items-center gap-4 flex">
                        <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                            <div class="text-center text-white text-[22px] font-medium font-['LineAwesome']"></div>
                        </div>
                        <div class="grow shrink basis-0 h-[22px] justify-center items-center gap-2.5 flex">
                            <p class="grow shrink basis-0 text-white text-base font-bold font-['Nunito Sans']">DashboardController</p>
                        </div>
                    </div>
                </div>
                <div class="self-stretch h-[50px] px-10 py-3 bg-white justify-start items-center gap-4 inline-flex">
                    <div class="justify-start items-center gap-4 flex">
                        <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                            <div class="text-center text-[#202224] text-[22px] font-medium font-['LineAwesome']"></div>
                        </div>
                        <p class="text-[#202224] text-base font-bold font-['Nunito Sans']">Team</p>
                    </div>
                </div>
                <div class="self-stretch h-[50px] px-10 py-3 bg-white justify-start items-center gap-4 inline-flex">
                    <div class="justify-start items-center gap-4 flex">
                        <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                            <div class="text-center text-[#202224] text-[22px] font-medium font-['LineAwesome']"></div>
                        </div>
                        <p class="text-[#202224] text-base font-bold font-['Nunito Sans']">Les 9</p>
                    </div>
                </div>
                <div class="self-stretch h-[50px] px-10 py-3 bg-white justify-start items-center gap-4 inline-flex">
                    <div class="justify-start items-center gap-4 flex">
                        <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                            <div class="text-center text-[#202224] text-[22px] font-medium font-['LineAwesome']"></div>
                        </div>
                        <p class="text-[#202224] text-base font-bold font-['Nunito Sans']">Calendrier</p>
                    </div>
                </div>
                <div class="self-stretch h-[50px] px-10 py-3 bg-white justify-start items-center gap-4 inline-flex">
                    <div class="justify-start items-center gap-4 flex">
                        <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                            <div class="text-center text-[#202224] text-[22px] font-medium font-['LineAwesome']"></div>
                        </div>
                        <p class="text-[#202224] text-base font-bold font-['Nunito Sans']">Stockage</p>
                    </div>
                </div>
                <div class="self-stretch h-[50px] px-10 py-3 bg-white justify-start items-center gap-4 inline-flex">
                    <div class="justify-start items-center gap-4 flex">
                        <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                            <div class="text-center text-[#202224] text-[22px] font-medium font-['LineAwesome']"></div>
                        </div>
                        <p class="text-[#202224] text-base font-bold font-['Nunito Sans']">Comptabilité</p>
                    </div>
                </div>
                <div class="self-stretch h-[50px] px-10 py-3 bg-white justify-start items-center gap-4 inline-flex">
                    <div class="justify-start items-center gap-4 flex">
                        <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                            <div class="text-center text-[#202224] text-[22px] font-medium font-['LineAwesome']"></div>
                        </div>
                        <p class="text-[#202224] text-base font-bold font-['Nunito Sans']">Mailing</p>
                    </div>
                </div>
                <div class="self-stretch h-[50px] px-10 py-3 bg-white justify-start items-center gap-4 inline-flex">
                    <div class="justify-start items-center gap-4 flex">
                        <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                            <div class="text-center text-[#202224] text-[22px] font-medium font-['LineAwesome']"></div>
                        </div>
                        <p class="text-[#202224] text-base font-bold font-['Nunito Sans']">To-Do</p>
                    </div>
                </div>
                <div class="self-stretch h-[50px] px-10 py-3 bg-white justify-start items-center gap-4 inline-flex">
                    <div class="justify-start items-center gap-4 flex">
                        <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                            <div class="text-center text-[#202224] text-[22px] font-medium font-['LineAwesome']"></div>
                        </div>
                        <p class="text-[#202224] text-base font-bold font-['Nunito Sans']">Projets</p>
                    </div>
                </div>
            </nav>
            <div class="self-stretch h-[411px] pt-[290px] flex-col justify-start items-start gap-5 flex">
                <div class="self-stretch h-[100px] flex-col justify-start items-start flex">
                    <div class="self-stretch h-[50px] px-10 py-3 bg-white justify-start items-center gap-4 inline-flex">
                        <div class="justify-start items-center gap-4 flex">
                            <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                                <div class="text-center text-[#202224] text-[22px] font-medium font-['LineAwesome']"></div>
                            </div>
                            <p class="text-[#202224] text-base font-bold font-['Nunito Sans']">Options</p>
                        </div>
                    </div>
                    <div class="self-stretch h-[50px] px-10 py-3 bg-white justify-start items-center gap-4 inline-flex">
                        <div class="justify-start items-center gap-4 flex">
                            <div class="w-[22px] h-6 flex-col justify-center items-center inline-flex">
                                <div class="text-center text-[#202224] text-[22px] font-medium font-['LineAwesome']"></div>
                            </div>
                            <p class="text-[#202224] text-base font-bold font-['Nunito Sans']">Déconnexion</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
--}}
