var saveTmpFilter = true;

$(function(){
    $('.save_filter').click( function( e ){
        e.preventDefault();
        saveFilter( function() { return; } );
    });

    $( '.additionalOrderFields label').hide();

    $(document).on( 'click' , '#modalTemplates .modal-body a' , function() {
        loadFilter( $( this ).data( 'filter' ) )
    });



    $( '#filter-form' ).submit( function( e ) {
        var self = this;
        e.preventDefault();
        if( saveTmpFilter ) {
            saveTmpFilter = false;
            $( '#modalTemplates input[name="name"]' ).val( 'tmp' );
            $( '#modalTemplates input[name="tmp"]' ).val( 1 );
            saveFilter( function() { $( '#filter-form' ).submit(); } );
        } else {
            self.submit()
        }
    } );

    if( $( '.tmpFilter' ).data( 'check' ) ) {
        loadFilter( $( '.tmpFilter' ).data( 'filter' ) );
    } else if( $( '.selectedFilter' ).data( 'filter' ).length ) {
        loadFilter( $( '.selectedFilter' ).data( 'filter' ) );
    }

    if( $( 'input[name="ds_order[orderType]"]' ).length != 0 )    {
        var inp = $( 'input[name="ds_order[orderType]"]' );
        if( inp.val().length != 0 ) {
            $( '.orderType.btn' ).removeClass( 'active' );
            $( '.orderType.btn[data-value="' + inp.val() + '"]' ).addClass( 'active' );
        }
    }

    $( '.orderType.btn' ).click( function() {
        $( '.orderType.btn' ).removeClass( 'active' );
        $( this ).addClass( 'active' );
        $( 'input[name="ds_order[orderType]"]' ).val( $( this ).data( 'value' ) );
        document.getElementById( 'filter-form' ).submit();
    } );

    if( $( '.selectedOrderType').data( 'type' ) )  {
        document.getElementById( 'filter-form' ).submit();
    }

    $( '.cleanFilter' ).click( function() {
        if( cleanFilter() ) {
            saveFilter( function() { $( '#filter-form' ).submit(); } );
        }
    } );

});

function cleanFilter()  {
    var form = $( '#filter-form' );
    form.find( 'input[type="checkbox"]').removeAttr( 'checked' );
    form.find( 'input[type="text"]').val();
    form.find( 'input[type="radio"]').prop( 'checked' , false );
    form.find( 'input[type="radio"][value="0"]').attr( 'checked' , 'checked' );
    form.find( 'textarea').text( '' );
    return true;
}


function loadFilter( data ) {
    var filter = unserialize( data );
    $('[name="name"]').val(filter['name']);
    for(var key in filter['ds_order']) {
        if( typeof( filter['ds_order'][key] ) != 'object' ) {
            if( filter['ds_order'][key] && filter['ds_order'][key] != 0 )   {
                $( '.additionalOrderFields .' + key).show();
            }
            if( key == 'orderType' ){
                $( '.orderType.btn' ).removeClass( 'active' );
                $( '.orderType.btn[data-value="' + filter['ds_order'][key] + '"]' ).addClass( 'active' );
                $( 'input[name="ds_order[orderType]"]' ).val( $( '.orderType.btn[data-value="' + filter['ds_order'][key] + '"]' ).data( 'value' ) )
            } else {
                $('[name="ds_order['+key+']"]').val(filter['ds_order'][key]);
                if( $('[name="ds_order['+key+']"]').attr( 'type' ) == 'checkbox' )  {
                    $('[name="ds_order['+key+']"]').attr( 'checked' , 'checked' )
                }
            }
        }
        else {
            for(var sub in filter['ds_order'][key]) {
                if( $('[name="ds_order['+key+']['+sub+']"]').attr( 'type' ) == 'checkbox'  )    {
                    $('[name="ds_order['+key+']['+sub+']"]').attr( 'checked' , 'checked' );
                }
            }
        }

    }
}

function saveFilter( callback )  {
    $.ajax({
        url: '/order/filterSave',
        type: 'POST',
        data: $('#filter-form').serialize(),
        success: function(data) {
            if(data.success) {
                var id = data.id;
                $.ajax({
                    url: '/order/getFilterList',
                    success: function(data) {
                        if(data.success) {
                            callback();
                            $('#modalTemplates .modal-body > div').empty();
                            for(var i = 0; i < data.data.length; i++) {
                                var line = $('<a>', {
                                    'href': '#',
                                    'data-value': data.data[i].id,
                                    'text': data.data[i].name,
                                    'data-filter': data.data[i].filter,
                                    'data-check': data.data[i].tmp ? 1 : 0,
                                    'class': data.data[i].tmp ? 'tmpFilter hidden' : ''
                                });
                                var container = $( '<div>' );
                                if(data.data[i].id == id) {
                                    line.attr( 'disabled' , 'disabled' )
                                }
                                container.html( line );
                                $('#modalTemplates .modal-body').prepend( container ) ;
                            }
                        } else {
                            alert(data.error);
                        }
                    }
                });
            } else {
                alert(data.error);
            }
        }
    });
}