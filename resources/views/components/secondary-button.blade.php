<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-overlay-subtle border border-dark-border rounded-glass-button font-semibold text-sm text-dark-text-secondary hover:text-dark-text hover:border-dark-primary/30 hover:bg-overlay-hover active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary focus-visible:ring-offset-2 focus-visible:ring-offset-dark-bg disabled:opacity-25 transition-all duration-200']) }}>
    {{ $slot }}
</button>
