<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-neutral leading-tight">
            Edit Kategori: {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6 md:p-8">
                    <form action="{{ route('admin.categories.update', $category) }}" method="POST"
                          x-data="{ name: '{{ old('name', $category->name) }}' }">
                        @csrf
                        @method('PATCH')
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="name" value="Nama Kategori" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" x-model="name" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                             <div>
                                <x-input-label for="slug" value="Slug (dihasilkan otomatis)" />
                                <x-text-input id="slug" class="block mt-1 w-full bg-base-200/60" type="text" :value="old('slug', $category->slug)"
                                      x-bind:value="name.toLowerCase().replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-')"
                                      readonly disabled />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-base-300 pt-6 gap-4">
                            <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold text-neutral/80 hover:underline">Batal</a>
                            <x-primary-button>Perbarui Kategori</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>