@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-dark-text bg-dark-primary/20 border border-dark-primary/30 shadow-glow nav-active-indicator transition-all duration-200'
            : 'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-dark-text-secondary hover:text-dark-text hover:bg-overlay-subtle active:scale-[0.98] focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
