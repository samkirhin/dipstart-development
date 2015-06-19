$( document ).ready( function() {
    if( $( '.datepicker').length )    {
        $( '.datepicker' ).datepicker( {
            closeText: 'Закрыть',
            prevText: '&#x3c;Пред',
            nextText: 'След&#x3e;',
            currentText: 'Сегодня',
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
            'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
            'Июл','Авг','Сен','Окт','Ноя','Дек'],
            dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
            dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false
        } );
    }

    if( $( '#showNews' ) )  {
        $( '#showNews').appendTo( $( 'body' ) );

        $.ajax( {
            url: '/new/getNews'
            , dataType: 'json'
            , type: 'POST'
            , success: function( r ) {
                if( !r.length )   {
                    $( '#showNews .empty-response').removeClass( 'hide' );
                    return;
                }
                $.each( r , function( i , val ) {
                    var oneNew = $( '#showNews .one-new.example').clone();
                    oneNew.removeClass( 'hide' );
                    oneNew.removeClass( 'example' );
                    oneNew.find( '.title h6').text( val.theme );
                    oneNew.find( '.text p').text( val.text );
                    oneNew.find( '.info .author').text( val.author.contactMan );
                    oneNew.find( '.info .read').attr( 'data-new-id' , val.id );
                    oneNew.find( '.info .subscribers a.subscribers-list').text( val.subscribers.length );
                    if( val.subscribers.length )    {
                        for( var i in val.subscribers ) {
                            if( val.subscribers[i] )    {
                                console.log( $( '#showNews').data( 'user' ) , val.subscribers[i].id )

                                if( $( '#showNews').data( 'user' ) == val.subscribers[i].id )   {
                                    oneNew.find( '.info .read').addClass( 'hide' );
                                    oneNew.removeClass( 'no-subscribed' );
                                }

                                oneNew.find( '.info .subscribers a.subscribers-list')
                                    .attr(
                                        'data-original-title'
                                        , oneNew.find( '.info .subscribers a.subscribers-list').data( 'originalTitle' ) + ( ( i == 0 ) ? '' : ', ' ) + val.subscribers[i]['email'] )
                            }
                        }
                    }
                    $( '#showNews .modal-body').append( oneNew );
                    $( '.subscribers-list').tooltip();

                    $( oneNew).find( '.btn.read' ).click( function() {
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
                                    alert( 'Подтверждено' );
                                    oneNew.removeClass( 'no-subscribed' );
                                    return;
                                }
                                alert( 'Не подтверждено' );
                            }
                        } );
                    } );
                } )
            }
        } );

    }
} );