<x-app-layout>
    {{-- Header Halaman Dasbor --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Selamat Datang Kembali, {{ Auth::user()->name }}!
                </h2>
                <p class="mt-1 text-sm text-neutral/70">Berikut adalah ringkasan aktivitas Anda di PerpusDigital.</p>
            </div>
            <a href="#" class="px-5 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-lg shadow-primary/30 hover:bg-opacity-90 transition-all flex items-center gap-2">
                {{-- ICON DARI LUCIDE: search --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                Cari Buku Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Bagian Statistik Utama --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                {{-- Anggap data ini datang dari Controller: $stats['borrowed'], $stats['history'], $stats['reviews'] --}}
                @php
                    $stats = ['borrowed' => 2, 'history' => 15, 'reviews' => 5];
                @endphp

                <!-- Stat Card: Buku Dipinjam -->
                <div class="bg-base-200 p-6 rounded-xl flex items-start gap-4 border border-transparent hover:border-primary/50 transition-colors">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        {{-- ICON DARI LUCIDE: book-marked --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-marked"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/><path d="m14 6-4 4 4 4"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral/70">Buku Sedang Dipinjam</p>
                        <p class="text-2xl font-bold text-neutral">{{ $stats['borrowed'] }}</p>
                    </div>
                </div>

                <!-- Stat Card: Riwayat Peminjaman -->
                <div class="bg-base-200 p-6 rounded-xl flex items-start gap-4 border border-transparent hover:border-secondary/50 transition-colors">
                    <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                        {{-- ICON DARI LUCIDE: history --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-history"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/><path d="M12 7v5l4 2"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral/70">Total Riwayat Pinjam</p>
                        <p class="text-2xl font-bold text-neutral">{{ $stats['history'] }}</p>
                    </div>
                </div>

                <!-- Stat Card: Ulasan Dibuat -->
                <div class="bg-base-200 p-6 rounded-xl flex items-start gap-4 border border-transparent hover:border-accent/50 transition-colors">
                    <div class="w-12 h-12 bg-accent/10 text-accent rounded-lg flex items-center justify-center flex-shrink-0">
                        {{-- ICON DARI LUCIDE: star --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral/70">Ulasan Telah Dibuat</p>
                        <p class="text-2xl font-bold text-neutral">{{ $stats['reviews'] }}</p>
                    </div>
                </div>
            </div>

            {{-- Konten Utama Dasbor --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Kolom Kiri: Peminjaman Aktif --}}
                <div class="lg:col-span-2 bg-base-200 p-6 rounded-xl">
                    <h3 class="text-lg font-bold text-neutral mb-4">Peminjaman Aktif Anda</h3>
                    <div class="space-y-4">
                        {{-- Contoh data buku yang dipinjam, idealnya dari controller --}}
                        @php
                            $activeBorrows = [
                                ['title' => 'The Midnight Library', 'author' => 'Matt Haig', 'due_date' => '3 hari lagi', 'image' => 'https://placehold.co/80x120/7F5AF0/FFFFFF?text=Buku'],
                                ['title' => 'Atomic Habits', 'author' => 'James Clear', 'due_date' => '10 hari lagi', 'image' => 'https://placehold.co/80x120/72DEC2/232946?text=Buku'],
                            ];
                        @endphp

                        @forelse ($activeBorrows as $book)
                            <div class="bg-base-100 p-4 rounded-lg flex items-center gap-4 shadow-sm">
                                <img src="{{ $book['image'] }}" alt="Sampul buku {{ $book['title'] }}" class="w-16 h-24 object-cover rounded-md flex-shrink-0">
                                <div class="flex-grow">
                                    <p class="font-bold text-neutral">{{ $book['title'] }}</p>
                                    <p class="text-sm text-neutral/70">{{ $book['author'] }}</p>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-sm text-neutral/70">Tenggat</p>
                                    <p class="font-semibold text-warning">{{ $book['due_date'] }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 border-2 border-dashed border-base-300 rounded-lg">
                                <p class="text-neutral/70">Anda sedang tidak meminjam buku apapun.</p>
                                <a href="#" class="mt-2 text-sm font-semibold text-primary hover:underline">Mulai cari buku</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Kolom Kanan: Aktivitas Terbaru --}}
                <div class="lg:col-span-1 bg-base-200 p-6 rounded-xl">
                    <h3 class="text-lg font-bold text-neutral mb-4">Aktivitas Terbaru</h3>
                    <ul class="space-y-4">
                        {{-- Contoh data aktivitas, idealnya dari controller --}}
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-success/10 text-success rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                {{-- ICON DARI LUCIDE: check-circle-2 --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>
                            <div>
                                <p class="text-sm text-neutral">Anda berhasil mengembalikan buku <span class="font-semibold">"Project Hail Mary"</span>.</p>
                                <p class="text-xs text-neutral/50">1 jam yang lalu</p>
                            </div>
                        </li>
                         <li class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-accent/10 text-accent rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                               {{-- ICON DARI LUCIDE: bookmark --}}
                               <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm text-neutral">Anda menambahkan <span class="font-semibold">"Klara and the Sun"</span> ke wishlist.</p>
                                <p class="text-xs text-neutral/50">Kemarin</p>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
