<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Deleted projects</h2>
            <a href="{{ route('projects.index') }}"><x-secondary-button>Back to projects</x-secondary-button></a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($projects->isEmpty())
                    <div class="p-6 text-gray-500">Trash is empty.</div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issues</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deleted</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($projects as $project)
                                <tr>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $project->name }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $project->owner?->name ?? '—' }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $project->issues_count }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $project->deleted_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 text-right space-x-4 whitespace-nowrap">
                                        @can('restore', $project)
                                            <form method="POST" action="{{ route('projects.restore', $project) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button class="text-indigo-600 hover:text-indigo-800">Restore</button>
                                            </form>
                                        @endcan
                                        @can('forceDelete', $project)
                                            <form method="POST" action="{{ route('projects.force', $project) }}" class="inline"
                                                  onsubmit="return confirm('Permanently delete this project and its issues? This cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:text-red-800">Delete permanently</button>
                                            </form>
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
