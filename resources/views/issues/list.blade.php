<div class="bg-white shadow-sm sm:rounded-lg">
    @forelse ($issues as $issue)
        <div data-row-href="{{ route('projects.issues.show', [$project, $issue]) }}"
             class="px-6 py-4 border-b last:border-0 flex items-center justify-between cursor-pointer transition-colors hover:bg-gray-50">
            <div>
                <a href="{{ route('projects.issues.show', [$project, $issue]) }}" class="font-medium text-indigo-600 hover:underline">{{ $issue->title }}</a>
                <div class="mt-1 flex flex-wrap items-center gap-2">
                    <x-status-badge :status="$issue->status" />
                    <x-priority-badge :priority="$issue->priority" />
                    @foreach ($issue->tags as $tag)
                        <x-tag-badge :tag="$tag" />
                    @endforeach
                </div>
            </div>
            <div class="flex items-center gap-4 text-sm text-gray-500 whitespace-nowrap">
                <span>{{ $issue->comments_count }} comments</span>
                @if ($issue->due_date)
                    <span>due {{ $issue->due_date->format('M j') }}</span>
                @endif
            </div>
        </div>
    @empty
        <div class="px-6 py-4 text-gray-500">No issues match these filters.</div>
    @endforelse

    @if ($issues->hasPages())
        <div class="px-6 py-4 border-t">{{ $issues->links() }}</div>
    @endif
</div>
