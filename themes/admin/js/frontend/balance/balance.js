$( document).ready( function() {
    $('.withdrawal-notice').click( function() {
        $( '#modalDoWithdrawal').modal( 'hide' );
        $( '#modalWithdrawalNotice').modal( 'show' );
    } );

    $( '.submit-withdrawal').click( function() {
        $( '#modalWithdrawalNotice').modal( 'hide' );
        $.ajax( {
            url : '/balance/withdrawal'
            , dataType: 'json'
            , type : 'post'
            , data: { 'sum' : $( 'input[name="sum"]').val() , 'notice' : $( 'textarea[name="notice"]').val() }
            , success: function( r ) {
                if(r.success )  {
                    window.location.reload();
                }
            }
        } );
    } );
} );