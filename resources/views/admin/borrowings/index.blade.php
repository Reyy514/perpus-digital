<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Laporan Peminjaman
                </h2>
                <p class="mt-1 text-sm text-neutral/70">Lacak dan kelola semua transaksi peminjaman buku.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.borrowings.export.pdf') }}" class="inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold text-white shadow-lg transition-all duration-300 transform hover:-translate-y-1 bg-error hover:bg-opacity-90 shadow-error/40">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text-icon lucide-file-text"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                    <span>Export PDF</span>
                </a>
                <a href="{{ route('admin.borrowings.export.excel') }}" class="inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold text-white shadow-lg transition-all duration-300 transform hover:-translate-y-1 bg-success hover:bg-opacity-90 shadow-success/40">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-spreadsheet-icon lucide-file-spreadsheet"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M8 13h2"/><path d="M14 13h2"/><path d="M8 17h2"/><path d="M14 17h2"/></svg>
                    <span>Export XLSX</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <!-- Fitur Filter -->
                    <form action="{{ route('admin.borrowings.index') }}" method="GET" class="mb-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            <input type="text" name="search" placeholder="Cari buku atau peminjam..." value="{{ request('search') }}" class="block w-full rounded-lg border-base-300 bg-base-200/50 text-sm focus:border-primary focus:ring-primary/40 focus:ring-2">
                            <select name="status" class="block w-full rounded-lg border-base-300 bg-base-200/50 text-sm focus:border-primary focus:ring-primary/40 focus:ring-2">
                                <option value="">Semua Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Terlambat</option>
                                <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <x-primary-button type="submit" class="sm:col-start-4">Filter</x-primary-button>
                        </div>
                    </form>

                    <!-- Tabel Desktop -->
                    <div class="overflow-x-auto hidden md:block">
                        <table class="min-w-full divide-y divide-base-300">
                            <thead class="bg-base-200/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Buku</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Peminjam</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-neutral/70 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-base-200">
                                @forelse ($borrowings as $item)
                                    <tr class="hover:bg-base-200/30" x-data="{ dialog: false }">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral">{{ $item->book->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">{{ $item->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">
                                            <div class="flex flex-col">
                                                <span>Pinjam: {{ $item->borrowed_at->isoFormat('DD MMM YY') }}</span>
                                                <span class="text-xs text-neutral/60">Kembali: {{ $item->due_date ? $item->due_date->isoFormat('DD MMM YY') : '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">@include('admin.borrowings.partials.status-badge', ['item' => $item])</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if(!$item->returned_at)
                                                <button @click="dialog = true" class="font-semibold text-primary hover:underline">Tandai Kembali</button>
                                                <!-- Dialog Konfirmasi -->
                                                @include('admin.borrowings.partials.return-dialog', ['item' => $item])
                                            @else
                                                <span class="text-neutral/60">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-6 py-16 text-center text-neutral/60">Tidak ada data peminjaman ditemukan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tampilan Kartu untuk Mobile -->
                    <div class="space-y-4 md:hidden">
                         @forelse ($borrowings as $item)
                            <div class="bg-base-200 p-4 rounded-lg" x-data="{ dialog: false }">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="font-bold text-neutral">{{ $item->book->title }}</p>
                                        <p class="text-sm text-neutral/70">Oleh: {{ $item->user->name }}</p>
                                    </div>
                                    @include('admin.borrowings.partials.status-badge', ['item' => $item])
                                </div>
                                <div class="mt-4 border-t border-base-300 pt-3 grid grid-cols-2 gap-2 text-sm">
                                    <div>
                                        <p class="text-neutral/60">Tgl. Pinjam</p>
                                        <p class="font-medium text-neutral">{{ $item->borrowed_at ? \Carbon\Carbon::parse($item->borrowed_at)->isoFormat('DD MMM YY') : 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-neutral/60">Batas Kembali</p>
                                        <p class="font-medium text-neutral">{{ $item->due_date ? \Carbon\Carbon::parse($item->due_date)->isoFormat('DD MMM YY') : 'N/A' }}</p>
                                    </div>
                                </div>
                                @if(!$item->returned_at)
                                <div class="mt-4 border-t border-base-300 pt-3">
                                    <button @click="dialog = true" class="w-full text-center font-semibold text-primary hover:underline">Tandai Sudah Dikembalikan</button>
                                    @include('admin.borrowings.partials.return-dialog', ['item' => $item])
                                </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-12"><p class="text-neutral/60">Tidak ada data peminjaman ditemukan.</p></div>
                        @endforelse
                    </div>

                    <div class="mt-6">{{ $borrowings->withQueryString()->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
