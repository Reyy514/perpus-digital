@if(Auth::user()->isAdmin())
    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-nav-link>
    <x-nav-link :href="route('admin.books.index')" :active="request()->routeIs('admin.books.*')">Buku</x-nav-link>
    <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">Kategori</x-nav-link>
    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">Users</x-nav-link>
    <x-nav-link :href="route('admin.borrowings.index')" :active="request()->routeIs('admin.borrowings.*')">Peminjaman</x-nav-link>
    <x-nav-link :href="route('admin.comments.index')" :active="request()->routeIs('admin.comments.*')">Ulasan</x-nav-link>
    <x-nav-link :href="route('admin.activity_logs.index')" :active="request()->routeIs('admin.activity_logs.index')">Log</x-nav-link>
@else
    <x-nav-link :href="route('mahasiswa.dashboard')" :active="request()->routeIs('mahasiswa.dashboard')">Dashboard</x-nav-link>
    <x-nav-link :href="route('mahasiswa.books.index')" :active="request()->routeIs('mahasiswa.books.*')">Katalog</x-nav-link>
    <x-nav-link :href="route('mahasiswa.borrowings.index')" :active="request()->routeIs('mahasiswa.borrowings.index')">Pinjaman Saya</x-nav-link>
    <x-nav-link :href="route('mahasiswa.wishlist.index')" :active="request()->routeIs('mahasiswa.wishlist.index')">Wishlist</x-nav-link>
@endif