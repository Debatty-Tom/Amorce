<div class="max-w-sm w-full bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md">
    <!-- Image de couverture -->
    <div class="relative w-full h-0 pb-[76.67%] rounded-t-2xl overflow-hidden bg-[#db6262]">
        <img
            class="absolute inset-0 w-full h-full object-cover"
            src="https://via.placeholder.com/812x541"
            alt="Team member"
        />
    </div>
    <!-- Informations personnelles -->
    <p class="text-center text-[#202224] text-lg font-bold">{{ $user->name }}</p>
    <p class="opacity-60 text-center text-[#202224] text-sm font-normal">
        {{ $user->email }}
    </p>
    <p class="opacity-60 text-center text-[#202224] text-sm font-normal">
        {{ $user->name }}
    </p>
    <!-- Bouton -->
    <div class="mt-2 w-3/5 p-4">
        <button class="w-full py-2 rounded-md border border-[#979797] text-[#767676] text-sm font-bold">
            Voir les rôles
        </button>
    </div>
</div>
