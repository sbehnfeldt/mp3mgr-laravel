<x-app-layout>
    <x-slot name="pageClass">artists-page</x-slot>

    <h2>{{ __('Artists') }}</h2>


    <table class="artists">
        <thead>
            <tr>
                <th>ID</th>
                <th>Artist Name</th>
                <th>Number of Albums</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot></tfoot>
    </table>
</x-app-layout>
