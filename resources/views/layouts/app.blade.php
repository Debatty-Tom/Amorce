<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body x-data="navState()" x-init="init()" class="font-sans antialiased font-['Nunito Sans'] bg-gray-100 min-h-screen">
        <h1 class="sr-only">Amorce</h1>
        <button @click="toggleNav()" class="fixed top-8 left-8 z-50 bg-indigo-300 text-black p-2 rounded">
            <template x-if="!openNav">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </template>
            <template x-if="openNav">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </template>
        </button>

        <nav :class="{'-translate-x-full': !openNav, 'translate-x-0': openNav}"
             class="bg-white flex flex-col gap-3 p-4 fixed-nav transition-transform fixed z-40 h-full w-80 overflow-y-auto">
            <livewire:layout.navigation/>
        </nav>
        @livewire('layout.toast')
        <main
            :class="openNav ? 'lg:ml-80 p-8' : 'overflow-y-auto p-20'">
            {{ $slot }}
        </main>
        @livewire('layout.wire-element-modal')
        @livewire('layout.card-modal')
        <script>
            function navState() {
                return {
                    openNav: false,
                    init() {
                        // Charger l'état depuis le localStorage
                        this.openNav = localStorage.getItem('openNav') === 'true';
                    },
                    toggleNav() {
                        this.openNav = !this.openNav;
                        // Sauvegarder l'état dans le localStorage
                        localStorage.setItem('openNav', this.openNav);
                    }
                }
            }
        </script>
    </body>
</html>
