<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral leading-tight">
                    Manajemen Pengguna
                </h2>
                <p class="mt-1 text-sm text-neutral/70">Kelola semua akun pengguna mahasiswa.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <!-- Fitur Pencarian Fungsional -->
                    <form action="{{ route('admin.users.index') }}" method="GET" class="mb-6">
                         <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search text-neutral/50"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                            <input type="text" name="search" placeholder="Cari nama atau email pengguna..." value="{{ request('search') }}" class="block w-full rounded-lg border-base-300 bg-base-200/50 pl-10 pr-4 py-2.5 text-sm focus:border-primary focus:ring-primary/40 focus:ring-2">
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-base-300 hidden md:table">
                            <thead class="bg-base-200/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Nama Pengguna</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral/70 uppercase tracking-wider">Tgl. Bergabung</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-neutral/70 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-base-200">
                                @forelse ($users as $user)
                                <tr class="hover:bg-base-200/30" x-data="{ suspendDialog: false, deleteDialog: false }">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=7F5AF0&color=FFFFFF" alt="Avatar">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-neutral">{{ $user->name }}</div>
                                                <div class="text-sm text-neutral/70">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->status == 'active')
                                            <span class="inline-flex items-center gap-2 rounded-full bg-success/10 px-3 py-1 text-sm font-medium text-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 rounded-full bg-warning/10 px-3 py-1 text-sm font-medium text-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-off"><path d="M19.69 14a6.9 6.9 0 0 0 .31-2V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m2 2 20 20"/></svg>
                                                Suspended
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/80">{{ $user->created_at->isoFormat('DD MMM YYYY') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <button @click="suspendDialog = true" class="p-2 rounded-md transition-colors" :class="{ 'text-warning hover:bg-warning/10': '{{$user->status}}' === 'active', 'text-success hover:bg-success/10': '{{$user->status}}' !== 'active' }">
                                                @if($user->status === 'active')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-x"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="17" x2="22" y1="8" y2="13"/><line x1="22" x2="17" y1="8" y2="13"/></svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="16 11 18 13 22 9"/></svg>
                                                @endif
                                            </button>
                                            <button @click="deleteDialog = true" class="p-2 rounded-md text-error hover:bg-error/10 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            </button>
                                        </div>
                                        
                                        <!-- Dialog Konfirmasi Suspend -->
                                        <template x-teleport="body">
                                            <div x-show="suspendDialog" @click.away="suspendDialog = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
                                                <div @click.stop class="w-full max-w-md rounded-lg bg-base-100 p-6 shadow-xl text-left">
                                                    <h3 class="text-xl font-bold text-neutral">Konfirmasi Status</h3>
                                                    <p class="mt-2 text-neutral/70">Anda yakin ingin {{ $user->status === 'active' ? 'menonaktifkan' : 'mengaktifkan' }} akun "{{ $user->name }}"?</p>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <x-secondary-button @click="suspendDialog = false">Batal</x-secondary-button>
                                                        <form action="{{ route('admin.users.toggle_status', $user) }}" method="POST">
                                                            @csrf @method('PATCH')
                                                            <x-primary-button class="{{ $user->status === 'active' ? '!bg-warning' : '!bg-success' }}">Ya, Lanjutkan</x-primary-button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>

                                        <!-- Dialog Konfirmasi Hapus -->
                                        <template x-teleport="body">
                                            <div x-show="deleteDialog" @click.away="deleteDialog = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
                                                <div @click.stop class="w-full max-w-md rounded-lg bg-base-100 p-6 shadow-xl text-left">
                                                    <h3 class="text-xl font-bold text-neutral">Konfirmasi Hapus</h3>
                                                    <p class="mt-2 text-neutral/70">Yakin ingin menghapus akun "{{ $user->name }}"? Semua data terkait akan ikut terhapus.</p>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <x-secondary-button @click="deleteDialog = false">Batal</x-secondary-button>
                                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
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
                                    <td colspan="4" class="px-6 py-16 text-center text-neutral/60">Tidak ada data pengguna ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        {{-- Tampilan Kartu untuk Mobile --}}
                        <div class="space-y-4 md:hidden">
                            @forelse ($users as $user)
                                <div class="bg-base-200 p-4 rounded-lg" x-data="{ suspendDialog: false, deleteDialog: false }">
                                    <div class="flex items-center gap-4">
                                        <img class="h-12 w-12 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=7F5AF0&color=FFFFFF" alt="Avatar">
                                        <div class="flex-grow min-w-0">
                                            <p class="font-bold text-neutral truncate">{{ $user->name }}</p>
                                            <p class="text-sm text-neutral/70 truncate">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 border-t border-base-300 pt-3 flex items-center justify-between text-sm">
                                        @if($user->status == 'active')
                                            <span class="inline-flex items-center gap-2 rounded-full bg-success/10 px-3 py-1 text-xs font-medium text-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 rounded-full bg-warning/10 px-3 py-1 text-xs font-medium text-warning">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-off"><path d="M19.69 14a6.9 6.9 0 0 0 .31-2V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m2 2 20 20"/></svg>
                                                Suspended
                                            </span>
                                        @endif
                                        <div class="flex items-center gap-2">
                                            <button @click="suspendDialog = true" class="p-2 rounded-md transition-colors" :class="{ 'text-warning hover:bg-warning/10': '{{$user->status}}' === 'active', 'text-success hover:bg-success/10': '{{$user->status}}' !== 'active' }">...</button>
                                            <button @click="deleteDialog = true" class="p-2 rounded-md text-error hover:bg-error/10 transition-colors">...</button>
                                        </div>
                                    </div>
                                    {{-- Dialogs in a partial or here --}}
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <p class="text-neutral/60">Tidak ada data pengguna ditemukan.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
