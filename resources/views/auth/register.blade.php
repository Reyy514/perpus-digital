<x-guest-layout>
    <div class="text-center sm:text-left">
        <h1 class="text-3xl font-bold text-neutral">Buat Akun Baru</h1>
        <p class="text-neutral/70 mt-2">Bergabunglah dengan komunitas pembaca kami hari ini.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-10 space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" class="sr-only"/>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user text-neutral/50"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <x-text-input id="name" class="block w-full pl-11 py-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Lengkap"/>
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Alamat Email" class="sr-only"/>
             <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-at-sign text-neutral/50"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"/></svg>
                </div>
                <x-text-input id="email" class="block w-full pl-11 py-3" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contoh@email.com"/>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" class="sr-only"/>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock text-neutral/50"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <x-text-input id="password" class="block w-full pl-11 py-3" type="password" name="password" required autocomplete="new-password" placeholder="Password"/>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" class="sr-only"/>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-keyhole text-neutral/50"><circle cx="12" cy="16" r="1"/><rect x="3" y="10" width="18" height="12" rx="2"/><path d="M7 10V7a5 5 0 0 1 9.33-2.5"/></svg>
                </div>
                <x-text-input id="password_confirmation" class="block w-full pl-11 py-3" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password"/>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    
    <p class="mt-8 text-center text-sm text-neutral/70">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold leading-6 text-primary hover:text-primary/80">
            Masuk di sini
        </a>
    </p>
</x-guest-layout>
