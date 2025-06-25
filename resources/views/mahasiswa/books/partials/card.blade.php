<div class="group relative flex flex-col overflow-hidden rounded-xl bg-base-100 shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
    <div class="relative">
        <a href="{{ route('mahasiswa.books.show', $book) }}" class="block">
            <img class="h-64 w-full object-cover" src="{{ $book->cover_image_url ? asset('storage/' . $book->cover_image_url) : 'https://placehold.co/400x600/e2e8f0/64748b?text=Sampul+Tidak+Ada' }}" alt="[Gambar Sampul {{ $book->title }}]">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
        </a>
        
        <div class="absolute top-3 right-3">
            @if($book->stock > 0)
                <span class="inline-flex items-center rounded-full bg-success/80 backdrop-blur-sm px-3 py-1 text-xs font-semibold text-white">Tersedia ({{ $book->stock }})</span>
            @else
                <span class="inline-flex items-center rounded-full bg-error/80 backdrop-blur-sm px-3 py-1 text-xs font-semibold text-white">Stok Habis</span>
            @endif
        </div>

        <div class="absolute top-3 left-3">
             @if(Auth::user()->hasInWishlist($book))
                <form action="{{ route('mahasiswa.wishlist.destroy', $book) }}" method="POST"> @csrf @method('DELETE')
                    <button type="submit" class="p-2 rounded-full bg-error/80 backdrop-blur-sm text-white hover:bg-error transition-colors" aria-label="Hapus dari wishlist">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                    </button>
                </form>
            @else
                <form action="{{ route('mahasiswa.wishlist.store', $book) }}" method="POST"> @csrf
                    <button type="submit" class="p-2 rounded-full bg-black/30 backdrop-blur-sm text-white hover:bg-primary transition-colors" aria-label="Tambah ke wishlist">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                    </button>
                </form>
            @endif
        </div>
    </div>
    
    <div class="flex flex-1 flex-col justify-between p-4">
        <div class="flex-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-primary">{{ $book->category->name ?? 'Tanpa Kategori' }}</p>
            <a href="{{ route('mahasiswa.books.show', $book) }}" class="mt-1 block">
                <p class="text-lg font-bold text-neutral truncate group-hover:text-primary transition-colors">{{ $book->title }}</p>
                <p class="mt-1 text-sm text-neutral/70 truncate">{{ $book->author->name ?? 'Penulis Tidak Dikenal' }}</p>
            </a>
        </div>
        
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center gap-1">
                @php $avgRating = $book->averageRating(); @endphp
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-yellow-400"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <span class="text-sm font-semibold text-neutral/80">{{ number_format($avgRating, 1) }}</span>
                <span class="text-xs text-neutral/60">({{ $book->comments()->count() }})</span>
            </div>
            
            <a href="{{ route('mahasiswa.books.show', $book) }}" class="rounded-md bg-primary/10 px-3 py-1.5 text-xs font-semibold text-primary transition-colors hover:bg-primary hover:text-white">Lihat Detail</a>
        </div>
    </div>
</div>