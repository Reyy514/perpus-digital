<x-app-layout>
    {{-- Header Halaman Dasbor --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Selamat Datang Kembali, {{ Auth::user()->name }}!
                </h2>
                <p class="mt-1 text-sm text-neutral/70">Berikut adalah ringkasan aktivitas perpustakaan Anda.</p>
            </div>
            <a href="{{ route('mahasiswa.books.index') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary rounded-lg shadow-lg shadow-primary/30 hover:bg-opacity-90 transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                Jelajahi Katalog Buku
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Bagian Statistik Utama --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Stat Card: Buku Dipinjam -->
                <div class="bg-base-100 p-6 rounded-xl flex items-start gap-4 border-l-4 border-primary shadow-lg transition-transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-check-icon lucide-book-check"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/><path d="m9 9.5 2 2 4-4"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral/70">Buku Sedang Dipinjam</p>
                        <p class="text-3xl font-bold text-neutral">{{ $stats['active_borrowings'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Stat Card: Daftar Wishlist -->
                <div class="bg-base-100 p-6 rounded-xl flex items-start gap-4 border-l-4 border-secondary shadow-lg transition-transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral/70">Daftar Wishlist</p>
                        <p class="text-3xl font-bold text-neutral">{{ $stats['wishlist_count'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Stat Card: Riwayat Peminjaman -->
                <div class="bg-base-100 p-6 rounded-xl flex items-start gap-4 border-l-4 border-accent shadow-lg transition-transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-accent/10 text-accent rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-history"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/><path d="M12 7v5l4 2"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral/70">Total Riwayat Pinjam</p>
                        <p class="text-3xl font-bold text-neutral">{{ $stats['borrowing_history'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Kolom Kiri: Peminjaman Aktif --}}
                <div class="lg:col-span-2 bg-base-100 p-6 sm:p-8 rounded-xl shadow-lg">
                    <h3 class="text-lg font-bold text-neutral mb-4">Peminjaman Aktif Anda</h3>
                    <div class="space-y-4">
                        @forelse ($activeBorrows as $borrowing)
                            <div class="bg-base-200 p-4 rounded-lg flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                <img src="{{ $borrowing->book->cover_image_url ? asset('storage/' . $borrowing->book->cover_image_url) : 'https://placehold.co/80x120/7F5AF0/FFFFFF?text=Buku' }}" alt="Sampul buku {{ $borrowing->book->title }}" class="w-16 h-24 object-cover rounded-md flex-shrink-0 self-center sm:self-auto">
                                <div class="flex-grow min-w-0">
                                    <p class="font-bold text-neutral truncate">{{ $borrowing->book->title ?? 'Judul tidak tersedia' }}</p>
                                    <p class="text-sm text-neutral/70 truncate">{{ $borrowing->book->author->name ?? 'Penulis tidak diketahui' }}</p>
                                </div>
                                <div class="w-full sm:w-auto text-left sm:text-right mt-2 sm:mt-0">
                                    <p class="text-sm text-neutral/70">Sisa Waktu</p>
                                    <p class="font-semibold {{ ($borrowing->due_date && now()->gt($borrowing->due_date)) ? 'text-error' : 'text-info' }}">
                                        {{ $borrowing->due_at ? $borrowing->due_at->diffForHumans() : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 border-2 border-dashed border-base-300 rounded-lg">
                                <div class="w-16 h-16 bg-base-200 text-neutral/40 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-x"><path d="m14.5 7-5 5"/><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/><path d="m9.5 7 5 5"/></svg>
                                </div>
                                <p class="font-semibold text-neutral">Tidak Ada Peminjaman Aktif</p>
                                <p class="text-sm text-neutral/70">Anda sedang tidak meminjam buku apapun.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Kolom Kanan: Rekomendasi --}}
                <div class="lg:col-span-1 bg-base-100 p-6 sm:p-8 rounded-xl shadow-lg">
                    <h3 class="text-lg font-bold text-neutral mb-4">Mungkin Anda Suka</h3>
                    <div class="space-y-4">
                        @forelse ($recommendations as $book)
                            <a href="{{ route('mahasiswa.books.show', $book) }}" class="flex items-center gap-4 group p-2 rounded-lg hover:bg-base-200">
                                <img src="{{ $book->cover_image_url ? asset('storage/' . $book->cover_image_url) : 'https://placehold.co/40x60/FFB86B/FFFFFF?text=N/A' }}" alt="Sampul buku {{ $book->title }}" class="w-10 h-14 object-cover rounded-md flex-shrink-0 transition-transform group-hover:scale-105">
                                <div class="min-w-0">
                                    <p class="font-semibold text-sm text-neutral truncate group-hover:text-primary">{{ $book->title ?? 'Judul tidak tersedia' }}</p>
                                    <p class="text-xs text-neutral/60 truncate">{{ $book->author->name ?? 'Penulis tidak diketahui' }}</p>
                                </div>
                            </a>
                        @empty
                             <p class="text-sm text-neutral/70">Belum ada rekomendasi untuk Anda.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
