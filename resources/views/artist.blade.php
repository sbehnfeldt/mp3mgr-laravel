<x-app-layout>
    <x-slot name="pageClass">artist-page</x-slot>
    <h2>Artist Page</h2>
    <ul class="album-list"/>

    @verbatim
        <script id="album-list-item-template" type="text/x-handlebars-template">
            {{#each albums}}
            <li class="album {{#if @last}} final-album {{/if}}">
                <ul class="track-list">{{title}}
                    {{#each tracks}}
                    <li class="track">{{title}}</li>
                    {{/each}}
                </ul>
            </li>
            {{/each}}
        </script>

        <script id="track-list-item-template" type="text/x-handlebars-template">
        </script>
    @endverbatim
</x-app-layout>
