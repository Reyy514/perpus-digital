@props([
    'class' => '',
])

{{-- 
  Komponen ini adalah link yang mengarah ke halaman utama.
  PERBAIKAN: Menggunakan url('/') yang lebih robust daripada route('home').
--}}
<a href="{{ url('/') }}" {{ $attributes->merge(['class' => 'inline-flex items-center gap-x-3 ' . $class]) }}>
    
    {{-- Container untuk Ikon --}}
    <div class="flex-shrink-0">
        {{-- 
        SVG dari Lucide Icons: 'LibraryBig'
        - 'w-10 h-10' untuk ukuran default.
        - 'text-primary' menggunakan warna utama dari tema Anda.
        - 'stroke-width-1.5' memberikan tampilan yang lebih halus.
        --}}
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-library-big-icon lucide-library-big"><rect width="8" height="18" x="3" y="3" rx="1"/><path d="M7 3v18"/><path d="M20.4 18.9c.2.5-.1 1.1-.6 1.3l-1.9.7c-.5.2-1.1-.1-1.3-.6L11.1 5.1c-.2-.5.1-1.1.6-1.3l1.9-.7c.5-.2 1.1.1 1.3.6Z"/></svg>
        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
            <path d="M4 22h16"/>
            <path d="M2 18.27V4a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v14.27"/>
            <path d="M20 22V6"/>
            <path d="M15 6H8"/>
            <path d="m20 11-5-1-5 1"/>
            <path d="M20 16h-5"/>
        </svg> -->
    </div>

    {{-- Container untuk Teks Logo --}}
    <div class="flex flex-col">
        {{-- 
        Baris pertama: "Perpustakaan"
        - Ukuran teks lebih besar dan tebal.
        - Warna menggunakan 'text-neutral' yang beradaptasi dengan mode terang/gelap.
        --}}
        <span class="text-xl font-extrabold tracking-tight text-neutral">
            Perpustakaan
        </span>
        {{-- 
        Baris kedua: "Digital"
        - Ukuran teks lebih kecil, memberikan hierarki visual.
        - Warna menggunakan 'text-secondary' untuk aksen yang menarik.
        --}}
        <span class="text-sm font-medium -mt-1 text-secondary">
            Digital
        </span>
    </div>
</a>
