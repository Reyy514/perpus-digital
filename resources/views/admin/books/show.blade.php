<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Detail Buku
                </h2>
                <p class="text-sm text-neutral/70 mt-1">Informasi lengkap untuk "{{ $book->title }}"</p>
            </div>
             <div class="flex items-center gap-2">
                <a href="{{ route('admin.books.index') }}" class="text-sm font-semibold text-neutral/80 hover:underline">Kembali ke Daftar</a>
                <x-primary-button-link href="{{ route('admin.books.edit', $book) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-pen-line mr-2"><path d="M4 22h14a2 2 0 0 0 2-2V7.5L14.5 2H6a2 2 0 0 0-2 2v4"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10.4 12.6a2 2 0 1 1 3 3L8 21l-4 1 1-4Z"/></svg>
                    <span>Edit Buku</span>
                </x-primary-button-link>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Kolom Kiri: Cover & QR Code -->
                        <div class="md:col-span-1 flex flex-col items-center">
                            <img class="w-full max-w-xs rounded-lg shadow-lg" src="{{ $book->cover_image_url ? asset('storage/' . $book->cover_image_url) : 'https://placehold.co/400x600/e2e8f0/64748b?text=Sampul+Tidak+Ada' }}" alt="[Gambar Sampul {{ $book->title }}]">
                            <div class="mt-6 p-4 bg-white rounded-md">
                                <!-- Pastikan Anda sudah menginstal simple-qrcode: composer require simplesoftwareio/simple-qrcode -->
                                {!! QrCode::size(150)->generate(route('mahasiswa.books.show', $book)) !!}
                            </div>
                            <p class="mt-2 text-xs text-neutral/60">QR Code untuk Halaman Mahasiswa</p>
                        </div>

                        <!-- Kolom Kanan: Detail & Aksi -->
                        <div class="md:col-span-2">
                            <p class="text-sm font-semibold text-primary uppercase tracking-wider">{{ $book->category->name ?? 'Tanpa Kategori' }}</p>
                            <h1 class="mt-2 text-3xl font-bold tracking-tight text-neutral sm:text-4xl">{{ $book->title }}</h1>
                            <p class="mt-3 text-lg text-neutral/80">oleh <span class="font-semibold">{{ $book->author->name ?? 'N/A' }}</span></p>
                            
                            <div class="mt-6 border-t border-b border-base-300 divide-y divide-base-300">
                                <div class="py-4 flex justify-between">
                                    <span class="font-medium text-neutral/70">Stok</span>
                                    <span class="font-semibold text-neutral">{{ $book->stock }}</span>
                                </div>
                                <div class="py-4 flex justify-between">
                                    <span class="font-medium text-neutral/70">Dibuat pada</span>
                                    <span class="text-neutral/80">{{ $book->created_at->isoFormat('dddd, DD MMMM YYYY') }}</span>
                                </div>
                                <div class="py-4 flex justify-between">
                                    <span class="font-medium text-neutral/70">Diperbarui pada</span>
                                    <span class="text-neutral/80">{{ $book->updated_at->isoFormat('dddd, DD MMMM YYYY') }}</span>
                                </div>
                            </div>

                            <div class="mt-6 prose max-w-none text-neutral/80 leading-relaxed">
                                <h3 class="text-lg font-semibold text-neutral">Deskripsi</h3>
                                <p>{{ $book->description ?? 'Tidak ada deskripsi.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
