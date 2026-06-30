<x-modal name="manage-tags" focusable>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">Manage tags</h2>
        <p class="mt-1 text-sm text-gray-600">Check to attach, uncheck to detach. Changes save instantly.</p>

        <div id="tag-manager"
             data-issue-id="{{ $issue->id }}"
             data-options-url="{{ route('tags.options') }}"
             data-tags-url="{{ route('tags.index') }}"
             data-selected-tags='@json($issue->tags->pluck('id')->values())'
             class="mt-4 space-y-2 max-h-72 overflow-y-auto">
            <p class="text-sm text-gray-500">Loading tags...</p>
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">Done</x-secondary-button>
        </div>
    </div>
</x-modal>
