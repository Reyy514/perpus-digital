<template x-teleport="body">
    <div x-show="dialog" @click.away="dialog = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
        <div @click.stop class="w-full max-w-md rounded-lg bg-base-100 p-6 shadow-xl text-left">
            <h3 class="text-xl font-bold text-neutral">Konfirmasi Pengembalian</h3>
            <p class="mt-2 text-neutral/70">Anda yakin ingin menandai buku "{{ $item->book->title }}" telah dikembalikan oleh {{ $item->user->name }}?</p>
            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button @click="dialog = false">Batal</x-secondary-button>
                <form action="{{ route('admin.borrowings.return', $item) }}" method="POST">
                    @csrf @method('PATCH')
                    <x-primary-button type="submit">Ya, Konfirmasi</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</template>