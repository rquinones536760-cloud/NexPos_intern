@props(['type' => 'button'])

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => 'nexpos-button nexpos-button-secondary']) }}
>
    {{ $slot }}
</button>