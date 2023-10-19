import axios from 'axios';

if (document.querySelector('.albums-page')) {
    axios.get( '/api/albums' )
        .then(response => {
            console.log( response.data );
        })
        .catch( error => {
            alert( "Error" );
        });
}