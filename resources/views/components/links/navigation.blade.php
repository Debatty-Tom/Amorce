@props(['active', 'href'])

<a :href="href"  class="w-full px-6 py-2 flex items-center gap-4" >
    {{ $slot }}
</a>

{{--
:class="active ? 'bg-indigo-900 text-white hover:bg-white-100' : 'text-indigo-900 hover:bg-indigo-500 hover:text-white'"--}}
