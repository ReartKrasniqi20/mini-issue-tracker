<x-app-layout>
    <x-slot name="header">
        <div class="space-y-2">
            <x-back-link :href="route('projects.show', $project)">Back to project</x-back-link>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Project</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @include('projects.form', ['project' => $project])
            </div>
        </div>
    </div>
</x-app-layout>
