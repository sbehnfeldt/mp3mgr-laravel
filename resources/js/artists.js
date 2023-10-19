import axios from 'axios';

if (document.querySelector('.artists-page')) {
    axios.get( '/api/artists' )
        .then(response => {
            console.log( response.data );
        })
        .catch( error => {
            alert( "Error" );
        });
}