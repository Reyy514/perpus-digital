<div x-data="{ editDialog: false }">
    @php $userReview = $book->comments()->where('user_id', Auth::id())->first(); @endphp

    @auth
        @if(Auth::user()->hasBorrowed($book))
            @if(!$userReview)
                <div class="bg-base-200/50 p-6 rounded-lg shadow-sm mb-8" x-data="{ rating: 0, hoverRating: 0 }">
                    <form action="{{ route('mahasiswa.reviews.store', $book) }}" method="POST">
                        @csrf
                        <h4 class="font-semibold text-lg text-neutral">Tulis Ulasan Anda</h4>
                        <div class="mt-2">
                            <label class="block font-medium text-sm text-neutral/80">Rating Anda:</label>
                            <div class="flex items-center mt-1">
                                <template x-for="i in 5" :key="i">
                                    <svg @click="rating = i" @mouseenter="hoverRating = i" @mouseleave="hoverRating = 0" class="w-8 h-8 cursor-pointer transition-colors" :class="i <= (hoverRating || rating) ? 'text-yellow-400' : 'text-neutral/30'" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                </template>
                            </div>
                            <input type="hidden" name="rating" x-model="rating">
                            @error('rating') <span class="text-error text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <label for="content" class="block font-medium text-sm text-neutral/80">Ulasan Anda:</label>
                            <textarea name="content" id="content" rows="4" class="mt-1 block w-full rounded-md bg-base-200 border-base-300 focus:border-primary focus:ring-primary/40 focus:ring-2" placeholder="Bagaimana pendapat Anda tentang buku ini?">{{ old('content') }}</textarea>
                            @error('content') <span class="text-error text-sm">{{ $message }}</span> @enderror
                        </div>
                        <x-primary-button type="submit" x-bind:disabled="rating === 0" class="mt-4">Kirim Ulasan</x-primary-button>
                    </form>
                </div>
            @endif
        @else
            <div class="rounded-md bg-primary/10 p-4 mb-8">
                <p class="text-sm text-primary">Anda harus pernah meminjam buku ini untuk dapat memberikan ulasan.</p>
            </div>
        @endif
    @endauth

    <!-- DAFTAR ULASAN -->
    <div class="space-y-8">
        @forelse($book->comments()->latest()->get() as $review)
            <div class="flex items-start gap-4 {{ $review->user_id == Auth::id() ? 'bg-primary/5 p-4 rounded-lg' : '' }}">
                <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=C4B5FD&color=232946&bold=true" alt="[Avatar pengguna]">
                <div class="w-full">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-neutral">{{ $review->user->name }}</p>
                        @if($review->rating) <x-star-rating :rating="$review->rating" size="w-4 h-4" /> @endif
                    </div>
                    <p class="text-neutral/80 mt-1">{{ $review->content }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-xs text-neutral/60">{{ $review->created_at->diffForHumans() }}</p>
                        @if($review->user_id == Auth::id())
                            <button @click="editDialog = true" class="text-sm text-primary hover:underline">Edit Ulasan Anda</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-neutral/70 text-center py-8">Jadilah yang pertama memberikan ulasan untuk buku ini.</p>
        @endforelse
    </div>

    <!-- DIALOG UNTUK EDIT ULASAN -->
    @if($userReview)
    <template x-teleport="body">
        <div x-show="editDialog" @click.away="editDialog = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
            <div @click.stop x-data="{ rating: {{ $userReview->rating ?? 0 }}, hoverRating: 0 }" class="w-full max-w-lg rounded-lg bg-base-100 p-6 shadow-xl">
                <form action="{{ route('mahasiswa.reviews.store', $book) }}" method="POST">
                    @csrf
                    <h3 class="text-xl font-bold">Edit Ulasan Anda</h3>
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-neutral/80">Rating Anda:</label>
                        <div class="flex items-center mt-1">
                            <template x-for="i in 5" :key="i"><svg @click="rating = i" @mouseenter="hoverRating = i" @mouseleave="hoverRating = 0" class="w-8 h-8 cursor-pointer transition-colors" :class="i <= (hoverRating || rating) ? 'text-yellow-400' : 'text-neutral/30'" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg></template>
                        </div>
                        <input type="hidden" name="rating" x-model="rating">
                    </div>
                    <div class="mt-4">
                        <label for="edit_content" class="block font-medium text-sm text-neutral/80">Ulasan Anda:</label>
                        <textarea name="content" id="edit_content" rows="4" class="mt-1 block w-full rounded-md bg-base-200 border-base-300 focus:border-primary focus:ring-primary/40 focus:ring-2">{{ old('content', $userReview->content) }}</textarea>
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <x-secondary-button type="button" @click="editDialog = false">Batal</x-secondary-button>
                        <x-primary-button type="submit">Simpan Perubahan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </template>
    @endif
</div>
