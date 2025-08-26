<li class="relative w-full max-w-sm h-64 bg-white rounded-2xl shadow-md p-6 flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    <a class="absolute inset-0 z-10" href="{{ route('accounting.show', $fund->fund_id) }}"></a>
    <div class="flex flex-col items-center gap-2">
        <p class="text-xl font-semibold text-gray-800 text-center">
            {{ $fund->titleLimited }}
        </p>
        <p class="text-sm text-gray-500 text-center line-clamp-2">
            {{ $fund->descriptionLimited }}
        </p>
    </div>
    <p class="text-4xl font-extrabold text-[#4880ff] tracking-tight text-center">
        {{ $fund->amount }}
    </p>
    <div class="flex flex-col items-center gap-2">
        <span class="inline-block text-sm font-medium text-[#4880ff] bg-[#4880ff]/10 px-3 py-1 rounded-full">
            {{ __('amorce.fund-see') }}
        </span>
    </div>
</li>
