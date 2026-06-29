@props(['status'])

@php
    $value = $status instanceof \App\Enums\IssueStatus ? $status->value : $status;
    $label = $status instanceof \App\Enums\IssueStatus ? $status->label() : ucfirst((string) $value);
    $classes = match ($value) {
        'open' => 'bg-blue-100 text-blue-800',
        'in_progress' => 'bg-amber-100 text-amber-800',
        'closed' => 'bg-green-100 text-green-800',
        default => 'bg-gray-100 text-gray-800',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium $classes"]) }}>
    {{ $label }}
</span>
