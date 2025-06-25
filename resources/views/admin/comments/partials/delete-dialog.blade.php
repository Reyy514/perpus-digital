<template x-teleport="body">
    <div x-show="dialog" @click.away="dialog = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
        <div @click.stop class="w-full max-w-md rounded-lg bg-base-100 p-6 shadow-xl text-left">
            <h3 class="text-xl font-bold text-neutral">Konfirmasi Hapus Ulasan</h3>
            <p class="mt-2 text-neutral/70">Anda yakin ingin menghapus ulasan ini secara permanen? Tindakan ini tidak dapat diurungkan.</p>
            <blockquote class="mt-4 border-l-4 border-base-300 pl-4 text-neutral/80 italic">
                "{{ Str::limit($review->content, 100) }}"
            </blockquote>
            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button @click="dialog = false">Batal</x-secondary-button>
                <form action="{{ route('admin.comments.destroy', $review) }}" method="POST">
                    @csrf @method('DELETE')
                    <x-danger-button type="submit">Ya, Hapus Ulasan</x-danger-button>
                </form>
            </div>
        </div>
    </div>
</template>