<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tags') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash />

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-700 mb-4">New tag</h3>
                <form method="POST" action="{{ route('tags.store') }}" class="flex flex-wrap items-start gap-4" novalidate>
                    @csrf
                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-56 h-11"
                                      :value="old('name')" placeholder="e.g. backend, urgent" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="color" value="Color" />
                        <x-text-input id="color" name="color" type="text" data-coloris readonly
                                      class="mt-1 block w-36 cursor-pointer pr-10 h-11" :value="old('color', '#6b7280')" />
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label class="invisible" aria-hidden="true">Add</x-input-label>
                        <x-primary-button class="mt-1 h-11"><x-icon name="plus" class="mr-1.5" />Add tag</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b font-medium text-gray-700">All tags</div>
                @forelse ($tags as $tag)
                    <div class="px-6 py-4 border-b last:border-0 flex items-center justify-between gap-4">
                        <x-tag-badge :tag="$tag" />
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-500">{{ $tag->issues_count }} issues</span>
                            <a href="{{ route('tags.edit', $tag) }}" class="text-sm text-gray-500 hover:text-gray-700">Edit</a>
                            <form method="POST" action="{{ route('tags.destroy', $tag) }}" class="inline"
                                  onsubmit="return confirm('Delete this tag?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-500">No tags yet. Add your first one above.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
