$.im = {
    id: null,
    last_id: null,
    init: function(id) {
        this.id = id;
        $('#message_id, #receiver_id, #msg-inp').val(null);
        $.notice.show('Внимание', 'Загрузка сообщений', 'status');
        $.ajax({
            url: '/im/init',
            type: 'POST',
            data: 'id='+id,
            success: function(data) {
                if(data.success) {
                    var rate = 0;
                    $('#im-deleted').val(data.data['deleted'].join('|'));
                    for(var i in data.data) {
                        if(i != 'last_id' && i != 'author_id' && i != 'deleted') {
                            for(var k in data.data[i]) {
                                var row = $('<div class="post"><div class="span-1 tac user mr15">'
                                    +'<img src="/img/im/'+data.data[i][k].user.userTypeId+'.png" alt="user">'
                                    +'<div><a href="/user/'+data.data[i][k].user.id+'" target="_blank">'
                                    +data.data[i][k].user.email+'</a></div>'
                                //data.data[i][k].user.userTypeId == '214' && 
                                    +(data.data[i][k].user.userTypeId == '214' && !!document.getElementById('func-client') ? '<div class="fwb">'
                                        +'<a href="#" class="rating" act="m" num="'+data.data[i][k].user.id
                                        +'"><img src="/img/im/left.png" alt="-" /></a> '+data.data[i][k].user.rating+' <a href="#" class="rating" act="p" num="'
                                        +data.data[i][k].user.id+'"><img src="/img/im/right.png" alt="+" /></a></div>'
                                        //+'<div><input class="rating" type="button" value="Ок" act="s" num="'+data.data[i][k].user.id+'" /></div>'+<input class="a-rating" vaule="'+data.data[i][k].user.rating
                                        //+'" size="1" num="'+data.data[i][k].user.id+'" /> 
                                        : '')
                                    +'</div><div class="info"><div class="header"><div class="pull-left mr5 mt5">'
                                    +'<span class="pull-left icon icon-calendar"></span>'
                                    +'<span class="">'+data.data[i][k].created_at+' | <span class="fwb">'
                                    +(data.data[i][k].receiver ? 'адресовано: <a href="/user/'+data.data[i][k].receiver.id+'" target="_blank">'
                                    +data.data[i][k].receiver.contactMan+'</a></span></span>' : '')+'</div>'
                                    +'<div class="controls"><a class="pull-left answer" name="'+data.data[i][k].user.contactMan
                                    +'" created_at="'+data.data[i][k].created_at+'" uid="'+data.data[i][k].user.id
                                    +'">Ответить</a><span class="im-func"></span></div></div><div class="text clear">'
                                    +data.data[i][k].message+'</div></div><div class="msg_files"></div>'
                                    +'<div class="reply" num="'+data.data[i][k].id+'"></div><div class="clear"></div></div>');
                                if(data.data[i][k].files.length) {
                                    for(var c = 0; c < data.data[i][k].files.length; c++) {
                                        var el = $('<span class="file_'+data.data[i][k].files[c].id+' mr20px">'
                                            +(!!document.getElementById('func-client') ? '<input type="button" num="'
                                                +data.data[i][k].files[c].id+'" class="rm_im_file" value="[ X ]" />' : '')
                                            +'<a href="/files/im/'+data.data[i][k].files[c].order_id+'/'+
                                            data.data[i][k].files[c].fileName+'" target="_blank">'+data.data[i][k].files[c].name
                                            +'</a></span>');
                                        row.find('.msg_files').append(el);
                                    }
                                }
                                //data.data[i][k].user.userTypeId == '214' && 
                                if(!!document.getElementById('func-client')) {
                                    if(data.data.author_id == data.data[i][k].user.id) {
                                        rate = (!!parseInt(data.data[i][k].user.rating) ? data.data[i][k].user.rating : 0);
                                        row.find('.im-func').html($('#func-author-active').html());
                                        if(data.data[i][k].messageConfirmed) {
                                            row.find('.im-func').append($('#confirmed').html());
                                        } else {
                                            row.find('.im-func').append($('#not-confirmed').html());
                                            row.find('.confirm').attr('num', data.data[i][k].id);
                                        }
                                        row.find('.a-rating').val(rate);
                                        row.find('.im-rm').attr('num', data.data[i][k].id);
                                        row.find('.a-rating').attr('num', data.data[i][k].user.id);
                                        row.find('.rate-save').attr('num', data.data[i][k].user.id);
                                        row.find('.rating').attr('num', data.data[i][k].user.id);
                                        row.find('.rm-author').attr('num', data.data[i][k].user.id);
                                    } else {
                                        rate = (!!parseInt(data.data[i][k].user.rating) ? data.data[i][k].user.rating : 0);
                                        row.find('.im-func').html($('#func-author-notactive').html());
                                        if(data.data[i][k].messageConfirmed) {
                                            row.find('.im-func').append($('#confirmed').html());
                                        } else {
                                            row.find('.im-func').append($('#not-confirmed').html());
                                            row.find('.confirm').attr('num', data.data[i][k].id);
                                        }
                                        row.find('.a-rating').val(rate);
                                        row.find('.im-rm').attr('num', data.data[i][k].id);
                                        row.find('.a-rating').attr('num', data.data[i][k].user.id);
                                        row.find('.rate-save').attr('num', data.data[i][k].user.id);
                                        row.find('.rating').attr('num', data.data[i][k].user.id);
                                        row.find('.set-author').attr('num', data.data[i][k].user.id);
                                    }
                                } else if(!!document.getElementById('func-client')) {
                                    row.find('.im-func').html($('#func-client').html());
                                    if(data.data[i][k].messageConfirmed) {
                                        row.find('.im-func').append($('#confirmed').html());
                                    } else {
                                        row.find('.im-func').append($('#not-confirmed').html());
                                        row.find('.confirm').attr('num', data.data[i][k].id);
                                    }
                                    row.find('.im-rm').attr('num', data.data[i][k].id);
                                }
                                if(data.data[i][k].message_id != '0') {
                                    row.find('.answer').attr('num', data.data[i][k].message_id);
                                    $('.reply[num="'+data.data[i][k].message_id+'"]').append(row);
                                } else {
                                    row.find('.answer').attr('num', data.data[i][k].id);
                                    $('#dialog').append(row);
                                }
                            }
                        }
                    }
                    $('#last_id').val(data.data.last_id);
                    /*$("#dialog").animate({
                        scrollTop: $('#dialog').offset().top
                    }, 'fast');*/
                    $.notice.destroy();
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
        //this.loader.init();
    },
    reInit: function() {
        $('#dialog').html(null);
        //this.loader.destroy();
        //this.loader.init();
        this.init(this.id);
    },
    send: function(message, receiver_id, id, type_id) {
        message = $.trim(message);
        if(message != ''){
            var order_id = this.id;
            $.ajax({
                url: '/im/send',
                type: 'POST',
                data: 'message='+message+'&id='+id+'&order_id='+order_id+'&receiver_id='+receiver_id+'&type_id='+type_id,
                success: function(data) {
                    if(data.success) {
                        $('#message_id, #receiver_id, #msg-inp').val(null);
                        $('#receiver').html(null);
                        $('.im_file_list').html(null);
                    } else {
                        $.notice.show('Ошибка', data.error, 'error', true);
                    }
                }
            });
        }
    },
    remove: function(id){
        $.notice.show('Информация', 'Выполняется удаление сообщения', 'status', true);
        var parent = this;
        $.ajax({
            url: '/im/remove',
            type: 'POST',
            data: 'id='+id,
            success: function(data) {
                if(data.success) {
                    $.notice.destroy();
                    if(data.childrens) {
                        parent.reInit();
                    } else {
                        $('#row'+id).remove();
                    }
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    },
    confirm: function(id){
        $.notice.show('Информация', 'Выполняется подтверждение сообщения', 'status', true);
        var parent = this;
        $.ajax({
            url: '/im/confirm',
            type: 'POST',
            data: 'id='+id,
            success: function(data) {
                if(data.success) {
                    $.notice.destroy();
                    parent.reInit();
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    },
    rating: function(act, id, value){
        $.notice.show('Информация', 'Выполняется начисление рейтинга', 'status', true);
        $.ajax({
            url: '/im/rate',
            type: 'POST',
            data: 'act='+act+'&id='+id+(act == 's' ? '&value='+value : ''),
            success: function(data) {
                if(data.success) {
                    $.notice.destroy();
                    $('.a-rating[num="'+id+'"]').val(data.rating);
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    },
    author: function(act, id) {
        $.notice.show('Информация', 'Выполняется смена автора', 'status', true);
        var order_id = this.id;
        var parent = this;
        $.ajax({
            url: '/im/author',
            type: 'POST',
            data: 'act='+act+'&id='+id+'&order_id='+order_id,
            success: function(data) {
                if(data.success) {
                    if(act == 'rm') {
                        $('input[name="searchAuthor"].searchAuthor').attr('checked', 'checked');
                        $('.save').click();
                    }
                    $.notice.destroy();
                    parent.reInit();
                    $('.paidAuthorPart').html(0);
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    },
    setFilter: function(type, user){
        type = parseInt(type);
        user = parseInt(user);
        if(type) {
            if(user) {
                $('.im-row').hide();
                $('.im-row-msg').hide();
                $('.im-func').hide();
                $('.im-row-msg[a="'+user+'"][t="'+type+'"]').each(function(){
                    $(this).parent().parent().show();
                    $(this).parent().find('.im-func').show();
                    $(this).show();
                    $(this).parent().show();
                });
            } else {
                $('.im-row').hide();
                $('.im-row[t="'+type+'"]').show();
            }
        } else {
            $('.im-row').show();
        }
    },
    loadUsers: function(type) {
        var id = this.id;
        $.ajax({
            url: '/im/users',
            type: 'POST',
            data: 'type='+type+'&order_id='+id,
            success: function(data) {
                if(data.success) {
                    $('#a_sel').html('<option value="all">Не важно</option>');
                    for(var i = 0; i < data.data.length; i++) {
                        $('#a_sel').append($('<option>', {
                            'value': data.data[i].id,
                            'text': data.data[i].name
                        }));
                    }
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    },
    peer: function(last_id) {
        this.last_id = last_id;
        var order_id = this.id;
        var parent = this;
        $.ajax({
            url: '/im/peer',
            type: 'POST',
            data: 'last_id='+last_id+'&order_id='+order_id,
            success: function(data) {
                if(data.success) {
                    var slide = 0;
                    var rate = 0;
                    for(var i in data.data) {
                        if(i != 'last_id' && i != 'author_id' && i != 'deleted') {
                            slide = 1;
                            for(var k in data.data[i]) {
                                var row = $('<div class="post"><div class="span-1 tac user mr15">'
                                    +'<img src="http://zdravo.by/content/images/UserDefaultImage.png" alt="user">'
                                    +'<div><a href="/user/'+data.data[i][k].user.id+'">'
                                    +data.data[i][k].user.contactMan+'</a></div>'
                                    +(data.data[i][k].user.userTypeId == '214' && !!document.getElementById('func-client') ? '<div class="fwb">'
                                        +'<a href="#" class="rating" act="m" num="'+data.data[i][k].user.id
                                        +'">-</a> <input class="a-rating" vaule="'+data.data[i][k].user.rating
                                        +'" size="1" num="'+data.data[i][k].user.id+'" /> <a href="#" class="rating" act="p" num="'
                                        +data.data[i][k].user.id+'">+</a></div>'
                                        +'<div><input class="rating" type="button" value="Ок" act="s" num="'+data.data[i][k].user.id+'" /></div>' : '')
                                    +'</div><div class="info"><div class="header"><div class="pull-left mr5 mt5">'
                                    +'<span class="pull-left icon icon-calendar"></span>'
                                    +'<span class="">'+data.data[i][k].created_at+' | <span class="fwb">'
                                    +(data.data[i][k].receiver ? 'адресовано: '+data.data[i][k].receiver.contactMan+
                                        '</span></span>' : '')+'</div>'
                                    +'<div class="controls im-func"><a class="pull-left answer" name="'+data.data[i][k].user.contactMan
                                    +'" created_at="'+data.data[i][k].created_at+'" uid="'+data.data[i][k].user.id
                                    +'">Ответить</a><span class="im-func"></span></div></div><div class="text clear">'
                                    +data.data[i][k].message+'</div></div><div class="msg_files"></div>'
                                    +'<div class="reply" num="'+data.data[i][k].id+'"></div><div class="clear"></div></div>');
                                if(data.data[i][k].files.length) {
                                    for(var c = 0; c < data.data[i][k].files.length; c++) {
                                        var el = $('<span class="file_'+data.data[i][k].files[c].id+' mr20px">'
                                            +(!!document.getElementById('func-client') ? '<input type="button" num="'
                                                +data.data[i][k].files[c].id+'" class="rm_im_file" value="[ X ]" />' : '')
                                            +'<a href="/files/im/'+data.data[i][k].files[c].order_id+'/'+
                                            data.data[i][k].files[c].fileName+'" target="_blank">'+data.data[i][k].files[c].name
                                            +'</a></span>');
                                        row.find('.msg_files').append(el);
                                    }
                                }
                                if(data.data[i][k].user.userTypeId == '214' && !!document.getElementById('func-client')) {
                                    if(data.data.author_id == data.data[i][k].user.id) {
                                        rate = (!!parseInt(data.data[i][k].user.rating) ? data.data[i][k].user.rating : 0);
                                        row.find('.im-func').html($('#func-author-active').html());
                                        if(data.data[i][k].messageConfirmed) {
                                            row.find('.im-func').append($('#confirmed').html());
                                        } else {
                                            row.find('.im-func').append($('#not-confirmed').html());
                                            row.find('.confirm').attr('num', data.data[i][k].id);
                                        }
                                        row.find('.a-rating').val(rate);
                                        row.find('.im-rm').attr('num', data.data[i][k].id);
                                        row.find('.a-rating').attr('num', data.data[i][k].user.id);
                                        row.find('.rate-save').attr('num', data.data[i][k].user.id);
                                        row.find('.rating').attr('num', data.data[i][k].user.id);
                                        row.find('.rm-author').attr('num', data.data[i][k].user.id);
                                    } else {
                                        rate = (!!parseInt(data.data[i][k].user.rating) ? data.data[i][k].user.rating : 0);
                                        row.find('.im-func').html($('#func-author-notactive').html());
                                        if(data.data[i][k].messageConfirmed) {
                                            row.find('.im-func').append($('#confirmed').html());
                                        } else {
                                            row.find('.im-func').append($('#not-confirmed').html());
                                            row.find('.confirm').attr('num', data.data[i][k].id);
                                        }
                                        row.find('.a-rating').val(rate);
                                        row.find('.im-rm').attr('num', data.data[i][k].id);
                                        row.find('.a-rating').attr('num', data.data[i][k].user.id);
                                        row.find('.rate-save').attr('num', data.data[i][k].user.id);
                                        row.find('.rating').attr('num', data.data[i][k].user.id);
                                        row.find('.set-author').attr('num', data.data[i][k].user.id);
                                    }
                                } else if(!!document.getElementById('func-client')) {
                                    row.find('.im-func').html($('#func-client').html());
                                    if(data.data[i][k].messageConfirmed) {
                                        row.find('.im-func').append($('#confirmed').html());
                                    } else {
                                        row.find('.im-func').append($('#not-confirmed').html());
                                        row.find('.confirm').attr('num', data.data[i][k].id);
                                    }
                                    row.find('.im-rm').attr('num', data.data[i][k].id);
                                }
                                if(data.data[i][k].message_id != '0') {
                                    row.find('.answer').attr('num', data.data[i][k].message_id);
                                    $('.reply[num="'+data.data[i][k].message_id+'"]').append(row);
                                } else {
                                    row.find('.answer').attr('num', data.data[i][k].id);
                                    $('#dialog').append(row);
                                }
                                $('#post_dialog').focus();
                            }
                        }
                    }
                    if(data.data['deleted'].join('|') != $('#im-deleted').val()) {
                        parent.reInit();
                    }
                    $('#last_id').val(data.data.last_id);
                    if(slide) {
                        /*$("#dialog").animate({
                            scrollTop: $('#dialog').offset().top
                        }, 'fast');*/
                    }
                    setTimeout(function(){
                        parent.peer(data.data.last_id);
                    }, '5000');
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                    setTimeout(function(){
                        parent.peer(last_id);
                    }, '5000');
                }
            }
        });
    }
};