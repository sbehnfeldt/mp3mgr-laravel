<x-app-layout>
    <main class="artists-page">
        <h2>{{ __('Artists') }}</h2>

        This is the &lt;main&gt; section of the <em>Artists</em> page.
    </main>

    <x-slot name="pageScript">
        <script type="module" src="/resources/js/artists.js"></script>
    </x-slot>
</x-app-layout>
