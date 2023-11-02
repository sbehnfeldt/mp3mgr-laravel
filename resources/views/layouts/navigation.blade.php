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

        <x-nav-link :href="route('artists')" :active="request()->routeIs('artists')">
            {{ __('Artists') }}
        </x-nav-link>

        <x-nav-link :href="route('albums')" :active="request()->routeIs('albums')">
            {{ __('Albums') }}
        </x-nav-link>

        <x-nav-link :href="route('tracks')" :active="request()->routeIs('tracks')">
            {{ __('Tracks') }}
        </x-nav-link>
    </ul>
</nav>
