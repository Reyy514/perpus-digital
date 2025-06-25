<x-guest-layout>
    <div class="text-center sm:text-left">
        <h1 class="text-3xl font-bold text-neutral">Lupa Password Anda?</h1>
        <p class="text-neutral/70 mt-2">Tidak masalah. Masukkan email Anda dan kami akan mengirimkan link untuk mereset password.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="my-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="mt-10 space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Alamat Email" class="sr-only" />
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-at-sign text-neutral/50"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"/></svg>
                </div>
                <x-text-input id="email" class="block w-full pl-11 py-3" type="email" name="email" :value="old('email')" required autofocus placeholder="contoh@email.com"/>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center">
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </div>
    </form>
    
    <p class="mt-8 text-center text-sm text-neutral/70">
        Ingat password Anda?
        <a href="{{ route('login') }}" class="font-semibold leading-6 text-primary hover:text-primary/80">
            Kembali ke Login
        </a>
    </p>
</x-guest-layout>
