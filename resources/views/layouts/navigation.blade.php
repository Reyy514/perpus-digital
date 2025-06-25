<nav x-data="{ open: false }" class="bg-base-100/80 backdrop-blur-sm border-b border-base-300 sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-8 w-auto text-primary" />
                    </a>
                </div>

                <!-- Navigation Links from partial -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Pastikan file ini ada di resources/views/layouts/partials/nav-links.blade.php --}}
                    @include('layouts.partials.nav-links')
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-theme-toggle />
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-neutral hover:text-primary transition duration-150 ease-in-out focus:outline-none p-1 rounded-full">
                                {{-- Avatar Pengguna --}}
                                <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=7F5AF0&color=FFFFFF&bold=true" alt="[Avatar pengguna]">
                                <div class="hidden md:block ml-2">
                                     <div class="text-left">
                                        <div class="font-semibold text-sm">{{ Auth::user()->name }}</div>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down ml-1 text-neutral/60"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- User Info Section in Dropdown --}}
                            <div class="flex items-center gap-3 px-4 py-3 border-b border-base-300">
                                <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=C4B5FD&color=232946&bold=true" alt="[Avatar pengguna]">
                                <div class="min-w-0">
                                    <div class="font-bold text-base text-neutral truncate">{{ Auth::user()->name }}</div>
                                    {{-- Kelas 'truncate' mencegah email panjang merusak layout --}}
                                    <div class="font-medium text-sm text-neutral/70 truncate">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                            
                            {{-- Dropdown Links --}}
                            <div class="py-1">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{-- Icon dari Lucide (100% Akurat) --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3"/><path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"/></svg>
                                    {{ __('Profil Saya') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();" class="text-error hover:!text-white hover:!bg-error">
                                        {{-- Icon dari Lucide (100% Akurat) --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out mr-2 h-4 w-4"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                 <x-theme-toggle />
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-neutral/70 hover:text-neutral hover:bg-base-200 focus:outline-none focus:bg-base-200 focus:text-neutral transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- Pastikan file ini ada di resources/views/layouts/partials/responsive-nav-links.blade.php --}}
            @include('layouts.partials.responsive-nav-links')
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-base-300">
            <div class="px-4">
                <div class="font-medium text-base text-neutral">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-neutral/70">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil Saya') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
