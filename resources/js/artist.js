import jQuery from 'jquery';
import axios from "axios";
import Handlebars from "handlebars";


;(function (global, $) {
    'use strict';

    if (document.querySelector('.artist-page')) {
        // Fetch API data for the artist identified (by artist ID) in the URL
        // and use that data to build the album list
        (function (url) {
            axios.get(url)
                .then(response => {
                    let artist = response.data;
                    $('h2').text(artist.name);
                    $('ul.album-list')[0].innerHTML = Handlebars.compile($('#album-list-item-template')[0].innerHTML)(artist);
                })
                .catch(error => {
                    alert("Error");
                    console.log(error);
                });
        })('/api/artists/' + $(location).attr('href').split('/').pop())
    }
})(this, jQuery);