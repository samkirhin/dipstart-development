$( document ).ready( function() {
    $( '#save-user').click( function() {
        $.ajax( {
            url: '/admin/userSave'
            , type: 'POST'
            , dataType: 'json'
            , data: $( '#user-edit').serialize()
            , success: function( r ) {
                alert(r.success );
            }
        } );
    } );
} );