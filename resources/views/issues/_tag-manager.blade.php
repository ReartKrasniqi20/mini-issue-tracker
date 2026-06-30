<x-modal name="manage-tags" focusable>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">Manage tags</h2>
        <p class="mt-1 text-sm text-gray-600">Check to attach, uncheck to detach — saves instantly, no reload.</p>

        <div id="tag-manager" data-issue-id="{{ $issue->id }}" class="mt-4 space-y-2 max-h-72 overflow-y-auto">
            @forelse ($allTags as $tag)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox"
                           class="tag-checkbox issue-manager-checkbox rounded border-black text-gray-900 focus:ring-0 focus:ring-offset-0"
                           data-tag-id="{{ $tag->id }}"
                           data-tag-name="{{ $tag->name }}"
                           data-tag-color="{{ $tag->color }}"
                           @checked($issue->tags->contains($tag->id))>
                    <x-tag-badge :tag="$tag" />
                </label>
            @empty
                <p class="text-sm text-gray-500">
                    No tags exist yet. <a href="{{ route('tags.index') }}" class="text-indigo-600 hover:underline">Create some first</a>.
                </p>
            @endforelse
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">Done</x-secondary-button>
        </div>
    </div>
</x-modal>
