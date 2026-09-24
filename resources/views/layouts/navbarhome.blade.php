<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Lavira" style="height: 65px;">
        </a>

        <form class="d-flex flex-grow-1 mx-4" role="search" action="{{ route('product.search') }}" method="GET">
            <div class="input-group">
                <input class="form-control" type="search" name="q" placeholder="Cari produk skincare..." aria-label="Search" value="{{ request('q') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>

        @unless(request()->routeIs('cart.index'))
        <a href="{{ route('cart.index') }}" class="text-dark me-2">
            <i class="fa fa-cart-shopping fs-4"></i>
        </a>
        @endunless

        @guest
        <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
        @else
        <div class="dropdown">
            <a href="#" class="text-dark dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
                <i class="fa fa-user fs-4"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        @endguest
    </div>

    </div>
</nav>