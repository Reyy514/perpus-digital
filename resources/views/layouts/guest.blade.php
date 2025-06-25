<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans text-neutral dark:text-dark-neutral antialiased">
        <div class="min-h-screen lg:grid lg:grid-cols-2 bg-base-100 dark:bg-dark-base-200">
            <!-- Form Panel -->
            <div class="flex flex-col items-center justify-center px-6 py-12 lg:px-8">
                <div class="w-full max-w-sm">
                    <div class="mb-8 text-center">
                        <a href="/">
                            <x-application-logo class="w-20 h-20 mx-auto fill-current text-primary" />
                        </a>
                    </div>
                    {{ $slot }}
                </div>
            </div>

            <!-- Decorative Panel -->
            <div class="hidden lg:block relative">
                <div class="absolute inset-0 bg-gradient-to-br from-primary to-accent opacity-80 dark:opacity-70"></div>
                <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=2070&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/1035x1552/111827/E0E0E0?text=PerpusDigital';" class="h-full w-full object-cover" alt="[Tumpukan buku di perpustakaan]">
                <div class="absolute inset-0 bg-black/30"></div>
                <div class="absolute bottom-10 left-10 right-10 p-6 bg-black/50 backdrop-blur-sm rounded-lg">
                    <h2 class="text-2xl font-bold text-white">"Satu-satunya hal yang benar-benar Anda miliki adalah cerita Anda."</h2>
                    <p class="mt-2 text-white/80">- Brené Brown</p>
                </div>
            </div>
        </div>
    </body>
</html>