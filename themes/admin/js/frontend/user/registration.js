var orderLines = [];
var validationChecked = false;

$( function() {

    $( '.btn.show_additional').click( function() {
        $( this).hide();
        $( '.additional_fields').removeClass( 'hidden' );
    } );

    if( $( '.datepicker').length > 0 )  {
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

    $( '.user-registration').submit( function( e ) {
        var self    = $( this );
        if( ! validationChecked ) {
            e.preventDefault();
            validate( self );
        }
    } );

    $('.disc_type').change(function(){
        var row = $(this);
        $.ajax({
            url: '/user/getCatalog',
            type: 'POST',
            data: 'id='+row.val(),
            success: function(data) {
                if(data.success) {
                    $('select.subjectMatter').empty();
                    for(var i = 0; i < data.items['item'][data.id].length; i++) {
                        var line = $('<option>', {
                            'value': data.items['item'][data.id][i].id,
                            'text': data.items['item'][data.id][i].name
                        });
                        $('select.subjectMatter').append(line);
                    }
                }
            }
        });
    });

    $('.sel_work_type').click(function(e){
        e.preventDefault();
        if($(this).attr('state') == 'not_checked') {
            $('.work_type').attr('checked', 'checked');
            $(this).attr('state', 'checked');
            $(this).html('Снять метку со всех');
        } else {
            $(this).html('Выбрать все');
            $(this).attr('state', 'not_checked');
            $('.work_type').removeAttr('checked');
        }
    });

    $('.disc_sel').click(function(e){
        e.preventDefault();
        if($(this).attr('state') == 'not_checked') {
            $('.disc_'+$(this).attr('type')).attr('checked', 'checked');
            $(this).attr('state', 'checked');
        } else {
            $(this).attr('state', 'not_checked');
            $('.disc_'+$(this).attr('type')).removeAttr('checked');
        }
    });

    $('.sel_all_disc').click(function(e){
        e.preventDefault();
        if($(this).attr('state') == 'not_checked') {
            $('.disc').attr('checked', 'checked');
            $(this).attr('state', 'checked');
            $(this).html('Снять метку со всех');
        } else {
            $(this).html('Выбрать все');
            $(this).attr('state', 'not_checked');
            $('.disc').removeAttr('checked');
        }
    });

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

} );