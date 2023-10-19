<x-app-layout>
    <main class="albums-page">
        <h2>{{ __('Albums') }}</h2>

        This is the &lt;main&gt; section of the <em>Albums</em> page.
    </main>

    <x-slot name="pageScript">
        <script type="module" src="/resources/js/albums.js"></script>
    </x-slot>
</x-app-layout>
