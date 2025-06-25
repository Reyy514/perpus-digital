<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Wishlist Saya
                </h2>
                <p class="mt-1 text-sm text-neutral/70">
                    Daftar buku-buku yang Anda simpan untuk dibaca di kemudian hari.
                </p>
            </div>
             @if($wishlistItems->isNotEmpty())
                <span class="inline-flex items-center gap-2 rounded-lg bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                    {{ $wishlistItems->count() }} Buku
                </span>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Cek jika Wishlist Kosong --}}
            @if($wishlistItems->isEmpty())
                {{-- Tampilan Empty State yang Ditingkatkan --}}
                <div class="text-center bg-base-100 rounded-xl shadow-lg p-12">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-crack mx-auto text-neutral/20"><path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.77-.77-.77a5.4 5.4 0 0 0-7.65 0C1.46 6.7 1.33 10.28 4 13l8 8 8-8c2.67-2.72 2.54-6.3.42-8.42z"/><path d="m12 13-2-2 4-4-2-2"/></svg>
                    <h3 class="mt-6 text-xl font-bold text-neutral">Wishlist Anda Masih Kosong</h3>
                    <p class="mt-2 text-neutral/70 max-w-md mx-auto">Sepertinya Anda belum menemukan buku yang menarik. Jelajahi katalog kami untuk menemukan petualangan Anda berikutnya!</p>
                    <div class="mt-8">
                        <a href="{{ route('mahasiswa.books.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg px-6 py-3 text-base font-semibold text-white shadow-lg transition-all duration-300 transform hover:-translate-y-1 bg-primary hover:bg-opacity-90 shadow-primary/40">
                             <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            Jelajahi Katalog
                        </a>
                    </div>
                </div>
            @else
                {{-- Tampilan Grid untuk Wishlist --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($wishlistItems as $item)
                        {{-- Memanggil partial card buku yang sudah kita tingkatkan sebelumnya --}}
                        @include('mahasiswa.books.partials.card', ['book' => $item->book])
                    @endforeach
                </div>
                 <!-- Paginasi -->
                <div class="mt-12">
                    {{ $wishlistItems->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
