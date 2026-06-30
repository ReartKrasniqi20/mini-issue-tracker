@php($editing = $project->exists)

<form method="POST" action="{{ $editing ? route('projects.update', $project) : route('projects.store') }}" class="space-y-6" novalidate>
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <div>
        <x-input-label for="name" value="Name" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                      :value="old('name', $project->name)" placeholder="e.g. Marketing Website" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="description" value="Description" />
        <textarea id="description" name="description" rows="4" placeholder="What is this project about?"
                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('description') input-invalid @enderror">{{ old('description', $project->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <x-input-label for="start_date" value="Start date" />
            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
                          :value="old('start_date', $project->start_date?->format('Y-m-d'))" />
            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="deadline" value="Deadline" />
            <x-text-input id="deadline" name="deadline" type="date" class="mt-1 block w-full"
                          :value="old('deadline', $project->deadline?->format('Y-m-d'))" />
            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
        </div>
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $editing ? 'Update project' : 'Create project' }}</x-primary-button>
        <a href="{{ $editing ? route('projects.show', $project) : route('projects.index') }}"
           class="text-gray-500 hover:text-gray-700">Cancel</a>
    </div>
</form>
