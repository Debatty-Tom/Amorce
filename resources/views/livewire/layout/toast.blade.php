<div
    x-data="{
        openAlert: @entangle('openAlert'),
    }"
    x-init="$watch('openAlert', value => {
        if (value) {
            setTimeout(() => openAlert = false, 3000);
        }
    })"
    x-show="openAlert"
    x-transition.opacity.duration.500ms
    class="bg-green-200 border-green-600 text-green-600 border-l-4 p-4 fixed top-5 right-0 shadow-md rounded-md z-50"
    role="alert"
>
    <p class="font-bold">Succès</p>
    <p>{{ $message }}</p>
</div>
