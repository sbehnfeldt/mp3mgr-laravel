import axios from 'axios';
import jQuery from 'jquery';

;(function (global, $) {
    'use strict';

    if (document.querySelector('.artists-page')) {
        axios.get('/api/artists')
            .then(response => {
                buildArtistsTableBody(response.data.data);
                buildArtistsTableFooter(response.data);
            })
            .catch(error => {
                alert("Error");
                console.log(error);
            });

        function buildArtistsTableBody(artists) {
            let $tbody = $('table.artists tbody');
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
            console.log( paging );
            let $tfoot = $('table.artists tfoot');
            let $tr    = $('<tr>');

            let $td = $('<td colspan="3">');

            let button = $('<button>').text('<<');
            $td.append(button);
            button = $('<button>').text('<');
            $td.append(button);
            let span = $(`<span>Page ${paging.current_page} of ${paging.last_page}</span>`)
            $td.append(span);

            button = $('<button>').text('>');
            $td.append(button);
            button = $('<button>').text('>>');
            $td.append(button);
            $tr.append($td);
            $tfoot.append($tr);
        }
    }
})(this, jQuery);