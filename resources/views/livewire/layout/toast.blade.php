<div
    x-data="{ openAlert: @entangle('openAlert'), type: @entangle('type') }"
    x-init="$watch('openAlert', value => { if(value) setTimeout(() => openAlert = false, 3000) })"
    x-show="openAlert"
    x-transition.opacity.duration.500ms
    :class="type === 'valid' ? 'bg-green-200 border-green-600 text-green-600' : 'bg-red-200 border-red-600 text-red-600'"
    class="border-l-4 p-4 fixed top-5 right-0 shadow-md rounded-md z-50"
    role="alert"
>
    <p class="font-bold" x-text="type === 'valid' ? '{{ __('amorce.message-success') }}' : '{{ __('amorce.message-error') }}'"></p>
    <p>{{ $this->message }}</p>
</div>
