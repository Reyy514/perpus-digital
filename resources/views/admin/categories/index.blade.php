<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Manajemen Kategori
                </h2>
                <p class="mt-1 text-sm text-neutral/70">Kelola semua kategori buku.</p>
            </div>
            <x-primary-button-link href="{{ route('admin.categories.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                <span>Tambah Kategori</span>
            </x-primary-button-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-base-300">
                            <thead class="bg-base-200/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Nama Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Slug</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Jumlah Buku</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-neutral/70 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-base-200">
                                @forelse ($categories as $category)
                                <tr class="hover:bg-base-200/30" x-data="{ dialog: false }">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral">{{ $category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/70 font-mono">{{ $category->slug }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">{{ $category->books_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-4">
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-secondary hover:underline">Edit</a>
                                            <button @click="dialog = true" class="text-error hover:underline">Hapus</button>
                                        </div>
                                        
                                        <!-- Dialog Konfirmasi Hapus -->
                                        <template x-teleport="body">
                                            <div x-show="dialog" @click.away="dialog = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
                                                <div @click.stop class="w-full max-w-md rounded-lg bg-base-100 p-6 shadow-xl">
                                                    <h3 class="text-xl font-bold text-neutral">Konfirmasi Hapus</h3>
                                                    <p class="mt-2 text-neutral/70">Anda yakin ingin menghapus kategori "{{ $category->name }}"? Tindakan ini tidak dapat diurungkan.</p>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <x-secondary-button @click="dialog = false">Batal</x-secondary-button>
                                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
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
                                    <td colspan="4" class="px-6 py-16 text-center text-neutral/60">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag text-neutral/30"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.432 0l6.586-6.586a2.426 2.426 0 0 0 0-3.432z"/><circle cx="8.5" cy="8.5" r=".5" fill="currentColor"/></svg>
                                            <p class="mt-2">Tidak ada kategori ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
