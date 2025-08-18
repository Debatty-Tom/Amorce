<div class="max-w-sm h-64 w-full p-8 bg-white rounded-2xl flex flex-col justify-between gap-2 shadow-md relative">
    <a class="absolute inset-0 z-10" href="{{ route('accounting.show', $fund->fund_id) }}"></a>
    <div class="flex flex-col items-center">
        <h4 class="text-lg font-bold text-[#202224]">{{ $fund->titleLimited }}</h4>
        <p class="text-sm font-medium text-[#202224] text-center opacity-60">{{ $fund->descriptionLimited }}</p>
    </div>
    <div class="flex flex-col items-center pb-3 gap-4">
        <p class="text-[#4880ff] text-[46px] font-extrabold ">{{ $fund->amount }}</p>
        <p class="text-[#4880ff] text-base font-bold">{{ __('amorce.fund-see') }}</p>
    </div>
</div>

