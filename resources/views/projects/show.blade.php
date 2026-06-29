<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $project->name }}</h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('projects.issues.index', $project) }}"><x-secondary-button>Manage issues</x-secondary-button></a>
                <a href="{{ route('projects.issues.create', $project) }}"><x-primary-button>New issue</x-primary-button></a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash />

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex items-start justify-between">
                    <div class="space-y-4">
                        <p class="text-gray-700 whitespace-pre-line">{{ $project->description ?: 'No description.' }}</p>
                        <dl class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                            <div><dt class="text-gray-500">Owner</dt><dd class="text-gray-800">{{ $project->owner?->name ?? '—' }}</dd></div>
                            <div><dt class="text-gray-500">Issues</dt><dd class="text-gray-800">{{ $project->issues_count }}</dd></div>
                            <div><dt class="text-gray-500">Start date</dt><dd class="text-gray-800">{{ $project->start_date?->format('M j, Y') ?? '—' }}</dd></div>
                            <div><dt class="text-gray-500">Deadline</dt><dd class="text-gray-800">{{ $project->deadline?->format('M j, Y') ?? '—' }}</dd></div>
                        </dl>
                    </div>
                    @can('update', $project)
                        <a href="{{ route('projects.edit', $project) }}" class="text-gray-500 hover:text-gray-700">Edit</a>
                    @endcan
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b font-medium text-gray-700">Issues</div>
                @forelse ($issues as $issue)
                    <div class="px-6 py-4 border-b last:border-0 flex items-center justify-between">
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
                        <div class="text-sm text-gray-500">{{ $issue->comments_count }} comments</div>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-500">No issues yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
