<nav class="menu primary-menu">
    <ul>
        <li>
            <a class="menu-item" href="{{ route('dashboard') }}">
                <x-application-logo/>
            </a>
        </li>
        <!-- Primary Navigation Menu -->

        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>

        <x-nav-link :href="route('details')" :active="request()->routeIs('details')">
            {{ __('Details') }}
        </x-nav-link>
    </ul>
</nav>
