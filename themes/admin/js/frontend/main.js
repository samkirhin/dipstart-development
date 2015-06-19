$( document ).ready( function() {

function FooterBottomAuto()
{
  var documentHeight = $(document).outerHeight();
  var windowHeight = $(window).outerHeight();
  var windowWidth = $(document).outerWidth();
  var difference = documentHeight - windowHeight;

  if (difference <= 0) {
    $('#footer').css('position','absolute');
    $('#footer').css('bottom','0px');
    $('#footer').css('width',windowWidth - 20 +'px');
  }
}

  FooterBottomAuto();
  $(function(){
    $(window).resize(function() {
      FooterBottomAuto();
    })
  })


    if( $('.custom-scrollbar').length ) {
        $( ".custom-scrollbar").not( '.modal .custom-scrollbar' ).not( '.mCustomScrollbar' ).mCustomScrollbar( {
            scrollButtons:{
                enable:true
            }
        } );
    }
    if( $( '.modal').length )   {
        $('.modal').bind('shown', function() {
            $( ".modal .custom-scrollbar").not( '.mCustomScrollbar' ).mCustomScrollbar( {
                scrollButtons:{
                    enable:true
                }
            } );
        } );
    }

    if( $( '.custom-select').length )   {
        $( '.custom-select').customSelect();
    }

    if( $( '.with-tooltip').length )   {
        $( '.with-tooltip').tooltip( {
            position: { my : 'right+225 center' , at : 'right center' }
        } );
    }

    if( $( '#showNews').length )  {
        $.ajax( {
            url: '/new/getNews'
            , dataType: 'json'
            , type: 'POST'
            , success: function( r ) {
                if( !r.length )   {
                    $( '#showNews .empty-response').removeClass( 'hide' );
                    return;
                }
                for( var k in r ) {
                    var oneNew = $( '#showNews .one-new.example').clone();
                    oneNew.removeClass( 'hide' );
                    oneNew.removeClass( 'example' );
                    oneNew.find( '.title h6').text( r[k].theme );
                    oneNew.find( '.text p').text( r[k].text );
                    oneNew.find( '.info .author').text( r[k].author.contactMan + ' (' + r[k].author.email + ')' );
                    oneNew.find( '.info .read').attr( 'data-new-id' , r[k].id );
                    oneNew.find( '.info .subscribers a.subscribers-list .number').text( r[k].subscribers.length );

                    if( r[k].subscribers.length )    {
                        var subsList = '';
                        for( var i in r[k].subscribers ) {
                            if( r[k].subscribers[i] )    {
                                if( $( '#showNews').data( 'user' ) == r[k].subscribers[i].id )   {
                                    oneNew.find( '.btn.read').hide();
                                    oneNew.removeClass( 'no-subscribed' );
                                }
                                subsList += ( ( i == 0 ) ? '' : ', ' ) + r[k].subscribers[i]['email'];
                            }
                        }
                        oneNew.find( '.info .subscribers a.subscribers-list').attr(
                            'data-original-title'
                            , subsList
                        )
                    }

                    $( '#showNews .modal-body').append( oneNew );
                    $( '.subscribers-list').tooltip( { placement : 'bottom' } );
                }
            }
        } );

        $( '#showNews' ).on( 'click' , ' .btn.read' , function() {
            if( ! $( this).data( 'newId' ) )    {
                alert( 'Ошибка подтверждения.' );
                return;
            }
            var self = this;
            $.ajax( {
                url: '/new/readNew'
                , type: 'POST'
                , dataType: 'json'
                , data: { 'id' : $( self ).data( 'newId' )  }
                , success: function( r ) {
                    if( ! r )   {
                        return;
                    }
                    if( r.success ) {
                        $(self).parents('.one-new').removeClass( 'no-subscribed' );
                        $(self).hide();
                        alert( 'Подтверждено' );
                        return;
                    }
                    alert( 'Не подтверждено' );
                }
            } );
        } );
    }

    $( '.enable-all').click( function() {
        $( '.' + $( this).data('class') ).find( 'input[type="checkbox"]').prop( 'checked' , 'checked' );
    } );

    $( '.disable-all').click( function() {
        $( '.' + $( this).data('class') ).find( 'input[type="checkbox"]').removeAttr( 'checked' );
    } );

    $( document ).on( 'click' , '.search-results tr:not(.header) td:not(.additional)' , function() {
        if( ! $( this ).parent( 'tr' ).data( 'href').length )   {
            return;
        }
        window.location.href = $( this ).parent( 'tr' ).data( 'href' );
    } );

    $( document).on( 'click' , '.search-results .get-all-results' , function() {
        var self = this;
        if( ! $( self ).data( 'loadUrl' ) ) {
            return;
        }
        $.ajax( {
            url         : $( self).data( 'loadUrl' ),
            type        : 'post',
            dataType    : 'json',
            success     : function( r ) {
                $( self).parent( '.search-results').find( '.' )
            }
        } );
    } );
} );