<x-guest-layout>
    <div class="text-center sm:text-left">
        <h1 class="text-3xl font-bold text-neutral">Verifikasi Email Anda</h1>
        <p class="text-neutral/70 mt-2">
            Terima kasih sudah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email dengan mengklik link yang baru saja kami kirimkan?
        </p>
         <p class="text-neutral/70 mt-2">
            Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan yang lain.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="my-6 font-medium text-sm text-success bg-success/10 p-4 rounded-lg">
            Link verifikasi baru telah berhasil dikirim ke alamat email yang Anda berikan saat pendaftaran.
        </div>
    @endif

    <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-neutral/80 hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>