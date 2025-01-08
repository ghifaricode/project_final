@props(['value'])

<label
    {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700 mb-1 transition duration-300 hover:text-primary cursor-pointer']) }}>
    {{ $value ?? $slot }}
</label>
