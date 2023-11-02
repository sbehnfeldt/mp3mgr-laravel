import axios from 'axios';
import jQuery from 'jquery';
import Handlebars from "handlebars";


(function (global, $) {
    'use strict';

    if (document.querySelector('.tracks-page')) {

        let $table = $('table.tracks');
        fetch('/api/tracks');

        function fetch(url) {
            $table.addClass('loading');
            axios.get(url)
                .then(response => {
                    buildTracksTableBody(response.data.data);
                    buildTracksTableFooter(response.data);
                })
                .catch(error => {
                    alert("Error");
                    console.log(error);
                }).finally(() => {
                    $table.removeClass('loading');
                }
            );
        }

        function buildTracksTableBody(tracks) {
            let $tbody = $('table.tracks tbody');
            $tbody.empty();
            let source   = $('#tracks-table-row-template')[0].innerHTML;
            let template = Handlebars.compile(source);

            for (let i = 0; i < tracks.length; i++) {
                let track = tracks[i];
                $tbody.append(template(track));
            }
        }

        function buildTracksTableFooter(paging) {
            let $tfoot = $('table.tracks tfoot');
            $tfoot.empty();

            let source      = $('#tracks-table-footer-template')[0].innerHTML;
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
                    fetch(`/api/tracks?page=${event.currentTarget.value}`)
                });
        }
    }

})(this, jQuery);