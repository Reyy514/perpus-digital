<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Status & Riwayat Peminjaman
                </h2>
                <p class="mt-1 text-sm text-neutral/70">Lacak semua buku yang sedang Anda pinjam dan yang sudah dikembalikan.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ tab: 'aktif' }" class="w-full">
                {{-- Navigasi Tab --}}
                <div class="border-b border-base-300 mb-6">
                    <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                        <button @click="tab = 'aktif'" :class="{ 'border-primary text-primary': tab === 'aktif', 'border-transparent text-neutral/60 hover:text-neutral hover:border-neutral/30': tab !== 'aktif' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 focus:outline-none">
                            Peminjaman Aktif
                            @if($activeBorrowings->isNotEmpty())
                                <span class="ml-2 inline-block py-0.5 px-2.5 rounded-full text-xs font-medium" :class="tab === 'aktif' ? 'bg-primary text-white' : 'bg-base-200 text-neutral/80'">{{ $activeBorrowings->count() }}</span>
                            @endif
                        </button>
                        <button @click="tab = 'riwayat'" :class="{ 'border-primary text-primary': tab === 'riwayat', 'border-transparent text-neutral/60 hover:text-neutral hover:border-neutral/30': tab !== 'riwayat' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 focus:outline-none">
                            Riwayat Peminjaman
                        </button>
                    </nav>
                </div>

                {{-- Konten Tab: Peminjaman Aktif --}}
                <div x-show="tab === 'aktif'" x-transition.opacity>
                    <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                        <div class="p-6">
                            @if($activeBorrowings->isEmpty())
                                <div class="text-center py-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-x mx-auto text-neutral/30"><path d="m14.5 7-5 5"/><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/><path d="m9.5 7 5 5"/></svg>
                                    <h3 class="mt-4 text-xl font-semibold text-neutral">Tidak Ada Peminjaman Aktif</h3>
                                    <p class="mt-1 text-neutral/70">Ayo mulai jelajahi katalog dan pinjam buku pertama Anda!</p>
                                </div>
                            @else
                                {{-- Tampilan Kartu untuk Mobile --}}
                                <div class="space-y-4 md:hidden">
                                    @foreach($activeBorrowings as $item)
                                        <div class="bg-base-200 p-4 rounded-lg">
                                            <div class="flex items-center gap-4">
                                                <img class="h-20 w-14 rounded-md object-cover flex-shrink-0" src="{{ $item->book->cover_image_url ? asset('storage/' . $item->book->cover_image_url) : 'https://placehold.co/80x120/e2e8f0/64748b?text=N/A' }}" alt="Sampul {{ $item->book->title }}">
                                                <div class="flex-grow min-w-0">
                                                    <p class="font-bold text-neutral truncate">{{ $item->book->title }}</p>
                                                    <p class="text-sm text-neutral/70 truncate">{{ $item->book->author->name ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-4 border-t border-base-300 pt-3 grid grid-cols-2 gap-2 text-sm">
                                                <div>
                                                    <p class="text-neutral/60">Sisa Waktu</p>
                                                    @if($item->due_date && \Carbon\Carbon::now()->lt($item->due_date))
                                                        <p class="font-medium text-info">{{ \Carbon\Carbon::parse($item->due_date)->diffForHumans(null, true) }}</p>
                                                    @else
                                                        <p class="font-medium text-error">Terlambat</p>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="text-neutral/60">Batas Kembali</p>
                                                    <p class="font-medium text-neutral">{{ $item->due_date ? \Carbon\Carbon::parse($item->due_date)->isoFormat('DD MMM YYYY') : 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                {{-- Tampilan Tabel untuk Desktop --}}
                                <div class="overflow-x-auto hidden md:block">
                                    <table class="min-w-full divide-y divide-base-300">
                                        <thead class="bg-base-200/50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Buku</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Tgl. Pinjam</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Batas Kembali</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-base-200">
                                            @foreach($activeBorrowings as $item)
                                                <tr class="hover:bg-base-200/30">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-14 w-10">
                                                                <img class="h-14 w-10 rounded-md object-cover" src="{{ $item->book->cover_image_url ? asset('storage/' . $item->book->cover_image_url) : 'https://placehold.co/80x120/e2e8f0/64748b?text=N/A' }}" alt="Sampul {{ $item->book->title }}">
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-neutral">{{ $item->book->title }}</div>
                                                                <div class="text-sm text-neutral/70">{{ $item->book->author->name ?? 'N/A' }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">{{ $item->borrowed_at ? \Carbon\Carbon::parse($item->borrowed_at)->isoFormat('DD MMM YYYY') : 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">{{ $item->due_at ? \Carbon\Carbon::parse($item->due_at)->isoFormat('DD MMM YYYY') : 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        @if($item->due_at && \Carbon\Carbon::now()->gt($item->due_at))
                                                            <span class="inline-flex items-center gap-2 rounded-full bg-error/10 px-3 py-1 text-sm font-medium text-error">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alarm-clock-off"><path d="M19.94 14.25a8.94 8.94 0 0 1-1.35 2.81m-1.35-1.35a4.02 4.02 0 0 0-5.69-5.62l-2.4-2.4m7.39.29a9 9 0 0 0-11.33-1.45"/><path d="M22 6A8.97 8.97 0 0 0 13.06 3.19"/><path d="M2.5 12.5a8.96 8.96 0 0 0 3.32 5.37"/><path d="m2 2 20 20"/><path d="M5 3 2 6"/><path d="M22 17v-3h-3"/></svg>
                                                                Terlambat ({{ \Carbon\Carbon::now()->diffInDays($item->due_at) }} hari)
                                                            </span>
                                                        @else
                                                            <span class="inline-flex items-center gap-2 rounded-full bg-info/10 px-3 py-1 text-sm font-medium text-info">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                                                                Sisa {{ $item->due_at ? \Carbon\Carbon::parse($item->due_at)->diffForHumans(null, true) : 'N/A' }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Konten Tab: Riwayat Peminjaman --}}
                <div x-show="tab === 'riwayat'" x-transition.opacity style="display: none;">
                     <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                        <div class="p-6">
                            @if($historyBorrowings->isEmpty())
                                <div class="text-center py-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-history mx-auto text-neutral/30"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/><path d="M12 7v5l4 2"/></svg>
                                    <h3 class="mt-4 text-xl font-semibold text-neutral">Riwayat Peminjaman Kosong</h3>
                                    <p class="mt-1 text-neutral/70">Anda belum pernah mengembalikan buku.</p>
                                </div>
                            @else
                                {{-- Tampilan Tabel untuk Desktop --}}
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-base-300">
                                         <thead class="bg-base-200/50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Buku</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Tgl. Pinjam</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Tgl. Kembali</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-base-200">
                                            @foreach($historyBorrowings as $item)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-14 w-10">
                                                                <img class="h-14 w-10 rounded-md object-cover" src="{{ $item->book->cover_image_url ? asset('storage/' . $item->book->cover_image_url) : 'https://placehold.co/80x120/e2e8f0/64748b?text=N/A' }}" alt="Sampul {{ $item->book->title }}">
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-neutral">{{ $item->book->title }}</div>
                                                                <div class="text-sm text-neutral/70">{{ $item->book->author->name ?? 'N/A' }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">{{ $item->borrowed_at ? \Carbon\Carbon::parse($item->borrowed_at)->isoFormat('DD MMM YYYY') : 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">{{ $item->returned_at ? \Carbon\Carbon::parse($item->returned_at)->isoFormat('DD MMM YYYY') : 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="inline-flex items-center gap-2 rounded-full bg-success/10 px-3 py-1 text-sm font-medium text-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                                                            Dikembalikan
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-6">
                                    {{ $historyBorrowings->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
