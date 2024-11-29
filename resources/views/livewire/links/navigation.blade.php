
@php($class = "w-full px-6 py-2 flex items-center gap-4"." ". $this->navigationStatement())

<a href="{{$href}}" wire:navigate class="{{$class}}">
    <x-dynamic-component :component="$icon"/>
    <p>{{ $label }}</p>
</a>

