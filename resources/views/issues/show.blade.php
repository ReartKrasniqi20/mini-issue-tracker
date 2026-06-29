<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $issue->title }}</h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('projects.issues.edit', [$project, $issue]) }}"><x-secondary-button>Edit</x-secondary-button></a>
                <form method="POST" action="{{ route('projects.issues.destroy', [$project, $issue]) }}" onsubmit="return confirm('Delete this issue?')">
                    @csrf
                    @method('DELETE')
                    <x-danger-button>Delete</x-danger-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash />

            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <x-status-badge :status="$issue->status" />
                    <x-priority-badge :priority="$issue->priority" />
                    <span class="text-sm text-gray-500">in
                        <a href="{{ route('projects.show', $issue->project) }}" class="text-indigo-600 hover:underline">{{ $issue->project->name }}</a>
                    </span>
                    @if ($issue->due_date)
                        <span class="text-sm text-gray-500">· due {{ $issue->due_date->format('M j, Y') }}</span>
                    @endif
                </div>

                <p class="text-gray-700 whitespace-pre-line">{{ $issue->description ?: 'No description.' }}</p>

                <div>
                    <div class="text-xs font-medium text-gray-500 uppercase mb-1">Tags</div>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($issue->tags as $tag)
                            <x-tag-badge :tag="$tag" />
                        @empty
                            <span class="text-sm text-gray-400">No tags</span>
                        @endforelse
                    </div>
                </div>

                <div>
                    <div class="text-xs font-medium text-gray-500 uppercase mb-1">Members</div>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($issue->members as $member)
                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs text-gray-700">{{ $member->name }}</span>
                        @empty
                            <span class="text-sm text-gray-400">No members</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-700 mb-4">Comments ({{ $issue->comments_count }})</h3>

                <div class="space-y-4">
                    @forelse ($comments as $comment)
                        <div class="border-b last:border-0 pb-3">
                            <div class="text-sm font-medium text-gray-800">{{ $comment->author_name }}</div>
                            <div class="text-gray-700 whitespace-pre-line">{{ $comment->body }}</div>
                            <div class="text-xs text-gray-400 mt-1">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                    @empty
                        <p class="text-gray-400">No comments yet.</p>
                    @endforelse
                </div>

                <div class="mt-4">{{ $comments->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
