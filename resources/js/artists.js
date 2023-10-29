import axios from 'axios';
import jQuery from 'jquery';

;(function (global, $) {
    'use strict';

    if (document.querySelector('.artists-page')) {
        fetch('/api/artists');

        function fetch(url) {
            console.log(url);
            axios.get(url)
                .then(response => {
                    buildArtistsTableBody(response.data.data);
                    buildArtistsTableFooter(response.data);
                })
                .catch(error => {
                    alert("Error");
                    console.log(error);
                });
        }

        function buildArtistsTableBody(artists) {
            let $tbody = $('table.artists tbody');
            $tbody.empty();
            for (let i = 0; i < artists.length; i++) {
                let artist = artists[i];
                let $tr    = $('<tr>');
                let $td    = $('<td>').text(artist.id);
                $tr.append($td);

                let $a = $('<a>').text(artist.name).attr('href', '/artists/' + artist.id);
                $td    = $('<td>');
                $td.append($a);
                $tr.append($td);

                $td = $('<td>').text(artist.albums_count);
                $tr.append($td);

                $tbody.append($tr);
            }
        }

        function buildArtistsTableFooter(paging) {
            console.log(paging);
            let $tfoot = $('table.artists tfoot');
            $tfoot.empty();
            let $tr = $('<tr>');

            let $td = $('<td colspan="999">');

            let button = $('<button class="api">').text('<<');
            if (1 < paging.current_page) {
                button.on('click', () => {
                    fetch(paging.first_page_url)
                });
            } else {
                button.prop('disabled', true);
            }
            $td.append(button);

            button = $('<button class="api">').text('<');
            if (1 < paging.current_page) {
                button.on('click', () => {
                    fetch(paging.prev_page_url)
                });
            } else {
                button.attr('disabled', 'disabled');
            }
            $td.append(button);

            let span = $(`<span>Page ${paging.current_page} of ${paging.last_page}</span>`)
            $td.append(span);

            button = $('<button class="api">').text('>').on('click', () => {
                fetch(paging.next_page_url)
            });
            $td.append(button);

            button = $('<button class="api">').text('>>').on('click', () => {
                fetch(paging.last_page_url);
            });
            $td.append(button);

            $tr.append($td);
            $tfoot.append($tr);
        }
    }
})(this, jQuery);