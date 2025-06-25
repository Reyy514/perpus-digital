<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            {{-- Bagian Detail Utama Buku --}}
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl p-6 sm:p-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                    <!-- Kolom Kiri: Cover & QR Code -->
                    <div class="md:col-span-4 lg:col-span-3 flex flex-col items-center">
                        <img class="w-full max-w-xs rounded-lg shadow-lg" src="{{ $book->cover_image_url ? asset('storage/' . $book->cover_image_url) : 'https://placehold.co/400x600/e2e8f0/64748b?text=Sampul+Tidak+Ada' }}" alt="[Gambar Sampul {{ $book->title }}]">
                        <div class="mt-6 p-4 bg-white rounded-md">
                            {!! QrCode::size(150)->generate(route('mahasiswa.books.show', $book)) !!}
                        </div>
                        <p class="mt-2 text-xs text-neutral/60">Scan untuk detail buku</p>
                    </div>

                    <!-- Kolom Kanan: Detail & Aksi -->
                    <div class="md:col-span-8 lg:col-span-9">
                        <p class="text-sm font-semibold text-primary uppercase tracking-wider">{{ $book->category->name ?? 'Tanpa Kategori' }}</p>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight text-neutral sm:text-4xl">{{ $book->title }}</h1>
                        <p class="mt-3 text-lg text-neutral/80">oleh <span class="font-semibold">{{ $book->author->name ?? 'Penulis Tidak Dikenal' }}</span></p>

                        <!-- Rating & Stok -->
                        <div class="mt-4 flex flex-col sm:flex-row sm:items-center gap-x-6 gap-y-3">
                            <div class="flex items-center">
                                @php $avgRating = $book->averageRating(); @endphp
                                <x-star-rating :rating="$avgRating" />
                                <span class="ml-3 text-sm text-neutral/70">{{ number_format($avgRating, 1) }} dari 5 ({{ $book->comments()->count() }} ulasan)</span>
                            </div>
                            @if($book->stock > 0)
                                <span class="inline-flex items-center gap-2 rounded-full bg-success/10 px-3 py-1 text-sm font-medium text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                                    Stok Tersedia: {{ $book->stock }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 rounded-full bg-error/10 px-3 py-1 text-sm font-medium text-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-circle"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                                    Stok Habis
                                </span>
                            @endif
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-8 prose max-w-none text-neutral/80 leading-relaxed">
                            <h3 class="text-lg font-semibold text-neutral">Deskripsi</h3>
                            <p>{{ $book->description }}</p>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="mt-10 flex flex-col sm:flex-row gap-4 border-t border-base-300 pt-8" x-data="{ dialog: false }">
                            <button @click="dialog = true"
                                    :disabled="{{ $book->stock < 1 || Auth::user()->isCurrentlyBorrowing($book) ? 'true' : 'false' }}"
                                    class="w-full sm:w-auto flex items-center justify-center gap-2 rounded-lg px-6 py-3 text-base font-semibold text-white shadow-lg transition-all duration-300 transform hover:-translate-y-1
                                    {{ $book->stock > 0 && !Auth::user()->isCurrentlyBorrowing($book) ? 'bg-primary hover:bg-opacity-90 shadow-primary/40' : 'bg-neutral/30 cursor-not-allowed' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-check-icon lucide-book-check"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/><path d="m9 9.5 2 2 4-4"/></svg>
                                {{ Auth::user()->isCurrentlyBorrowing($book) ? 'Sudah Dipinjam' : 'Pinjam Buku Ini' }}
                            </button>

                            @if(Auth::user()->hasInWishlist($book))
                                <form action="{{ route('mahasiswa.wishlist.destroy', $book) }}" method="POST">@csrf @method('DELETE')
                                    <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-2 rounded-lg px-6 py-3 text-base font-semibold text-error bg-error/10 ring-1 ring-inset ring-error/20 transition-colors hover:bg-error hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                        Hapus dari Wishlist
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('mahasiswa.wishlist.store', $book) }}" method="POST">@csrf
                                    <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-2 rounded-lg px-6 py-3 text-base font-semibold text-primary bg-primary/10 ring-1 ring-inset ring-primary/20 transition-colors hover:bg-primary hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                        Tambah ke Wishlist
                                    </button>
                                </form>
                            @endif

                            {{-- Dialog Konfirmasi Peminjaman --}}
                            <template x-teleport="body">
                                <div x-show="dialog" @click.away="dialog = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
                                    <div @click.stop class="w-full max-w-md rounded-lg bg-base-100 p-6 shadow-xl">
                                        <h3 class="text-xl font-bold text-neutral">Konfirmasi Peminjaman</h3>
                                        <p class="mt-2 text-neutral/70">Anda akan meminjam buku "{{ $book->title }}". Batas pengembalian adalah 7 hari. Lanjutkan?</p>
                                        <div class="mt-6 flex justify-end gap-3">
                                            <x-secondary-button @click="dialog = false">Batal</x-secondary-button>
                                            <form action="{{ route('mahasiswa.books.borrow', $book) }}" method="POST">@csrf<x-primary-button>Ya, Pinjam Sekarang</x-primary-button></form>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Ulasan --}}
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl p-6 sm:p-8">
                <h3 class="text-2xl font-bold text-neutral mb-6">Ulasan Pengguna</h3>
                @include('mahasiswa.books.partials.reviews', ['book' => $book])
            </div>

            {{-- Bagian Buku Terkait --}}
            @if(isset($relatedBooks) && $relatedBooks->count() > 0)
                <div>
                    <h3 class="text-2xl font-bold text-neutral mb-6">Buku Terkait Lainnya</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($relatedBooks as $relatedBook)
                            @include('mahasiswa.books.partials.card', ['book' => $relatedBook])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
