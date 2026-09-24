<nav x-data="{ open: false }" class="bg-white border-b shadow-sm" style="border-color: #dbeafe;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="LAVIRA" style="height: 42px;">
                </a>

                @php
                    $user = Auth::user();
                @endphp

                <div class="hidden sm:flex items-center gap-2">
                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('admin-dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin-dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('admin.products.create') }}" class="admin-nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">Tambah Produk</a>
                        <a href="{{ route('admin.orders') }}" class="admin-nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">Lihat Daftar Pesanan</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="admin-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-2">
                @guest
                    <a href="{{ route('login') }}" class="btn-nav-outline">Login</a>
                    <a href="{{ route('register') }}" class="btn-nav-solid">Register</a>
                @else
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="admin-user-pill">
                                    @auth
                                        <div>{{ Auth::user()->name }}</div>
                                    @endauth
                                    <svg class="fill-current h-4 w-4 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('dashboard')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-blue-400 hover:text-blue-600 hover:bg-blue-50 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background: #f0f6ff;">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @if (auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('admin-dashboard') }}" class="block py-2 text-blue-700 font-medium">Dashboard</a>
                <a href="{{ route('admin.products.create') }}" class="block py-2 text-blue-700 font-medium">Tambah Produk</a>
                <a href="{{ route('admin.orders') }}" class="block py-2 text-blue-700 font-medium">Lihat Daftar Pesanan</a>
            @else
                <a href="{{ route('dashboard') }}" class="block py-2 text-blue-700 font-medium">Dashboard</a>
            @endif
        </div>

        <div class="pt-4 pb-3 border-t" style="border-color: #dbeafe;">
            <div class="px-4">
                @auth
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('profile.edit') }}" class="block py-2 text-blue-700">{{ __('Profile') }}</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block py-2 text-red-600 cursor-pointer">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
.admin-nav-link {
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    color: #3b6fd6;
    text-decoration: none;
    transition: background 0.15s ease;
}
.admin-nav-link:hover {
    background: #eaf2fb;
    color: #2f5cb8;
}
.admin-nav-link.active {
    background: #3b6fd6;
    color: #fff;
}
.btn-nav-outline {
    padding: 8px 18px;
    border-radius: 20px;
    border: 1.5px solid #3b6fd6;
    color: #3b6fd6;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
}
.btn-nav-solid {
    padding: 8px 18px;
    border-radius: 20px;
    background: #3b6fd6;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
}
.admin-user-pill {
    display: inline-flex;
    align-items: center;
    padding: 8px 14px;
    border-radius: 20px;
    background: #eaf2fb;
    color: #2f5cb8;
    font-size: 14px;
    font-weight: 500;
    border: none;
}
</style>