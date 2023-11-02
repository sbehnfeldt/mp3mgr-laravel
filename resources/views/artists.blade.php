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

    @verbatim
        <script id="artist-row-template" type="text/x-handlebars-template">
            <tr>
                <td>{{id}}</td>
                <td><a href="/artists/{{id}}">{{name}}</a></td>
                <td>{{albums_count}}</td>
            </tr>
        </script>

        <script id="artists-table-footer-template" type="text/x-handlebars-template">
            <tr>
                <td colspan="9999">
                    <button class="paging paging-initial" {{disabled.backwards}} onClick="() => fetch( '/api/artists')">
                        &lt;&lt;
                    </button>
                    <button class="paging paging-previous" {{disabled.backwards}}>&lt;</button>
                    Page <input class="paging paging-current" type="number" value="{{current_page}}"> of {{last_page}}
                    <button class="paging-next" {{disabled.forwards}}>&gt;</button>
                    <button class="paging-final" {{disabled.forwards}}>&gt;&gt;</button>
                </td>
            </tr>
        </script>
    @endverbatim

</x-app-layout>
