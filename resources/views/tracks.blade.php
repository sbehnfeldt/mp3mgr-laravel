<x-app-layout>
    <x-slot name="pageClass">tracks-page</x-slot>

    <h2>{{ __('Tracks') }}</h2>

    <table class="tracks">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Album</th>
                <th>Track #</th>
                <th>Filename</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot></tfoot>
    </table>

    @verbatim
        <script id="tracks-table-row-template" type="text/x-handlebars-template">
            <tr>
                <td>{{title}}</td>
                <td>{{artist.name}}</td>
                <td>{{album.title}}</td>
                <td>{{track}}</td>
                <td>{{filename}}</td>
            </tr>
        </script>

        <script id="tracks-table-footer-template" type="text/x-handlebars-template">
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
