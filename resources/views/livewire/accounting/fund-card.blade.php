    <div class="max-w-sm w-full p-8 bg-white rounded-2xl flex flex-col items-center gap-2 shadow-md relative">
        <a class="absolute inset-0" href="{{ route('accounting.show', $fund->id) }}"></a>
        <!-- Informations personnelles -->
        <p class="text-lg font-bold text-[#202224]">{{ $fund->title }}</p>
        <p class="text-sm font-medium text-[#202224] text-center opacity-60">{{ $fund->description }}</p>
        <p class="text-[#4880ff] text-[46px] font-extrabold">{{ number_format(($fund->total/100),2, ',',' ')."€" }}</p>
        <p class="text-[#4880ff] text-base font-bold">Voir le fond</p>
    </div>
