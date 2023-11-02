import axios from 'axios';
import jQuery from 'jquery';
import Handlebars from "handlebars";


(function (global, $) {
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
                })
                .catch(error => {
                    alert("Error");
                    console.log(error);
                }).finally(() => {
                    $table.removeClass('loading');
                }
            );
        }

        function buildArtistsTableBody(artists) {
            let $tbody = $('table.artists tbody');
            $tbody.empty();

            let source   = $('#artist-row-template')[0].innerHTML;
            let template = Handlebars.compile(source);

            for (let i = 0; i < artists.length; i++) {
                let artist = artists[i];
                $tbody.append(template(artist));
            }
        }

        function buildArtistsTableFooter(paging) {
            let $tfoot = $('table.artists tfoot');
            $tfoot.empty();

            let source      = $('#artists-table-footer-template')[0].innerHTML;
            let template    = Handlebars.compile(source);
            paging.disabled = {
                'backwards': paging.current_page === 1 ? 'disabled' : '',
                'forwards': paging.current_page === paging.last_page ? 'disabled' : ''
            };
            $tfoot.append(template(paging));

            // Assign on-click handlers to the paging buttons
            let map = {
                'paging-initial': paging.first_page_url,
                'paging-previous': paging.prev_page_url,
                'paging-next': paging.next_page_url,
                'paging-final': paging.last_page_url
            }
            Object.keys(map).forEach((k) => {
                $tfoot.off('click', `button.${k}`)
                    .on('click', `button.${k}`, () => {
                        fetch(map[k]);
                    })
            });
            $tfoot.off('change', 'input.paging-current')
                .on('change', 'input.paging-current', (event, b, c) => {
                    fetch(`/api/artists?page=${event.currentTarget.value}`)
                });
        }
    }
})(this, jQuery);