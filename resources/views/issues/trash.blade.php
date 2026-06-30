<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('projects.issues.index', $project)" class="mb-2">Back to issues</x-back-link>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Deleted issues <span class="text-gray-400">·</span> <span class="text-gray-500">{{ $project->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash />

            <div class="bg-white shadow-sm sm:rounded-lg">
                @forelse ($issues as $issue)
                    <div class="px-6 py-4 border-b last:border-0 flex items-center justify-between gap-4">
                        <div>
                            <div class="font-medium text-gray-900">{{ $issue->title }}</div>
                            <div class="mt-1 flex flex-wrap items-center gap-2">
                                <x-status-badge :status="$issue->status" />
                                <x-priority-badge :priority="$issue->priority" />
                                @foreach ($issue->tags as $tag)
                                    <x-tag-badge :tag="$tag" />
                                @endforeach
                                <span class="text-xs text-gray-400">deleted {{ $issue->deleted_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 whitespace-nowrap">
                            <form method="POST" action="{{ route('issues.restore', $issue) }}">
                                @csrf
                                @method('PATCH')
                                <button class="text-sm text-indigo-600 hover:text-indigo-800">Restore</button>
                            </form>
                            <form method="POST" action="{{ route('issues.force', $issue) }}"
                                  onsubmit="return confirm('Permanently delete this issue? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm text-red-600 hover:text-red-800">Delete permanently</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-500">No deleted issues.</div>
                @endforelse
            </div>

            <div>{{ $issues->links() }}</div>
        </div>
    </div>
</x-app-layout>
