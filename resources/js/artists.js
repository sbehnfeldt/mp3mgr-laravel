import axios from 'axios';
import jQuery from 'jquery';

;(function (global, $) {
    'use strict';

    if (document.querySelector('.artists-page')) {

        let $table = $('table.artists');

        fetch('/api/artists');

        function fetch(url) {
            $table.addClass('loading');
            axios.get(url)
                .then(response => {
                    buildArtistsTableBody(response.data.data);
                    buildArtistsTableFooter(response.data);
                    $table.removeClass('loading');
                })
                .catch(error => {
                    alert("Error");
                    console.log(error);
                    $table.removeClass('loading');
                }).finally(() => {

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

            let $input = $('<input type="number">');
            $input.val(`${paging.current_page}`);
            $input.on('change', () => {
                fetch(`/api/artists?page=${$input.val()}`)
            });

            $td.append('Page ').append($input).append(`of ${paging.last_page}`);

            button = $('<button class="api">').text('>');
            if ( paging.next_page_url) {
                button.on('click', () => {
                    fetch(paging.next_page_url)
                });
            } else {
                button.attr('disabled', 'disabled');
            }

            $td.append(button);

            button = $('<button class="api">').text('>>');
            if ( paging.next_page_url) {
                button.on('click', () => {
                    fetch(paging.last_page_url)
                });
            } else {
                button.attr('disabled', 'disabled');
            }

            $td.append(button);

            $tr.append($td);
            $tfoot.append($tr);
        }
    }
})(this, jQuery);