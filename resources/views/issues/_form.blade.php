@php($editing = $issue->exists)

<form method="POST" action="{{ $editing ? route('projects.issues.update', [$project, $issue]) : route('projects.issues.store', $project) }}" class="space-y-6" novalidate>
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <div>
        <x-input-label for="title" value="Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                      :value="old('title', $issue->title)" placeholder="e.g. Login button not working on mobile" required autofocus />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="description" value="Description" />
        <textarea id="description" name="description" rows="5" placeholder="Describe the issue, steps to reproduce, expected vs actual…"
                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('description') input-invalid @enderror">{{ old('description', $issue->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <x-input-label for="status" value="Status" />
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('status') input-invalid @enderror">
                @foreach ($statuses as $status)
                    <option value="{{ $status->value }}" @selected(old('status', $issue->status?->value) === $status->value)>{{ $status->label() }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="priority" value="Priority" />
            <select id="priority" name="priority" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('priority') input-invalid @enderror">
                @foreach ($priorities as $priority)
                    <option value="{{ $priority->value }}" @selected(old('priority', $issue->priority?->value) === $priority->value)>{{ $priority->label() }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('priority')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="due_date" value="Due date" />
            <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full"
                          :value="old('due_date', $issue->due_date?->format('Y-m-d'))" />
            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
        </div>
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $editing ? 'Update issue' : 'Create issue' }}</x-primary-button>
        <a href="{{ $editing ? route('projects.issues.show', [$project, $issue]) : route('projects.issues.index', $project) }}"
           class="text-gray-500 hover:text-gray-700">Cancel</a>
    </div>
</form>
