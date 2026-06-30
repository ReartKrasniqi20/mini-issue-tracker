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
                    <div class="flex items-center justify-between mb-1">
                        <div class="text-xs font-medium text-gray-500 uppercase">Tags</div>
                        <x-secondary-button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'manage-tags')">
                            Manage tags
                        </x-secondary-button>
                    </div>
                    <div id="issue-tags" class="flex flex-wrap gap-2">
                        @forelse ($issue->tags as $tag)
                            <x-tag-badge :tag="$tag" />
                        @empty
                            <span class="text-sm text-gray-400">No tags</span>
                        @endforelse
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <div class="text-xs font-medium text-gray-500 uppercase">Members</div>
                        <x-secondary-button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'manage-members')">
                            Manage members
                        </x-secondary-button>
                    </div>
                    <div id="issue-members" class="flex flex-wrap gap-2">
                        @forelse ($issue->members as $member)
                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs text-gray-700">{{ $member->name }}</span>
                        @empty
                            <span class="text-sm text-gray-400">No members</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6" id="comments" data-issue-id="{{ $issue->id }}">
                <h3 class="font-medium text-gray-700 mb-4">Comments (<span id="comments-count">{{ $issue->comments_count }}</span>)</h3>

                <form id="comment-form" class="space-y-3 mb-6">
                    <div>
                        <x-input-label for="body" value="Add a comment" />
                        <textarea id="body" name="body" rows="3"
                                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                        <p class="mt-1 text-sm text-red-600 hidden" data-error="body"></p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">Commenting as {{ auth()->user()->name }}</span>
                        <x-primary-button>Add comment</x-primary-button>
                    </div>
                </form>

                <div id="comments-list" class="space-y-4"></div>

                <p id="comments-empty" class="text-gray-400 hidden">No comments yet.</p>
                <div class="mt-4">
                    <button type="button" id="load-more-comments" class="text-indigo-600 hover:underline hidden">
                        Load more comments
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('issues._tag-manager')
    @include('issues._members')
</x-app-layout>
