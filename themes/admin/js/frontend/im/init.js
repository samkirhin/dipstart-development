$(function(){
    $('#show-msg').click(function(){
        $.im.setFilter($('#type_sel').val(), $('#a_sel').val());
    });
    $('.im-send').click(function(){
        $.im.send($('.im-msg-inp').val(), $(this).data('type'));
    });
    $('#type_sel').change(function(){
        console.log(1)
        $.im.loadUsers($(this).val());
    });
    
    $('body').on('click', '.im-forward', function(){
        $('.im-msg-inp').val($('.post-msg[data-id="'+$(this).data('id')+'"]').html());
        $('.forward-to').val($(this).data('userId'));
    });
    
    $('body').on('click', '.im-rm', function(){
        $.im.remove($(this).data('id'));
    });
    $('body').on('click', '.rating', function(e){
        e.preventDefault();
        if($(this).attr('act') == 's') {
            $.im.rating($(this).data('act'), $(this).data('user-id'), $(this).parent().parent().find('.rating-size').html());
        } else {
            $.im.rating($(this).data('act'), $(this).data('user-id'));
        }
    });
    $('body').on('click', '.set-author', function(e){
        e.preventDefault();
        $.im.author('set', $(this).data('user-id'));
    });
    $('body').on('click', '.rm-author', function(e){
        e.preventDefault();
        $.im.author('rm', $(this).data('user-id'));
    });
    /*$('.im-file').click(function(){
        $('#upload-im-file-container').find('input').click();
    });*/
    /*$('.rm_im_file').on('click', function(){
        $.im.loader.remove($(this).attr('num'));
    });*/
    $('body').on('click', '.im-apply', function(e){
        e.preventDefault();
        $.im.confirm($(this).data('id'));
    });
    $.im.init($('#item_id').val());
    $('body').on('click', '.reply', function(){
        //$('#receiver').html(null);
        $('#message_id').val(null);
        $('#receiver_id').val(null);
        //var message_id = $(this).attr('num');
        //var receiver = $(this).attr('name');
        var receiver_id = $(this).data('user-id');
        //var created_at = $(this).attr('created_at');
        /*$('#receiver').html('<div class="f-l">Ответ на сообщение: '+receiver+' ('+created_at+')</div><div class="f-r">'
            +'<div class="rm" id="rm-answer">x</div></div><div class="clear"></div>');
        $('#message_id').val(message_id);*/
        $('#receiver_id').val(receiver_id);
        $('.im-msg-inp').focus();
    });
    $('body').on('click', '#rm-answer', function(){
        $('#receiver').html(null);
        $('#message_id').val(null);
        $('#receiver_id').val(null);
    });
    setTimeout(function(){
        $.im.peer($('#last_id').val());
    }, '5000');
});