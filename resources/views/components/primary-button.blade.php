@props(['type' => 'submit'])

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => 'nexpos-button nexpos-button-primary']) }}
>
    {{ $slot }}
</button>