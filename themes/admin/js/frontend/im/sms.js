$(function(){
    $('.im-sms-send').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '/sms/send',
            type: 'POST',
            data: 'order_id='+$('#item_id').val()+'&reciever='+$('#im_type_id').val()+'&msg='+$('#msg-inp').val(),
            success: function(data) {
                if(data.success) {
                    $('#msg-inp').val(null);
                    $.notice.show('Успешно', 'Смс успешно отправлено', 'status', true);
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    });
});