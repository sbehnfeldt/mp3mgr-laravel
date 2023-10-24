import jQuery from 'jquery';
import axios from "axios";

;(function (global, $) {
    'use strict';

    if (document.querySelector('.artist-page')) {
        let url = $(location).attr('href' ).split( '/');
        let id = url.pop();



        axios.get('/api/artists/' + id)
            .then(response => {
                let artist = response.data;
                $('h2').text( artist.name );

                let $albumList = $('ul.album-list');
                for ( let i = 0; i < artist.albums.length; i++ ) {
                    let album = artist.albums[i];
                    console.log( album );
                    let $li = $('<li>').addClass( 'album-title' ).text( album.title );
                    let $trackList = $('<ul>').addClass( 'track-list');

                    if ( artist.albums.length === i + 1) {
                        // ref: https://stackoverflow.com/questions/13554552/why-does-classlast-of-type-not-work-as-i-expect
                        $trackList.addClass( 'final' );
                    }
                    for ( let j = 0; j < album.tracks.length; j++ ) {
                        let track = album.tracks[j];
                        // console.log( track );
                        let $li2 = $('<li>').text( track.title );
                        $trackList.append($li2);
                    }
                    $li.append($trackList);
                    $albumList.append( $li );
                }

            })
            .catch(error => {
                alert("Error");
                console.log(error);
            });

    }
})(this, jQuery);