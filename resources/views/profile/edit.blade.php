<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-neutral leading-tight">
            {{ __('Pengaturan Profil & Akun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'profile' }" x-init="() => { window.onhashchange = () => { tab = window.location.hash.substring(1) } }">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                {{-- Navigasi Tab Samping --}}
                <aside class="md:col-span-1">
                    <nav class="space-y-1">
                        <a @click.prevent="tab = 'profile'; window.location.hash = 'profile'" href="#" class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200" :class="{ 'bg-primary text-white shadow-lg shadow-primary/30': tab === 'profile', 'text-neutral/70 hover:bg-base-100 hover:text-primary': tab !== 'profile' }">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-cog"><path d="M2 21a8 8 0 0 1 11.873-7.733"/><circle cx="10" cy="8" r="5"/><circle cx="18" cy="18" r="3"/><path d="m19.5 14.5-.42.24"/><path d="m16.5 21.5.42-.24"/><path d="m19.5 21.5-.42-.24"/><path d="m16.5 14.5.42.24"/></svg>
                            <span class="ms-3 font-semibold">Informasi Profil</span>
                        </a>
                        <a @click.prevent="tab = 'password'; window.location.hash = 'password'" href="#" class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200" :class="{ 'bg-primary text-white shadow-lg shadow-primary/30': tab === 'password', 'text-neutral/70 hover:bg-base-100 hover:text-primary': tab !== 'password' }">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-key-round"><path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z"/><circle cx="16.5" cy="7.5" r=".5"/></svg>
                            <span class="ms-3 font-semibold">Update Password</span>
                        </a>
                        <a @click.prevent="tab = 'delete'; window.location.hash = 'delete'" href="#" class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 group" :class="{ 'bg-error text-white shadow-lg shadow-error/30': tab === 'delete', 'text-neutral/70 hover:bg-base-100 hover:text-error': tab !== 'delete' }">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 group-hover:text-error" :class="{'text-white': tab === 'delete', 'text-neutral/70': tab !== 'delete'}"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            <span class="ms-3 font-semibold">Hapus Akun</span>
                        </a>
                    </nav>
                </aside>

                {{-- Konten Tab --}}
                <div class="md:col-span-3">
                    <div x-show="tab === 'profile'" x-transition.opacity.duration.500ms>
                        <div class="p-6 sm:p-8 bg-base-100 shadow-lg rounded-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    <div x-show="tab === 'password'" x-transition.opacity.duration.500ms style="display: none;">
                        <div class="p-6 sm:p-8 bg-base-100 shadow-lg rounded-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                     <div x-show="tab === 'delete'" x-transition.opacity.duration.500ms style="display: none;">
                        <div class="p-6 sm:p-8 bg-base-100 shadow-lg rounded-xl border border-error/50">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
