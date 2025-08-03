<article class="w-full p-8 bg-white rounded-lg shadow-md flex flex-row justify-between gap-4">
    <div class="flex flex-col gap-5">
        <h2 class="text-xl font-bold text-black">{{ $slot }}</h2>
        <p class="text-xl font-semibold text-gray-500">{{ $text }}</p>
    </div>
    <div class="relative w-14 h-14">
        <x-dynamic-component :component="$icon"/>
    </div>
</article>
