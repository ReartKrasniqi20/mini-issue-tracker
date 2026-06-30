@props(['href', 'active' => false])

@php
    $base = 'inline-flex items-center h-16 border-b-2 text-sm font-medium transition-colors';
    $state = $active
        ? 'border-gray-900 text-gray-900'
        : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-800';
@endphp

<a href="{{ $href }}" @if ($active) aria-current="page" @endif
   {{ $attributes->merge(['class' => "$base $state"]) }}>
    {{ $slot }}
</a>
