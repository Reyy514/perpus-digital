<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start gap-6">
            <div class="flex-shrink-0">
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Katalog Buku
                </h2>
                <p class="mt-1 text-sm text-neutral/70">Jelajahi dan temukan buku favorit Anda berikutnya.</p>
            </div>
            
            {{-- Form Pencarian & Filter Fungsional --}}
            <form action="{{ route('mahasiswa.books.index') }}" method="GET" class="w-full md:w-auto flex-grow">
                <div class="flex flex-col sm:flex-row items-center gap-2">
                    <div class="relative w-full flex-grow">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search text-neutral/50"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        <input type="text" name="search" placeholder="Cari judul atau penulis..." value="{{ request('search') }}" class="block w-full rounded-lg border-base-300 bg-base-100 pl-10 pr-4 py-2.5 text-sm focus:border-primary focus:ring-primary/40 focus:ring-2">
                    </div>
                    <div class="relative w-full sm:w-48">
                        <select name="category" class="block w-full rounded-lg border-base-300 bg-base-100 py-2.5 text-sm focus:border-primary focus:ring-primary/40 focus:ring-2">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-primary-button type="submit" class="w-full sm:w-auto justify-center">Cari</x-primary-button>
                </div>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($books->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($books as $book)
                        @include('mahasiswa.books.partials.card', ['book' => $book])
                    @endforeach
                </div>

                <div class="mt-12">
                    {{-- Menambahkan query string agar filter tetap ada saat pindah halaman --}}
                    {{ $books->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-base-100 rounded-lg shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-dashed mx-auto text-neutral/30"><path d="M12 20v-5M12 9V4"/><path d="M12 2h2.5a2.5 2.5 0 0 1 2.22 1.66l.23 1.05a2.5 2.5 0 0 0 2.22 1.66H19a2 2 0 0 1 2 2v2.5a2.5 2.5 0 0 1-1.66 2.22l-1.05.23a2.5 2.5 0 0 0-1.66 2.22V19a2 2 0 0 1-2 2h-2.5a2.5 2.5 0 0 1-2.22-1.66l-.23-1.05a2.5 2.5 0 0 0-2.22-1.66H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2.5a2.5 2.5 0 0 1 2.22 1.66l.23 1.05A2.5 2.5 0 0 0 9.5 7H12Z"/></svg>
                    <h3 class="mt-4 text-xl font-semibold text-neutral">Tidak Ada Buku Ditemukan</h3>
                    <p class="mt-1 text-neutral/70">Coba kata kunci pencarian atau filter yang berbeda.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
