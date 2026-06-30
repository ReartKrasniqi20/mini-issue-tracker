<form method="GET" action="{{ route('projects.issues.index', $project) }}" id="issue-filters"
      class="bg-white shadow-sm sm:rounded-lg p-4 flex flex-wrap items-end gap-4">
    <div>
        <x-input-label for="q" value="Search" />
        <x-text-input id="q" name="q" type="search" class="mt-1 block w-56"
                      :value="$filters['q'] ?? ''" placeholder="Title or description" />
    </div>

    <div>
        <x-input-label for="status" value="Status" />
        <select id="status" name="status" class="mt-1 block border-gray-300 focus:border-gray-400 focus:ring-0 rounded-md shadow-sm">
            <option value="">All</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}" @selected(($filters['status'] ?? '') === $status->value)>{{ $status->label() }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <x-input-label for="priority" value="Priority" />
        <select id="priority" name="priority" class="mt-1 block border-gray-300 focus:border-gray-400 focus:ring-0 rounded-md shadow-sm">
            <option value="">All</option>
            @foreach ($priorities as $priority)
                <option value="{{ $priority->value }}" @selected(($filters['priority'] ?? '') === $priority->value)>{{ $priority->label() }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <x-input-label for="tag" value="Tag" />
        <select id="tag" name="tag" class="mt-1 block border-gray-300 focus:border-gray-400 focus:ring-0 rounded-md shadow-sm">
            <option value="">All</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" @selected((string) ($filters['tag'] ?? '') === (string) $tag->id)>{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex items-center gap-2">
        <x-primary-button>Filter</x-primary-button>
        <a href="{{ route('projects.issues.index', $project) }}" class="text-gray-500 hover:text-gray-700">Reset</a>
    </div>
</form>
