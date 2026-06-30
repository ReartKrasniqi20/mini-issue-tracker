<x-modal name="manage-members" focusable>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">Manage members</h2>
        <p class="mt-1 text-sm text-gray-600">Check to assign, uncheck to remove — saves instantly, no reload.</p>

        <div id="member-manager"
             data-issue-id="{{ $issue->id }}"
             data-options-url="{{ route('users.options') }}"
             data-selected-users='@json($issue->members->pluck('id')->values())'
             class="mt-4 space-y-2 max-h-72 overflow-y-auto">
            <p class="text-sm text-gray-500">Loading members...</p>
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">Done</x-secondary-button>
        </div>
    </div>
</x-modal>
