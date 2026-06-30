<x-app-layout>
    <x-slot name="header">
        <div class="space-y-2">
            <x-back-link :href="route('projects.issues.index', $project)">Back to issues</x-back-link>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New Issue <span class="text-gray-400">·</span> <span class="text-gray-500">{{ $project->name }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @include('issues._form', ['issue' => $issue, 'project' => $project])
            </div>
        </div>
    </div>
</x-app-layout>
