<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Perpustakaan Digital - Gerbang Ilmu Pengetahuan Modern</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
        
        <!-- Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Dark Mode Initializer -->
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Custom Style for subtle effects -->
        <style>
            .glow-card::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(800px circle at var(--mouse-x) var(--mouse-y), rgba(127, 90, 240, 0.1), transparent 40%);
                border-radius: inherit;
                opacity: 0;
                transition: opacity 0.5s;
                z-index: 0;
            }
            .glow-card:hover::before {
                opacity: 1;
            }
            .content-wrapper {
                position: relative;
                z-index: 1;
            }
        </style>

    </head>
    <body class="antialiased bg-base-100 text-neutral transition-colors duration-300">
        
        <!-- Background Gradient -->
        <div class="absolute top-0 left-0 -z-10 h-full w-full bg-white dark:bg-base-100">
            <div class="absolute top-0 left-0 h-full w-full bg-[radial-gradient(circle_800px_at_100%_200px,#d5c5ff,transparent)] dark:bg-[radial-gradient(circle_800px_at_100%_200px,#7f5af020,transparent)]"></div>
        </div>

        <!-- Header -->
        <header class="bg-base-100/80 dark:bg-base-100/80 backdrop-blur-sm fixed top-0 left-0 w-full z-50 border-b border-base-300">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <a href="/" class="flex items-center gap-2 group text-primary">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-library-big-icon lucide-library-big"><rect width="8" height="18" x="3" y="3" rx="1"/><path d="M7 3v18"/><path d="M20.4 18.9c.2.5-.1 1.1-.6 1.3l-1.9.7c-.5.2-1.1-.1-1.3-.6L11.1 5.1c-.2-.5.1-1.1.6-1.3l1.9-.7c.5-.2 1.1.1 1.3.6Z"/></svg>
                    </div>

                    {{-- Container untuk Teks Logo --}}
                    <div class="flex flex-col">
                        <span class="text-xl font-extrabold tracking-tight text-neutral">
                            Perpustakaan
                        </span>
                        <span class="text-sm font-medium -mt-1 text-secondary">
                            Digital
                        </span>
                    </div>
                </a>
                <nav class="flex items-center gap-2 sm:gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium rounded-lg hover:bg-base-200 transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hidden sm:block px-4 py-2 text-sm font-medium rounded-lg hover:bg-base-200 transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-lg shadow-primary/30 hover:bg-opacity-90 transition-all">Register</a>
                            @endif
                        @endauth
                    @endif
                    <x-theme-toggle />
                </nav>
            </div>
        </header>

        <main>
            <!-- Hero Section -->
            <section class="relative min-h-screen flex items-center pt-24 pb-12 overflow-hidden">
                <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
                    <div class="text-center md:text-left">
                        <span class="text-sm font-bold uppercase text-primary tracking-widest">PERPUSTAKAAN DIGITAL MODERN</span>
                        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mt-4 leading-tight text-neutral">
                            Buka Wawasan,
                            <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Jelajahi Dunia.</span>
                        </h1>
                        <p class="mt-6 text-lg text-neutral/70">Jelajahi ribuan koleksi buku, jurnal, dan sumber daya digital langsung dari perangkat Anda, kapan saja dan di mana saja.</p>
                        <div class="mt-10 flex flex-col sm:flex-row justify-center md:justify-start gap-4">
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-lg shadow-primary/40 hover:bg-opacity-90 transform hover:scale-105 transition-all duration-300">Mulai Menjelajah</a>
                            <a href="#fitur" class="px-8 py-3 bg-base-200 font-semibold rounded-lg shadow-sm hover:bg-base-300 transition-colors">Lihat Fitur</a>
                        </div>
                    </div>
                    <div class="hidden md:flex justify-center items-center">
                        <div class="relative w-full max-w-md h-96">
                            <!-- Floating Book Images -->
                            <img src="https://res.cloudinary.com/dbk8bwtnq/image/upload/c_fill,w_200,h_280/v1750831435/4158694a946d856a699a683556703d4f_a3km8t.jpg"  alt="[Sampul buku mengambang 1]" class="absolute top-0 left-0 rounded-lg shadow-2xl transform rotate-[-15deg] hover:rotate-[-5deg] hover:scale-110 transition-transform duration-500">
                            <img src="https://res.cloudinary.com/dbk8bwtnq/image/upload/c_fill,w_200,h_280/v1750831436/d4b7deedcc516a67973bd8f5704d3988_ywtmec.jpg" alt="[Sampul buku mengambang 2]" class="absolute bottom-0 right-0 rounded-lg shadow-2xl transform rotate-[10deg] hover:rotate-[0deg] hover:scale-110 transition-transform duration-500 z-10">
                            <img src="https://res.cloudinary.com/dbk8bwtnq/image/upload/c_fill,w_200,h_280/v1750831435/4982aed5875e598b7f4d0acf39612ed1_rgyyb2.jpg" alt="[Sampul buku mengambang 3]" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-lg shadow-2xl transform rotate-[2deg] hover:rotate-[5deg] hover:scale-125 transition-transform duration-500 z-20">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="fitur" class="py-20 sm:py-24 bg-base-200">
                <div class="container mx-auto px-6 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-neutral">Semua yang Anda Butuhkan</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-neutral/70">Fitur-fitur canggih yang dirancang untuk memaksimalkan pengalaman literasi digital Anda.</p>
                    <div class="grid md:grid-cols-3 gap-8 mt-12 text-left">
                        <!-- Card 1 -->
                        <div class="glow-card relative bg-base-100 p-8 rounded-xl border border-base-300 transition-all duration-300 hover:border-primary/50 hover:-translate-y-2">
                            <div class="content-wrapper">
                                <div class="w-12 h-12 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                                    {{-- ICON DARI LUCIDE: library --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-library"><path d="m16 6 4 14"/><path d="M12 6v14"/><path d="M8 8v12"/><path d="M4 4v16"/></svg>
                                </div>
                                <h3 class="text-xl font-bold mt-6 text-neutral">Katalog Luas</h3>
                                <p class="mt-2 text-neutral/70">Akses ribuan judul buku dari berbagai kategori, lengkap dengan informasi stok dan ketersediaan.</p>
                            </div>
                        </div>
                        <!-- Card 2: Peminjaman Mudah -->
                        <div class="glow-card relative bg-base-100 p-8 rounded-xl border border-base-300 transition-all duration-300 hover:border-secondary/50 hover:-translate-y-2">
                             <div class="content-wrapper">
                                <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-lg flex items-center justify-center">
                                    {{-- ICON DARI LUCIDE: arrow-right-left --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-left"><path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/></svg>
                                </div>
                                <h3 class="text-xl font-bold mt-6 text-neutral">Peminjaman Mudah</h3>
                                <p class="mt-2 text-neutral/70">Pinjam dan lacak buku pinjaman Anda dengan beberapa klik. Notifikasi pengingat akan membantu Anda.</p>
                            </div>
                        </div>
                        <!-- Card 3: Ulasan Interaktif -->
                        <div class="glow-card relative bg-base-100 p-8 rounded-xl border border-base-300 transition-all duration-300 hover:border-accent/50 hover:-translate-y-2">
                             <div class="content-wrapper">
                                <div class="w-12 h-12 bg-accent/10 text-accent rounded-lg flex items-center justify-center">
                                    {{-- ICON DARI LUCIDE: message-square-quote --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-quote"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 12h.01"/><path d="M12 12h.01"/><path d="M16 12h.01"/></svg>
                                </div>
                                <h3 class="text-xl font-bold mt-6 text-neutral">Ulasan Interaktif</h3>
                                <p class="mt-2 text-neutral/70">Berikan rating dan ulasan, serta lihat pendapat dari pembaca lain untuk menemukan buku favorit Anda berikutnya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Call to Action Section -->
            <section class="py-20 sm:py-24 bg-base-100">
                <div class="container mx-auto px-6 text-center">
                     <h2 class="text-3xl md:text-4xl font-bold text-neutral">Siap Memulai Petualangan Literasi Anda?</h2>
                     <p class="mt-4 max-w-xl mx-auto text-neutral/70">Buat akun sekarang dan dapatkan akses penuh ke seluruh koleksi digital kami dalam hitungan detik.</p>
                     <a href="{{ route('register') }}" class="mt-8 inline-block px-10 py-4 bg-primary text-white font-semibold rounded-lg shadow-lg shadow-primary/40 hover:bg-opacity-90 transform hover:scale-105 transition-all duration-300">Daftar Sekarang, Gratis!</a>
                </div>
            </section>
        </main>
        
        @include('layouts.footer')

        <script>
            // Script for glow card effect
            document.querySelectorAll('.glow-card').forEach(card => {
                card.addEventListener('mousemove', e => {
                    const rect = card.getBoundingClientRect();
                    card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                    card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
                });
            });
        </script>
    </body>
</html>
