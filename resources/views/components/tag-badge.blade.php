@props(['tag'])

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium text-white']) }}
      style="background-color: {{ $tag->color ?? '#6b7280' }}">
    {{ $tag->name }}
</span>
