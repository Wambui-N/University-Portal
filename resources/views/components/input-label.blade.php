@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm label-text']) }}>
    {{ $value ?? $slot }}
</label>
