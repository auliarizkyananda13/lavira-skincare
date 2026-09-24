<!-- Navigation Links -->
<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>