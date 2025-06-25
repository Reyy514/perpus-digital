@props(['href'])

<a {{ $attributes->merge(['href' => $href, 'class' => 'inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold text-white shadow-lg transition-all duration-300 transform hover:-translate-y-1 bg-primary hover:bg-opacity-90 shadow-primary/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary']) }}>
    {{ $slot }}
</a>
