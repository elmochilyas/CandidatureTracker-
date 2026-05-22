@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-dark-text-secondary']) }}>
    {{ $value ?? $slot }}
</label>
