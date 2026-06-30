@props(['disabled' => false])

@php
    $field = $attributes->get('name');
    $invalid = $field && $errors->has($field);
@endphp

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-gray-400 focus:ring-0 rounded-md shadow-sm' . ($invalid ? ' input-invalid' : '')]) }}>
