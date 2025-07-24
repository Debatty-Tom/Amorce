
@php
    $isActive = str_contains(request()->url(), route($href));
@endphp

<li class="relative flex items-center gap-4 p-3 pl-5 rounded-xl {{ $isActive ? 'bg-indigo-300' : 'bg-white' }} hover:bg-indigo-200">
    <x-dynamic-component :component="$icon"/>
    <a href="{{ route($href) }}" class="inset-0 absolute">
    </a>
    {{ $label }}
</li>
