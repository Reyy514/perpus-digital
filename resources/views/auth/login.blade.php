<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center sm:text-left">
        <h1 class="text-3xl font-bold text-neutral">Selamat Datang Kembali</h1>
        <p class="text-neutral/70 mt-2">Silakan login untuk melanjutkan petualangan literasi Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="mt-10 space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Alamat Email" class="sr-only" />
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-at-sign text-neutral/50"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"/></svg>
                </div>
                <x-text-input id="email" class="block w-full pl-11 py-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="contoh@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" class="sr-only" />
             <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock text-neutral/50"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <x-text-input id="password" class="block w-full pl-11 py-3" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-base-300 text-primary shadow-sm focus:ring-primary" name="remember">
                <span class="ms-2 text-sm text-neutral/80">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-neutral/80 hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full text-center justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <p class="mt-8 text-center text-sm text-neutral/70">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold leading-6 text-primary hover:text-primary/80">
            Daftar sekarang
        </a>
    </p>
</x-guest-layout>
