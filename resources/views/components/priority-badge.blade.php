@props(['priority'])

@php
    $value = $priority instanceof \App\Enums\IssuePriority ? $priority->value : $priority;
    $label = $priority instanceof \App\Enums\IssuePriority ? $priority->label() : ucfirst((string) $value);
    $classes = match ($value) {
        'low' => 'bg-gray-100 text-gray-700',
        'medium' => 'bg-amber-100 text-amber-800',
        'high' => 'bg-red-100 text-red-800',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium $classes"]) }}>
    {{ $label }}
</span>
