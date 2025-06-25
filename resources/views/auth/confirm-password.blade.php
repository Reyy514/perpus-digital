<x-guest-layout>
    <div class="text-center sm:text-left">
        <h1 class="text-3xl font-bold text-neutral">Area Aman</h1>
        <p class="text-neutral/70 mt-2">
           Ini adalah area aman dari aplikasi. Mohon konfirmasi password Anda sebelum melanjutkan.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="mt-10 space-y-6">
        @csrf

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

        <div>
            <x-primary-button class="w-full justify-center">
                {{ __('Konfirmasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>