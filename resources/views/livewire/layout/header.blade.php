<header>
    <div class="w-full h-[10vh] flex flex-col justify-start items-start">
        <!-- Barre de navigation principale -->
        <nav class="w-full bg-white flex justify-between items-center">
            <!-- Section de recherche -->
            <div class="flex items-center gap-6 px-8 py-4 bg-white">
                <!-- Icône du menu -->
                <button class="opacity-90 w-[1.5em] h-[1.25em]" aria-label="Menu">
                    <span class="text-center text-primary text-lg font-medium font-['LineAwesome']"></span>
                </button>

                <!-- Barre de recherche -->
                <div class="relative w-[25vw] h-[2.5em]">
                    <input
                        type="text"
                        class="w-full h-full bg-bg-light rounded-full border border-border-light pl-[2.5em] pr-4 py-2 text-base text-primary font-normal font-['Nunito Sans'] placeholder-opacity-50"
                        placeholder="Search"
                        aria-label="Search"
                    />
                    <span class="absolute left-4 top-2 opacity-50">
                        <!-- Icône de recherche (ex. icône SVG ou FontAwesome) -->
                    </span>
                </div>
            </div>

            <!-- Section utilisateur -->
            <div class="flex items-center gap-6 px-8 py-4 bg-white">
                <!-- Notifications -->
                <div class="relative w-[2em] h-[2em]">
                    <button class="relative w-[2em] h-[2em]" aria-label="Notifications">
                        <img
                            src="https://via.placeholder.com/24x18"
                            alt="Notifications"
                            class="absolute w-full h-auto top-0"
                        />
                        <span
                            class="absolute w-[0.4em] h-[0.4em] bg-alert rounded-sm opacity-50 top-[1.2em] left-[0.6em]"
                            aria-hidden="true"
                        ></span>
                        <span
                            class="absolute left-[1.2em] top-0 text-white text-xs font-bold font-['Nunito Sans']"
                        >
                            6
                        </span>
                    </button>
                </div>

                <!-- Profil utilisateur -->
                <div class="flex items-center gap-6">
                    <!-- Avatar -->
                    <div class="w-[3em] h-[3em] relative">
                        <img
                            src="https://via.placeholder.com/50x52"
                            alt="User avatar"
                            class="absolute w-full h-full top-0 left-0 object-cover"
                        />
                    </div>
                    <!-- Nom de l'utilisateur -->
                    <p class="text-neutral-700 text-base font-normal font-['Nunito Sans']">
                        Moni Roy
                    </p>
                    <!-- Icône déroulante -->
                    <button
                        class="w-[1em] h-[1em] flex items-center justify-center"
                        aria-label="Menu déroulant"
                    >
                        <span class="w-[0.4em] h-[0.2em] bg-neutral-500"></span>
                    </button>
                </div>
            </div>
        </nav>
    </div>
</header>
