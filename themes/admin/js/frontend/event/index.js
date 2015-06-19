$( document ).ready( function() {
    setCounters();

    $( '.filter .btn' ).click( function() {
        $( '.filter .btn').removeClass( 'active' );
        $( this).addClass( 'active' );
        $( '.search-results table').addClass('hidden');
        $( '#' + $( this).data('type')).removeClass('hidden');
    } );

    $( '.approve').click( function() {
        var self = this;
        if(confirm('Вы действительно хотите одобрить событие?')) {
            $.ajax( {
                url             : '/event/approve'
                , dataType      : 'json'
                , type          : 'post'
                , data          : { id : $( self).parents('tr').data( 'id' ) }
                , success       : function( r ) {
                    if( r['success'] )  {
                        $( 'tr[data-id="' + $( self ).parents('tr').data('id') + '"]').remove();
                        setCounters();
                    }
                }
            } );
        }
    } );

    $( '.disapprove').click( function() {
        var self = this;
        if(confirm('Вы действительно хотите не одобрять событие?')) {
            $.ajax( {
                url             : '/event/disapprove'
                , dataType      : 'json'
                , type          : 'post'
                , data          : { id : $( self).parents('tr').data( 'id' ) }
                , success       : function( r ) {
                    if( r['success'] )  {
                        $( 'tr[data-id="' + $( self ).parents('tr').data('id') + '"]').remove();
                        setCounters();
                    }
                }
            } );
        }
    } );

} );

function setCounters()  {
    $.each( $( '.filter .btn') , function( i , val ) {
        if( ! $( '#' + $( val).data('type') + ' tr').length )   {
            $( val).find( '.counter').text( 0 );
        } else {
            $( val).find( '.counter').text( $( '#' + $( val).data('type') + ' tr').length - 1 )
        }
    } );
}