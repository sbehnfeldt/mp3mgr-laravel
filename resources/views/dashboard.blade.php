<x-app-layout>
    <x-slot name="pageClass">dashboard-page</x-slot>

    <h2>{{ __('Dashboard') }}</h2>
    <a href="/artists">Artists</a>: {{$artists}}<br/>
    <a href="/albums">Albums</a>: {{$albums}}<br/>
    <a href="/tracks">Tracks</a>: {{$tracks}}<br/>

</x-app-layout>
