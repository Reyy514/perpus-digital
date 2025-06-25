@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'w-full 
    border-base-300 
    bg-base-100 
    text-neutral 
    focus:border-primary/50 
    focus:ring-2 
    focus:ring-primary/40 
    rounded-lg 
    shadow-sm 
    transition-all 
    duration-300
    disabled:bg-base-200
    disabled:cursor-not-allowed'
]) !!}>
