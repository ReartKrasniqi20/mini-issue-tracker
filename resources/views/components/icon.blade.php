@props(['name'])

<img src="{{ asset('images/svg/' . $name . '.svg') }}" alt="" {{ $attributes->merge(['class' => 'inline-block h-4 w-4']) }}>
