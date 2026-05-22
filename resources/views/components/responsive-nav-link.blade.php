@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center w-full px-3 py-2.5 text-sm font-medium text-dark-text bg-dark-primary/20 border border-dark-primary/30 rounded-xl transition-all duration-200'
            : 'flex items-center w-full px-3 py-2.5 text-sm font-medium text-dark-text-secondary hover:text-dark-text hover:bg-overlay-subtle active:scale-[0.98] focus-visible:ring-2 focus-visible:ring-dark-primary rounded-xl transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
