<div class="max-w-sm w-full p-8 bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md">
    <!-- Icon -->
    <x-icons.folder />
    <!-- Informations personnelles -->
    <p class="text-lg font-bold text-[#202224]">{{ $folder->name }}</p>
    <p class="text-sm font-medium text-[#202224] text-center opacity-60">{{ $folder->description }}</p>
</div>
