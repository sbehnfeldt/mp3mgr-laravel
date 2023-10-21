import axios from 'axios';
import jQuery from 'jquery';

;(function (global, $) {
    'use strict';

    if (document.querySelector('.artists-page')) {
        axios.get('/api/artists')
            .then(response => {
                console.log( response.data );

                let artists = response.data.data;
                let $tbody = $('table.artists tbody');
                for (let i = 0; i < artists.length; i++) {
                    let artist = response.data.data[i];
                    let $tr = $('<tr>');
                    let $td = $('<td>').text( artist.id );
                    $tr.append($td);

                    $td = $('<td>').text( artist.name);
                    $tr.append($td);

                    $td = $('<td>' ).text( artist.albums_count );
                    $tr.append($td);

                    $tbody.append($tr);
                }


                let $tfoot = $('table.artists tfoot');
                let $tr = $('<tr>');

                let $td = $('<td colspan="3">');

                let button = $( '<button>' ).text( '<<');
                $td.append( button );
                button = $( '<button>' ).text( '<');
                $td.append( button );
                let span = $(`<span>Page ${response.data.current_page} of ${response.data.last_page}</span>`)
                $td.append( span );

                button = $( '<button>' ).text( '>');
                $td.append( button );
                button = $( '<button>' ).text( '>>');
                $td.append( button );
                $tr.append( $td);
                $tfoot.append( $tr);


            })
            .catch(error => {
                alert("Error");
                console.log(error);
            });
    }
})(this, jQuery);