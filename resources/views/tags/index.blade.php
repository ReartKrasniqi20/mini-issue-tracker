<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tags') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash />

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-700 mb-4">New tag</h3>
                <form method="POST" action="{{ route('tags.store') }}" class="flex flex-wrap items-end gap-4">
                    @csrf
                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-56"
                                      :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="color" value="Color" />
                        <input id="color" name="color" type="color" value="{{ old('color', '#6b7280') }}"
                               class="mt-1 block h-10 w-16 rounded border-gray-300" />
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>
                    <x-primary-button>Add tag</x-primary-button>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b font-medium text-gray-700">All tags</div>
                @forelse ($tags as $tag)
                    <div class="px-6 py-4 border-b last:border-0 flex items-center justify-between">
                        <x-tag-badge :tag="$tag" />
                        <span class="text-sm text-gray-500">{{ $tag->issues_count }} issues</span>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-500">No tags yet. Add your first one above.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
