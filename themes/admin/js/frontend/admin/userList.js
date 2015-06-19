$( document).ready( function() {

    $('#userLists').tab();

    $( '.tablesorter' ).tablesorter();

    $( 'tr[data-href] td').click( function() {
        window.location.href = $( this).parent().data('href');
    } );

} );