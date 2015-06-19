$(function(){
    $('.cont-switch').click(function(e){
        e.preventDefault();
        $('.cont').slideToggle();
    });
    $('.save').click(function(e){
        e.preventDefault();
        $.notice.show('Внимание', 'Выполняется сохранение данных', 'status');
        $.ajax({
            url: '/order/save',
            type: 'POST',
            data: 'noteCashier='+$('.noteCashier').val()+'&noteAuthor='+$('.noteAuthor').val()+'&noteManager='+$('.noteManager').val()
            +'&priceClient='+$('.priceClient').val()+'&priceAuthor='+$('.priceAuthor').val()
            +'&performanceTerm='+$('.performanceTerm').val()+'&termAuthor='+$('.termAuthor').val()
            +'&protectionDate='+$('.protectionDate').val()+'&managerAlertTime[time]='+$('input[name^=managerAlertTime\\[time\\]]').val()+'&managerAlertTime[date]='+$('input[name^=managerAlertTime\\[date\\]]').val()
            +'&authorAlertTime[time]='+$('input[name^=authorAlertTime\\[time\\]]').val()+ '&authorAlertTime[date]='+$('input[name^=authorAlertTime]').val()+'&clientNoPhone='+($('.clientNoPhone').is(':checked') ? 1 : 0)
            +'&exposeFreelance='+($('.exposeFreelance').is(':checked') ? 1 : 0)+'&searchAuthor='+($('.searchAuthor').is(':checked') ? 1 : 0)
            +'&startWork='+($('.startWork').is(':checked') ? 1 : 0)+'&complete='+($('.complete').is(':checked') ? 1 : 0)
            +'&finishWork='+($('.finishWork').is(':checked') ? 1 : 0)+'&subjectMatter='+$('.subjectMatter').val()
            +'&workType='+$('.workType').val()+'&workTheme='+$('.workTheme').val()+'&toAuthorPaid='+$('.toAuthorPaid').val()
            +'&workContent='+$('.workContent').val()+'&educationalInstitution='+$('.educationalInstitution').val()
            +'&convenientTime='+$('.convenientTime').val()+'&recognizedUs='+$('.recognizedUs').val()
            +'&noteDemand='+$('.noteDemand').val()+'&id='+$('#item_id').val()+'&payed='+($('.payed').is(':checked') ? 1 : 0)
            +'&rawOrder='+($('.rawOrder').is(':checked') ? 1 : 0),
            success: function(data) {
                $.notice.destroy();
                changelog.load();
                if(!data.success) {
                    $.notice.show('Внимание', data.error, 'error', true);
                }
            }
        });
    });
    
    $('.set-mgr').click(function(){
        $.notice.show('Внимание', 'Выполняется сохранение данных', 'status');
        $.ajax({
            url: '/order/setMgr',
            type: 'POST',
            data: 'order_id='+$('#item_id').val(),
            success: function(data) {
                if(data.success) {
                    $.notice.destroy();
                    $('.set-mgr').remove();
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    });
    
    $('.mailer_send').click(function(){
        $.ajax({
            url: '/mail/orderSend',
            type: 'POST',
            data: 'id='+$('#item_id').val()+'&disc='+($('.mailer_disc').attr('checked') ? 1 : 0),
            success: function(data) {
                if(data.success) {
                    $.notice.show('Внимание!', 'Рассылка добавлена. Запуск рассылки в течении 2 минут', 'status', true);
                } else {
                    $.notice.show('Возникала ошибка!', data.error, 'error', true);
                }
            }
        });
    });

    $( '.getLogs' ).on( 'click' , function() {
        var self = this;
        $( self ).find( '.logs' ).toggleClass( 'hidden' );
        $.ajax( {
            url         : '/order/getLog'
            , 
            type      : 'POST'
            , 
            data      : {
                fieldName : $( self ).data( 'fieldName' ) , 
                orderId : $('#item_id').val()
            }
            , 
            success   : function( response )  {
                if( response.length == 0 )  {
                    return;
                }
                $( self ).find( '.logs' ).html('');
                $.each( response , function( i , val ) {
                    var container = $( '<div>' );
                    container.append( $( '<span>' , {
                        class : 'email' , 
                        text : val.changer
                    } ) );
                    container.append( $( '<span>' , {
                        class : 'date' , 
                        text : val.changed_at
                    } ) );
                    container.append( $( '<span>' , {
                        class : 'value' , 
                        text : ( val.fieldValue && val.fieldValue.length > 30 ) ? val.fieldValue.substr( 0 , 30 ) + ' ...' : val.fieldValue
                    } ) );
                    $( self ).find( '.logs' ).append( container );
                } );
            }
        } );
    } );

    $( '.getTip' ).on( 'click' , function() {
        var self = this;
        $( self ).find( '.tip' ).toggleClass( 'hidden' );
    } );
});

var changelog = {
    load : function () {
        var $log_triggers = $('[data-get-log]')
        data = {
            orderId : $('#item_id').val()
        };

        if ($log_triggers.size() > 0)
        {
            $log_triggers.each(function(){
                data[$(this).data('get-log')] = $(this).data('log-limit') || 0;
            });

            $('.changelog-box').remove();

            $.post('/order/getChangeLog', data, function(response){
                $.each(response, function(key, val){
                    var logHtml = '', logName = key;

                    $.each(val, function(key, log){
                        if (log.changer !== undefined && log.changed_at !== undefined && $('#log'+log.fieldName).size() == 0)
                        {
                            logHtml += '<li>' + (logHtml == '' ? '* ' : '') + '<b>' + log.changer + '</b> ' + log.changer_email + ' <em>(' + log.changed_at + ')</em></li>';
                        }
                    });

                    if (logHtml == '')
                        logHtml = '<li class="empty">Пока нет истории...</li>';

                    if (logName != '')
                        $('[data-get-log^='+logName+']').append('<div class="changelog-box" id="changelog' + logName + '"><h4>Последние изменения:</h4><ul>' + logHtml + '</ul></div>');
                });

            }, 'json');
        }
    }
};

$(document).ready(function(){
    changelog.load();
});