<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-neutral leading-tight">
            Tambah Buku Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6 md:p-8">
                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" x-data="{ imagePreview: null }">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="title" value="Judul Buku" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- FIX: Mengubah dropdown menjadi input teks untuk Penulis -->
                            <div>
                                <x-input-label for="author" value="Nama Penulis" />
                                <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author')" required />
                                <x-input-error :messages="$errors->get('author')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="category_id" value="Kategori" />
                                <select name="category_id" id="category_id" class="mt-1 block w-full rounded-lg border-base-300 bg-base-200/50 text-sm focus:border-primary focus:ring-primary/40 focus:ring-2">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2 space-y-6">
                                <div>
                                    <x-input-label for="stock" value="Stok" />
                                    <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock', 1)" required />
                                    <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="cover_image" value="Sampul Buku (Opsional)" />
                                    <div class="mt-2 flex items-center gap-4">
                                        <span class="h-24 w-16 rounded-md bg-base-200 flex items-center justify-center overflow-hidden">
                                            <template x-if="imagePreview">
                                                <img :src="imagePreview" alt="Pratinjau Gambar" class="h-full w-full object-cover">
                                            </template>
                                            <template x-if="!imagePreview">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image text-neutral/40"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                            </template>
                                        </span>
                                        <input @change="imagePreview = URL.createObjectURL($event.target.files[0])" type="file" name="cover_image" id="cover_image" class="block w-full text-sm text-neutral/70 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="description" value="Deskripsi" />
                                    <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-lg border-base-300 bg-base-200/50 text-sm focus:border-primary focus:ring-primary/40 focus:ring-2">{{ old('description') }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-base-300 pt-6 gap-4">
                            <a href="{{ route('admin.books.index') }}" class="text-sm font-semibold text-neutral/80 hover:underline">Batal</a>
                            <x-primary-button>Simpan Buku</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
