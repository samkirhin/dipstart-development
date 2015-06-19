$(function(){
    $.balance.history(1, '', '');
    $('.get-more-results').click(function(){
        $.balance.history($(this).attr('data-page'), $('.from').val(), $('.to').val());
    });
    if($('.from, .to').length) {
        $('.from, .to').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    }
    $('.apply-filter').click(function(){
        $.balance.history(1, $('.from').val(), $('.to').val());
    });
    $('.reset-filter').click(function(){
        $('.from, .to').val(null);
        $('.apply-filter').click();
    });
    $('input.pay[type="checkbox"]').change(function(){
        if($(this).is(':checked')) {
            $('.row.pay').removeClass('hidden');
        } else {
            $('.row.pay').addClass('hidden');
        }
    });
    $('input.receipt[type="checkbox"]').change(function(){
        if($(this).is(':checked')) {
            $('.row.receipt').removeClass('hidden');
        } else {
            $('.row.receipt').addClass('hidden');
        }
    });
});

$.balance = {
    history: function(page, from, to) {
        $.notice.show('Внимание', 'Выполняется загрузка истории', 'status', true);
        $.ajax({
            url: '/balance/getHistory',
            type: 'POST',
            data: 'page='+page+'&from='+from+'&to='+to,
            success: function(data) {
                if(!data.success) {
                    $.notice.show('Ошибка', data.error, 'error', true);
                } else {
                    if(page == '1') {
                        $('.search-results tbody').html(null);
                    }
                    if(data.total == '0') {
                        $('.search-results tbody').html(data.message);
                    }
                    var tpl;
                    for(var i = 0; i < data.data.length; i++) {
                        var el = $('<tr>', {
                            'class': 'row',
                            'data-href': ''
                        });
                        if(data.data[i].changeType == '1') {
                            el.html($('.example.pay').html());
                        } else if(data.data[i].changeType == '2') {
                            el.html($('.example.withdrawal').html());
                        } else if(data.data[i].changeType == '3') {
                            el.html($('.example.percent').html());
                        } else if(data.data[i].changeType == '4') {
                            el.html($('.example.receipt2').html());
                        } else {
                            el.html($('.example.receipt').html());
                        }
                        tpl = $.balance.parse(el, data.data[i]);
                        $('.search-results tbody').append(tpl);
                    }
                    $('.get-more-results').attr('data-page', parseInt($('.get-more-results').attr('data-page'))+1);
                    if(parseInt(data.total) <= parseInt($('.row').length) || data.total == '0') {
                        $('.get-more-results').not('.hidden').addClass('hidden');
                    } else {
                        $('.get-more-results').removeClass('hidden');
                    }
                    $.notice.destroy();
                }
            }
        });
    },
    parse: function(tpl, data){
        var fields = ['receivedat', 'sum', 'workTheme', 'percent'];
        if(data.changeType == '1' || data.changeType == '2') {
            tpl.addClass('pay');
            if($('input.pay[type="checkbox"]').is('checked')) {
                tpl.addClass('hidden');
            }
        } else {
            tpl.addClass('receipt');
            if(!$('input.receipt[type="checkbox"]').is(':checked')) {
                tpl.addClass('hidden');
            }
        }
        if(data.approvedAt) {
            tpl.html(tpl.html().replace('%status%', 'Подтвержден '+data.approvedAt));
        } else if(data.disapprovedAt) {
            tpl.html(tpl.html().replace('%status%', 'Отклонен '+data.disapprovedAt));
        } else {
            tpl.html(tpl.html().replace('%status%', 'Ожидает подтверждения'));
        }
        for(var i = 0; i < fields.length; i++) {
            tpl.html(tpl.html().replace('%'+fields[i]+'%', data[fields[i]]));
        }
        return tpl;
    }
}