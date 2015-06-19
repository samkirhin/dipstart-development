$(function(){
    $('.pay').click(function(e){
        e.preventDefault();
        var id = $(this).attr('data');
        var sum = $('.sum[data="'+id+'"]').val();
        $.notice.show('Внимание', 'Выполняется начисление средств', 'status', false);
        $.ajax({
            url: '/cashier/pay',
            type: 'POST',
            data: 'id='+id+'&sum='+sum,
            success: function(data) {
                if(data.success) {
                    $.notice.show('Внимание', 'Пользователю начислены средства', 'status', true);
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    });
});