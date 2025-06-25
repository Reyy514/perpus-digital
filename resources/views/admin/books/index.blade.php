<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Manajemen Buku
                </h2>
                <p class="mt-1 text-sm text-neutral/70">Kelola semua koleksi buku perpustakaan.</p>
            </div>
            <a href="{{ route('admin.books.create') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold text-white shadow-lg transition-all duration-300 transform hover:-translate-y-1 bg-primary hover:bg-opacity-90 shadow-primary/40">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                Tambah Buku Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <!-- Fitur Pencarian Fungsional -->
                    <form action="{{ route('admin.books.index') }}" method="GET" class="mb-6">
                         <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search text-neutral/50"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                            <input type="text" name="search" placeholder="Cari berdasarkan judul atau penulis..." value="{{ request('search') }}" class="block w-full rounded-lg border-base-300 bg-base-200/50 pl-10 pr-4 py-2.5 text-sm focus:border-primary focus:ring-primary/40 focus:ring-2">
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-base-300">
                            <thead class="bg-base-200/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Buku</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Stok</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-neutral/70 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-base-200">
                                @forelse ($books as $book)
                                <tr class="hover:bg-base-200/30" x-data="{ dialog: false }">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-14 w-10">
                                                <img class="h-14 w-10 rounded-md object-cover" src="{{ $book->cover_image_url ? asset('storage/' . $book->cover_image_url) : 'https://placehold.co/80x120/e2e8f0/64748b?text=N/A' }}" alt="Sampul buku">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-neutral">{{ $book->title }}</div>
                                                <div class="text-sm text-neutral/70">{{ $book->author }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">{{ $book->category->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">{{ $book->stock }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.books.show', $book) }}" class="text-primary hover:underline">Lihat</a>
                                        <a href="{{ route('admin.books.edit', $book) }}" class="text-secondary hover:underline ml-4">Edit</a>
                                        <button @click="dialog = true" class="text-error hover:underline ml-4">Hapus</button>

                                        <!-- Dialog Konfirmasi Hapus -->
                                        <template x-teleport="body">
                                            <div x-show="dialog" @click.away="dialog = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
                                                <div @click.stop class="w-full max-w-md rounded-lg bg-base-100 p-6 shadow-xl">
                                                    <h3 class="text-xl font-bold text-neutral">Konfirmasi Hapus</h3>
                                                    <p class="mt-2 text-neutral/70">Anda yakin ingin menghapus buku "{{ $book->title }}"? Tindakan ini tidak dapat diurungkan.</p>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <x-secondary-button @click="dialog = false">Batal</x-secondary-button>
                                                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <x-danger-button type="submit">Ya, Hapus</x-danger-button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center text-neutral/60">Tidak ada data buku ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $books->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
