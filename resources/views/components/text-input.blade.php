@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-glass-input bg-dark-surface border border-dark-border px-4 py-3 text-sm text-dark-text placeholder-dark-text-secondary/50 focus:outline-none focus:border-dark-primary-hover focus:ring-2 focus:ring-dark-primary-hover/20 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed file:mr-3 file:rounded-lg file:border-0 file:bg-dark-primary/20 file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-dark-primary hover:file:bg-dark-primary/30']) }}>
