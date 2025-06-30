<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Log Aktivitas Sistem
                </h2>
                <p class="mt-1 text-sm text-neutral/70">Lacak semua kejadian penting yang terjadi di dalam aplikasi.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6 md:p-8">
                    @if($logs->isEmpty())
                        {{-- Tampilan Empty State --}}
                        <div class="text-center py-16">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-history mx-auto text-neutral/30"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/><path d="M12 7v5l4 2"/></svg>
                            <h3 class="mt-4 text-xl font-semibold text-neutral">Belum Ada Aktivitas</h3>
                            <p class="mt-1 text-neutral/70">Sistem akan mulai mencatat aktivitas setelah pengguna berinteraksi.</p>
                        </div>
                    @else
                        {{-- Layout Timeline --}}
                        <div class="relative">
                            <!-- Garis Timeline -->
                            <div class="absolute left-5 top-5 h-full w-0.5 bg-base-300"></div>

                            <div class="space-y-8">
                                @foreach ($logs as $log)
                                    <div class="relative flex items-start gap-4">
                                        <!-- Ikon Timeline -->
                                        <div class="absolute left-5 top-1 -translate-x-1/2 flex h-10 w-10 items-center justify-center rounded-full bg-base-200 ring-4 ring-base-100">
                                            @if($log->type == 'user_registered')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus text-success"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                                            @elseif($log->type == 'book_borrowed')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-check-icon lucide-book-check text-info"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/><path d="m9 9.5 2 2 4-4"/></svg>
                                            @elseif($log->type == 'review_created')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-plus text-secondary"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="9" x2="15" y1="10" y2="10"/><line x1="12" x2="12" y1="7" y2="13"/></svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell text-neutral/60"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                                            @endif
                                        </div>

                                        <!-- Konten Log -->
                                        <div class="ml-16 w-full">
                                            <p class="text-sm text-neutral/80">{{ $log->description }}</p>
                                            <p class="mt-1 text-xs text-neutral/60">
                                                <span>{{ $log->created_at->diffForHumans() }}</span>
                                                @if($log->user)
                                                    <span>&middot; oleh {{ $log->user->name }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                 @if($logs->hasPages())
                <div class="p-6 border-t border-base-300">
                    {{ $logs->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
