$(function(){
    if(!!document.getElementById('info')) {
        update($('.process_id').val());
    }
    
    $('.log_view').click(function(e){
        e.preventDefault();
        var self = $(this);
        $.ajax({
            url: '/mail/getLog',
            type: 'POST',
            data: 'id='+self.attr('data'),
            success: function(data) {
                if(data.success) {
                    $('#logModal > .modal-body > p').html(data.content);
                } else {
                    $('#logModal > .modal-body > p').html(data.error);
                }
                $('#logModal').modal({show:true});
            }
        });
    });
});

function update(id) {
    $.ajax({
        url: '/mail/getInfo',
        type: 'POST',
        data: 'id='+id,
        success: function(data) {
            if(data.id) {
                $('.sendet_'+data.id).html(parseInt(data.sendet));
                $('.clicks_'+data.id).html(parseInt(data.clicks));
                $('.viewed_'+data.id).html(parseInt(data.viewed));
                setTimeout(function(){
                    update($('.process_id').val());
                }, '2000');
            }
        }
    });
}