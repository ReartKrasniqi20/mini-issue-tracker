<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('projects.show', $project)" class="mb-2">Back to project</x-back-link>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Issues <span class="text-gray-400">·</span> <span class="text-gray-500">{{ $project->name }}</span>
            </h2>
            <a href="{{ route('projects.issues.create', $project) }}"><x-primary-button><x-icon name="plus" class="mr-1.5" />New issue</x-primary-button></a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash />

            @include('issues._filters')

            <div id="issue-list">
                @include('issues._list')
            </div>
        </div>
    </div>
</x-app-layout>
