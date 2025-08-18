<div>
    <h2 class="text-3xl font-bold mb-5 text-indigo-400">
        {{ __('amorce.fund-edit') }}
    </h2>
    <form wire:submit.prevent="save" enctype="multipart/form-data"
          class="flex flex-col gap-3">
        <div class="flex gap-2 flex-col">
            <x-input-label for="title" value="{{ __('amorce.form-title') }}"/>
            <x-text-input
                id="title"
                type="text"
                wire:model.blur="form.title"
            />
            @error('form.title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="description" value="{{ __('amorce.form-description') }}"/>
            <x-text-input
                id="description"
                type="text"
                wire:model.blur="form.description"
            />
            @error('form.description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div>
            <x-input-label for="type" value="Type"/>
            <select id="type" name="target" wire:model="form.type"
                    class="border-gray-300 focus:border-indigo-400 focus:ring-indigo-400 rounded-md shadow-sm w-full box-border">
                <option value="default">{{ __('amorce.misc-choose-type') }}</option>
                <option value="principal">{{ __('amorce.misc-principal') }}</option>
                <option value="specific">{{ __('amorce.misc-specific') }}</option>
            </select>

            @error('form.type')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div class="flex justify-end">
            <button
                class="w-fit py-3 px-4 bg-indigo-600 text-white hover:bg-black hover:text-amber-400 transition ease-in rounded-lg">
                {{ __('amorce.fund-edit') }}
            </button>
        </div>
    </form>
</div>
