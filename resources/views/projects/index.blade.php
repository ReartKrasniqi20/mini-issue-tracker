<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Projects') }}</h2>
            <a href="{{ route('projects.create') }}">
                <x-primary-button><x-icon name="plus" class="mr-1.5" />New Project</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($projects->isEmpty())
                    <div class="p-6 text-gray-500">No projects yet. Create your first one.</div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issues</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($projects as $project)
                                <tr>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('projects.show', $project) }}" class="font-medium text-indigo-600 hover:underline">
                                            {{ $project->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $project->owner?->name ?? '—' }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $project->issues_count }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $project->deadline?->format('M j, Y') ?? '—' }}</td>
                                    <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                        @can('update', $project)
                                            <a href="{{ route('projects.edit', $project) }}" class="text-gray-500 hover:text-gray-700">Edit</a>
                                            <form method="POST" action="{{ route('projects.destroy', $project) }}" class="inline"
                                                  onsubmit="return confirm('Delete this project?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-500 hover:text-red-700">Delete</button>
                                            </form>
                                        @else
                                            <span class="text-gray-300">—</span>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div>{{ $projects->links() }}</div>
        </div>
    </div>
</x-app-layout>
