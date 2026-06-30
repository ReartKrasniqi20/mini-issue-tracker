<x-app-layout>
    <x-slot name="header">
        <div class="space-y-2">
            <x-back-link :href="route('tags.index')">Back to tags</x-back-link>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Tag') }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('tags.update', $tag) }}" class="flex flex-wrap items-start gap-4" novalidate>
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-56 h-11"
                                      :value="old('name', $tag->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="color" value="Color" />
                        <x-text-input id="color" name="color" type="text" data-coloris readonly
                                      class="mt-1 block w-36 cursor-pointer pr-10 h-11" :value="old('color', $tag->color ?? '#6b7280')" />
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label class="invisible" aria-hidden="true">Save</x-input-label>
                        <div class="mt-1 flex items-center gap-3">
                            <x-primary-button class="h-11">Save changes</x-primary-button>
                            <a href="{{ route('tags.index') }}"><x-secondary-button type="button" class="h-11">Cancel</x-secondary-button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
