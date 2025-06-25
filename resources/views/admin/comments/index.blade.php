<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Moderasi Ulasan
                </h2>
                <p class="mt-1 text-sm text-neutral/70">Kelola semua ulasan dan rating dari pengguna.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <!-- Fitur Pencarian Fungsional -->
                    <form action="{{ route('admin.comments.index') }}" method="GET" class="mb-6">
                         <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search text-neutral/50"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                            <input type="text" name="search" placeholder="Cari ulasan, pengguna, atau buku..." value="{{ request('search') }}" class="block w-full rounded-lg border-base-300 bg-base-200/50 pl-10 pr-4 py-2.5 text-sm focus:border-primary focus:ring-primary/40 focus:ring-2">
                        </div>
                    </form>

                    <!-- Tabel Desktop -->
                    <div class="overflow-x-auto hidden md:block">
                        <table class="min-w-full divide-y divide-base-300">
                            <thead class="bg-base-200/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Ulasan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Rating</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Detail</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-neutral/70 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-base-200">
                                @forelse ($comments as $review)
                                <tr class="hover:bg-base-200/30" x-data="{ dialog: false }">
                                    <td class="px-6 py-4 max-w-sm">
                                        <p class="text-sm font-medium text-neutral truncate" title="{{ $review->content }}">{{ $review->content }}</p>
                                        <p class="text-sm text-neutral/70">pada buku <a href="{{ route('admin.books.show', $review->book) }}" class="font-semibold hover:underline">{{ $review->book->title }}</a></p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($review->rating)
                                            <x-star-rating :rating="$review->rating" size="w-5 h-5" />
                                        @else
                                            <span class="text-xs text-neutral/60">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">
                                        <div class="flex items-center">
                                            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=7F5AF0&color=FFFFFF" alt="Avatar">
                                            <div class="ml-3">
                                                <div class="font-medium">{{ $review->user->name }}</div>
                                                <div class="text-xs text-neutral/60">{{ $review->created_at->isoFormat('DD MMM YYYY, HH:mm') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button @click="dialog = true" class="text-error hover:underline">Hapus</button>
                                        
                                        <!-- Dialog Konfirmasi Hapus -->
                                        @include('admin.comments.partials.delete-dialog', ['review' => $review])
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center text-neutral/60">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-dashed mx-auto text-neutral/30"><path d="M4 15h2"/><path d="M9 15h2"/><path d="M15 15h2"/><path d="M21 15h2"/><path d="M4 9h2"/><path d="M9 9h2"/><path d="M15 9h2"/><path d="M21 9h2"/><path d="M15 4h2"/><path d="M15 21h2"/><path d="M9 4h2"/><path d="M9 21h2"/><path d="M4 4h2"/><path d="M4 21h2"/><path d="M21 4h2"/><path d="M21 21h2"/></svg>
                                        <p class="mt-2">Tidak ada ulasan ditemukan.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Tampilan Kartu untuk Mobile --}}
                    <div class="space-y-4 md:hidden">
                        @forelse ($comments as $review)
                            <div class="bg-base-200 p-4 rounded-lg" x-data="{ dialog: false }">
                                <div class="flex items-start gap-4">
                                    <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=7F5AF0&color=FFFFFF" alt="Avatar">
                                    <div class="w-full">
                                        <div class="flex items-center justify-between">
                                            <p class="font-semibold text-neutral">{{ $review->user->name }}</p>
                                            <button @click="dialog = true" class="text-error/80 hover:text-error">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            </button>
                                        </div>
                                        @if($review->rating) <x-star-rating :rating="$review->rating" size="w-4 h-4" class="mt-1" /> @endif
                                        <p class="mt-2 text-sm text-neutral/80">{{ $review->content }}</p>
                                        <p class="mt-2 text-xs text-neutral/60">Pada: <a href="{{ route('admin.books.show', $review->book) }}" class="font-medium hover:underline">{{ $review->book->title }}</a></p>
                                    </div>
                                </div>
                                @include('admin.comments.partials.delete-dialog', ['review' => $review])
                            </div>
                        @empty
                             <div class="text-center py-12"><p class="text-neutral/60">Tidak ada ulasan ditemukan.</p></div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $comments->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
