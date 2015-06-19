function validate( form )    {
    $.ajax( {
        url             : '/user/ajaxValidation'
        , type          : 'post'
        , dataType      : 'json'
        , data          : form.serialize()
        , success       : function( r ) {
            $( '.error').html( '' );
            if( ! r.success )   {
                $.each(r.error , function( i , val ) {
                    $( '.' + i ).html( val );
                } );
                return false;
            }
            validationChecked = true;
            form.submit();
            return true;
        }
    } );
}

