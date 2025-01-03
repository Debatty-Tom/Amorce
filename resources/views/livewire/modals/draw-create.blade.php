<div class="main-content md:flex-1 md:overflow-y-auto absolute">
    <template x-if="$wire.feedback && $wire.loading == false">
        <div class="flex items-center justify-between mb-8 max-w-3xl bg-green-500 rounded w-full top-6 left-24 absolute"
        >
            <div class="dissolve flex items-center">
                <svg class="shrink-0 ml-4 mr-2 w-4 h-4 fill-white"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20">
                    <polygon points="0 11 2 9 7 14 18 3 20 5 7 18"></polygon>
                </svg>
                <div x-html="$wire.feedback" class="py-4 text-white text-sm font-medium"></div>
            </div>
            <button type="button" @click="$wire.feedback = false" class="group mr-2 p-2">
                <svg class="block w-2 h-2 fill-green-800 group-hover:fill-white"
                     xmlns="http://www.w3.org/2000/svg"
                     width="235.908"
                     height="235.908"
                     viewBox="278.046 126.846 235.908 235.908">
                    <path
                        d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z"></path>
                </svg>
            </button>
        </div>
    </template>

    <div>
        <h1 class="mb-8 text-3xl font-bold">
            <a class="text-indigo-400 hover:text-indigo-600"
               href="{{ route('accounting.index') }}" wire:navigate>New Draw
            </a>
        </h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form wire:submit="save">
                <div class="flex flex-wrap justify-between -mb-8 -mr-6 p-8">
                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <label class="form-label"
                               for="text-input-7125169c-f0d4-4660-9ec1-2371fdbb1ea2">Title:</label>
                        <input id="text-input-7125169c-f0d4-4660-9ec1-2371fdbb1ea2"
                               class="form-input"
                               type="text"
                               wire:model.blur="form.title"
                        >
                        @error('form.title') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <label class="form-label"
                               for="text-input-7af247c0-2f45-4fd1-a651-a7a1ca2b3bb4">Description:</label>
                        <input id="text-input-7af247c0-2f45-4fd1-a651-a7a1ca2b3bb4"
                               class="form-input"
                               type="text"
                               wire:model.blur="form.description"
                        >
                        @error('form.description') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <label class="form-label"
                               for="text-input-7af247c0-2f45-4fd1-a651-a7a1ca2b3bb4">Amount:</label>
                        <input id="text-input-7af247c0-2f45-4fd1-a651-a7a1ca2b3bb4"
                               class="form-input"
                               step="0.01"
                               type="number"
                               wire:model.blur="form.amount"
                        >
                        @error('form.amount') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="pb-8 pr-6 w-full lg:w-1/2">
                        <label class="form-label"
                               for="text-input-7af247c0-2f45-4fd1-a651-a7a1ca2b3bb4">Date:</label>
                        <input id="text-input-7af247c0-2f45-4fd1-a651-a7a1ca2b3bb4"
                               class="form-input"
                               type="date"
                               wire:model.blur="form.date"
                        >
                        @error('form.date') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-between">
                        <p class="pb-8 pr-6 w-full lg:w-1/2">
                            Les 3 nouveaux participants
                        </p>
                        @if(count($this->form->new_participants) === 0)
                            <button wire:click.prevent="randomParticipants"
                                    class="flex items-center btn-indigo ml-auto">
                                Lancer le random
                            </button>
                        @endif

                    </div>
                    <ul>
                        @if(count($this->form->new_participants) > 0)
                            @foreach($this->form->new_participants as $participant)
                                <li wire:key="{{ $participant->id }}">
                                    {{ $participant->name }}
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <button @click="$wire.spinner = true" class="flex items-center btn-indigo ml-auto"
                            type="submit">
                        <template x-if="$wire.spinner == true">
                            <div class="btn-spinner mr-2.5" x-data="{
                                            init(){
                                                setTimeout(function(){
                                                    $wire.spinner = false;
                                                    $wire.loading = false;
                                                }, 500);
                                            }
                                        }">
                            </div>
                        </template>
                        Create a draw
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>


