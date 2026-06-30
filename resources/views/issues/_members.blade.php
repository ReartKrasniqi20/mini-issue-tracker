<x-modal name="manage-members" focusable>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">Manage members</h2>
        <p class="mt-1 text-sm text-gray-600">Check to assign, uncheck to remove — saves instantly, no reload.</p>

        <div id="member-manager" data-issue-id="{{ $issue->id }}" class="mt-4 space-y-2 max-h-72 overflow-y-auto">
            @foreach ($allUsers as $user)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox"
                           class="member-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                           data-user-id="{{ $user->id }}"
                           data-user-name="{{ $user->name }}"
                           @checked($issue->members->contains($user->id))>
                    <span class="text-sm text-gray-700">{{ $user->name }}</span>
                </label>
            @endforeach
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">Done</x-secondary-button>
        </div>
    </div>
</x-modal>
