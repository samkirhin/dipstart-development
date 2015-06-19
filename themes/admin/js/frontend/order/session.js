$(function(){
    session($('#item_id').val());
    setTimeout(function(){
        $.notice.destroy();
    }, '3000');
});

function session(id) {
    $.ajax({
        url: '/order/session?_id='+id,
        success: function(data) {
            if(data.success) {
                setTimeout(function(){
                    session(id);
                }, '3000');
            } else {
                alert(data.error);
                setTimeout(function(){
                    session(id);
                }, '3000');
            }
        }
    });
}