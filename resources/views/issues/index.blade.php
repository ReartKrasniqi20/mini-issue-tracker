<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('projects.show', $project)" class="mb-2">Back to project</x-back-link>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Issues <span class="text-gray-400">·</span> <span class="text-gray-500">{{ $project->name }}</span>
            </h2>
            <div class="flex items-center gap-4">
                <a href="{{ route('projects.issues.trash', $project) }}"
                   class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 h-10 px-4 text-sm font-medium text-red-600 transition-colors hover:bg-red-100">Deleted issues</a>
                <a href="{{ route('projects.issues.create', $project) }}"><x-primary-button><x-icon name="plus" class="mr-1.5" />New issue</x-primary-button></a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash />

            @include('issues.filters')

            <div id="issue-list">
                @include('issues.list')
            </div>
        </div>
    </div>
</x-app-layout>
