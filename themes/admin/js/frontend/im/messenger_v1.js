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
                    $('#im-deleted').val(data.data['deleted'].join('|'));
                    for(var i in data.data) {
                        if(i != 'last_id' && i != 'author_id' && i != 'user_id' && i != 'deleted') {
                            for(var k in data.data[i]) {
                                data.data[i][k]['author_id'] = data.data.author_id;
                                data.data[i][k]['user_id'] = data.data.user_id;
                                var el = $.im.prepareMsg(data.data[i][k]);
                                $('#dialog').append(el);
                            }
                        }
                        
                    }
                    $('#last_id').val(data.data.last_id);
                    $("#dialog").animate({
                        scrollTop: $('#dialog').offset().top
                    }, 'fast');
                    $.notice.destroy();
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    //this.loader.init();
    },
    prepareMsg : function(data){
        if(data.deleted_at) {
            return null;
        }
        var el = $('<div>', {
            'class': 'post'
        });
        el.html($('.post.hidden').html());
        if(data.user.userTypeId == '214') {
            el.find('.rating-size').html(data.user.rating);
        } else {
            el.find('.rating-block').html(null);
        }
        if(data.user.userTypeId == '214' && data.user.id == data.author_id) {
            el.find('.avatar img').attr('src', '/img/im/214a.png');
            if(!!document.getElementById('mgr')) {
                el.find('.avatar img').addClass('rm-author');
                el.find('.avatar img').addClass('c-p');
            }
            el.find('.im-sender').addClass('red');
        } else if(data.user.userTypeId == '215' || data.user.userTypeId == '218') {
            el.find('.im-sender').addClass('red');
            el.find('.avatar img').attr('src', '/img/im/'+data.user.userTypeId+'.png');
        } else if(data.user.userTypeId == '214') {
            el.find('.avatar img').attr('src', '/img/im/'+data.user.userTypeId+'.png');
            if(!!document.getElementById('mgr')) {
                el.find('.avatar img').addClass('set-author');
                el.find('.avatar img').addClass('c-p');
                el.find('.avatar img').attr('src', '/img/im/'+data.user.userTypeId+'.png');
            }
        } else {
            el.find('.avatar img').attr('src', '/img/im/'+data.user.userTypeId+'.png');
        }
        if(data.messageConfirmed) {
            el.find('.im-apply').remove();
        }
        if(!!document.getElementById('mgr')) {
            el.find('.im-sender').html(data.user.email);
        } else {
            if(data.user.userTypeId == '213' &&  data.user.id == data.user_id) {
                el.find('.im-sender').html($('.im-user-you').html());
            } else if(data.user.userTypeId == '213') {
                el.find('.im-sender').html($('.im-user-client').html());
            } else if(data.user.userTypeId == '214' && data.user.id == data.user_id) {
                el.find('.im-sender').html($('.im-user-you').html());
            } else if(data.user.userTypeId == '214') {
                el.find('.im-sender').html($('.im-user-author').html());
            } else if(data.user.userTypeId == '215') {
                el.find('.im-sender').html($('.im-user-manager').html());
            }
        }
        el.find('.im-date').html(data.created_at);
        el.find('.post-msg').html(data.message);
        el.find('[data-id=""]').attr('data-id', data.id);
        el.find('[data-user-id=""]').attr('data-user-id', data.user.id);
        el.attr('data-id', data.id);
        return el;
    },
    reInit: function() {
        $('#dialog').html(null);
        //this.loader.destroy();
        //this.loader.init();
        this.init(this.id);
    },
    send: function(message, type_id) {
        message = $.trim(message);
        if(message != ''){
            var order_id = this.id;
            var forward_to = $('.forward-to').val();
            var receiver_id = $('#receiver_id').val();
            if(receiver_id && receiver_id != '0') {
                type_id = 0;
            }
            $.ajax({
                url: '/im/send',
                type: 'POST',
                data: 'message='+message+'&id=0&order_id='+order_id+'&receiver_id='+receiver_id+'&type_id='+type_id+'&forward-to='+forward_to,
                success: function(data) {
                    if(data.success) {
                        $('#message_id, #receiver_id, .im-msg-inp').val(null);
                        $('#receiver').html(null);
                        $('.im_file_list').html(null);
                        $('.forward_to').val(null);
                    } else {
                        $.notice.show('Ошибка', data.error, 'error', true);
                    }
                }
            });
        }
    },
    smsSend: function() {
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
                        $('.post[data-id="'+id+'"]').remove();
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
                    $('.rating-size[data-user-id="'+id+'"]').html(data.rating);
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
                        $('.post .avatar img[src="/img/im/214a.png"]').attr('src', '/img/im/214.png');
                        $('.post .avatar a').addClass('.set-author');
                    } else {
                        $('.post .avatar img[src="/img/im/214a.png"]').attr('src', '/img/im/214.png');
                        $('.post .avatar a[data-user-id="'+id+'"]').addClass('.rm-author');
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
                        if(i != 'last_id' && i != 'author_id' && i != 'user_id' && i != 'deleted') {
                            slide = 1;
                            for(var k in data.data[i]) {
                                data.data[i][k]['author_id'] = data.data.author_id;
                                data.data[i][k]['user_id'] = data.data.user_id;
                                var el = $.im.prepareMsg(data.data[i][k]);
                                $('#dialog').append(el);
                            }
                        }
                    }
                    if(data.data['deleted'].join('|') != $('#im-deleted').val()) {
                        parent.reInit();
                    }
                    $('#last_id').val(data.data.last_id);
                    if(slide) {
                        $("#dialog").animate({
                            scrollTop: $('#dialog').offset().top
                        }, 'fast');
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