@props(['href'])

<a {{ $attributes->merge([
    'href' => $href,
    'class' => 'inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold text-neutral bg-base-200 ring-1 ring-inset ring-base-300 transition-all duration-300 hover:bg-base-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary'
    ]) }}>
    {{ $slot }}
</a>
