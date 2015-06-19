$( document ).ready( function() {
    $( '.user-properties .save').click( function() {
        var self = $( this );
        $.ajax( {
            url         : '/user/ajaxSave'
            , type      : 'post'
            , dataTyp   : 'json'
            , data      : $( '.user-properties').serialize()
            , success   : function( r ) {
                $( '.error').html( '' );
                if( !r.success )    {
                    $.each(r.error , function(i , val) {
                        $( '.error.' + i ).html( val );
                    } );
                } else {
                    $.notice.show('Внимание', 'Данные успешно сохранены', 'status', true);
                }
            }
        } );
    } );

    $('.wm_add').click(function(){
        var size = parseInt($("select.webmoneyType:first option").size()) * 3;
        var nowSize = parseInt($("select.webmoneyType").size());
        //set collection of wm id fields
        var collection = $( 'input[name="user[webmoney]"]');
        //if penult field with wm id not filled - get error
        if( ! collection.eq( collection.length - 2 ).val().length )   {
            alert( 'Вы не указали номер кошелька' );
            return;
        }
        if(size >= nowSize) {
            $('.wmC').append($('<div class="wmRow">'+$('.wmRow.hidden').html()+'</div>'));
        } else {
            alert('Разрешено только по 3 кошелька одной валюты');
        }
    });

    $(document).on('click', '.wm_rm', function(){
        $(this).parent('.wmRow').remove();
    });

    $( '#sendInviteSubmit').on( 'click' , function() {
        $.ajax( {
            url : '/main/sendInvite'
            , type : 'POST'
            , dataType : 'json'
            , data : { email : $( '#sendInvite input[name="email"]').val() }
            , success : function( r ) {
                if( ! r.success ) {
                    alert( r.message );
                    return;
                }
                $( '.fade').removeClass( 'in' );
            }
        } );
    } );
} );
