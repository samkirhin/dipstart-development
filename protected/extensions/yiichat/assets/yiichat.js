$(document).ready(function () {
    $('#Zakaz_status').click(function () {
        $.ajax({
            url: 'index.php?r=project/zakaz/apiFindAuthor',
            type: 'post',
            data: {
                value: $('#Zakaz_status').prop('checked').toString(),
                id: $(this).data('id')
            },
            success: function (data) {
                if (data['data']) alert('Не удалось');
            }
        });
    });
});
var YiiChat = function (options) {
    this.run = function () {

        var clear = function () {
            send.attr('disabled', null);
            msg.attr('disabled', null);
        };

        var busy = function () {
            send.attr('disabled', 'disabled');
            msg.attr('disabled', 'disabled');
        };

        var actionPost = function (text, callback, data) {
            busy();
            jQuery.ajax({
                cache: false, type: 'post', dataType: 'json',
                url: options.action + '&action=sendpost&data=not_used',
                data: {chat_id: options.chat_id, identity: options.identity, text: text, post: data},
                success: function (post) {
                    if (post == null || post == "") {
                        options.onError('post_empty', '');
                    } else if (post == 'REJECTED') {
                        options.onError('post_rejected', text);
                        callback(false);
                    } else {
                        actionTimer();
                        callback(true);
                        options.onSuccess('post', text, post);
                    }
                    $('#send_buttons').children().each(function(){$(this).show()});
                    clear();
                },
                error: function (e) {
                    clear();
                    options.onError('send_post_error', e.responseText, e);
                    callback(false);
                }
            });
        };

        var actionInit = function (callback) {
            busy();
            jQuery.ajax({
                cache: false, type: 'post', dataType: 'json',
                url: options.action + '&action=init&data=not_used',
                data: {chat_id: options.chat_id, identity: options.identity},
                success: function (_posts) {
                    if (_posts == null || _posts == "") {
                        options.onError('init_empty', '');
                    } else if (posts == 'REJECTED') {
                        options.onError('init_rejected', text);
                    } else {
                        // _posts.chat_id, _posts.identity, _posts.posts
                        jQuery.each(_posts.posts, function (k, post) {
                            add(post, 0);
                        });
                        options.onSuccess('init', '');
                        callback();
                    }
                    clear();
                },
                error: function (e) {
                    clear();
                    options.onError('init_error', e.responseText, e);
                }
            });
        };

        var actionTimer = function () {
            var last_id = '';
            //var lastPost = posts.find('.post:not(.yiichat-post-myown):last');
            var lastPost = posts.find('.post:last');
            var data = lastPost.data('post'); //data setted in add method
            if (data != null)
                last_id = data.id;
            //log.html('last_id='+last_id);
            jQuery.ajax({
                cache: false, type: 'post',
                url: options.action + '&action=timer&data=not_used',
                data: {
                    chat_id: options.chat_id, identity: options.identity,
                    last_id: last_id
                },
                success: function (_posts) {
                    if (_posts == null || _posts == "") {
                        options.onError('timer_empty', '');
                    } else if (posts == 'REJECTED') {
                        options.onError('timer_rejected', text);
                    } else {
                        // _posts.chat_id, _posts.identity, _posts.posts
                        var hasPosts = false;
                        jQuery.each(_posts.posts, function (k, post) {
                            add(post, 0);
                            hasPosts = true;
                        });
                        options.onSuccess('timer', '');
                        if (hasPosts == true)
                            scroll();
                    }
                },
                error: function (e) {
                    options.onError('timer_error', e.responseText, e);
                }
            });
        };

        // fields:
        //	id: postid, owner: 'i am', time: 'the time stamp', text: 'the post'
        //  chat_id: the_chat_id, identity: whoami_id
        var add = function (post, postn) {
            var p=0;
            if (postn == 0) {
				var tmp_html = '';

				if (post.sender.superuser.itemname == 'Author') {
					if (options.executor == post.sender.superuser.userid)
						tmp_html = "toggleexecutor executor-unset";
					else
						tmp_html = "toggleexecutor executor-set";
				}else if (post.sender.superuser.itemname == 'Customer') {
					tmp_html = "chtpl0-user-icon-4 usual-cursor";
				}else{
					tmp_html = "chtpl0-user-icon-3 usual-cursor";
				}

                posts.append("<div id='post_" + post.id + "' class='post chtpl0-msg'>"
				+ "<button data-index=\"" + post.id + "\" class='" + tmp_html + "'></button>"
                + "<div class='chtpl0-content'></div>"
				+ "<div class='chtpl0-buttons'></div>"
                + "</div>");
                p = posts.find(".post[id='post_" + post.id + "']");

                p.data('post', post);
                var flag = false;
                if (options.identity == post.sender.id) {
                    p.addClass('yiichat-post-myown');
                    flag = true;
                }
                if (flag == true) {
                    if (options.myOwnPostCssStyle != null) {
                        p.removeClass('yiichat-post-myown');
                        p.addClass(options.myOwnPostCssStyle);
                    }
                } else {
                    if (options.othersPostCssStyle != null)
                        p.addClass(options.othersPostCssStyle);
                }

                tmp_html = "<div class='owner chtpl0-nickname' data-ownerid='" + post.sender.superuser.userid + "'><a data-toggle='tooltip' title='" + post.sender.fullusername + "' class='ownerref' href='/user/user/view?id=" + post.sender.superuser.userid + "'>" + post.sender.username + "</a>";
                if (post.recipient != 0) tmp_html += " ответил "
                + "<a data-toggle='tooltip' title='" + post.recipient.fullusername + "' class='ownerref' href='/user/user/view?id=" + post.recipient.superuser.userid + "'>" + post.recipient.username + "</a>";
                tmp_html += "  |</div>";
				tmp_html += "<div class='chtpl0-date'>" + post.date + "</div>";
				//tmp_html += "<div class='chtpl0-time'>" + post.date + "</div>"
                if (post.cost > 0) tmp_html += "<div class='cost'>Цена:" + post.cost + "</div>";
                //tmp_html += "</div>";
				tmp_html += "<div class='text'></div>";
                p.find('.chtpl0-content').html(tmp_html);
				
				tmp_html = '';//"<div class='buttons'>"
				if (options.identity != post.sender.superuser.userid) {
					tmp_html += "<button data-index=\"" + post.id + "\" class=\"chtpl0-answer\">Ответить</button>";
					tmp_html += "<button data-index=\"" + post.id + "\" class=\"chtpl0-share\">Переслать</button>";
				}
				tmp_html += "<button data-index=\"" + post.id + "\" class=\"chtpl0-delete\">Удалить</button>";
				if (options.identity != post.sender.superuser.userid) {
                    if (post.moderated == 0 && (post.sender.superuser.itemname == 'Author' || post.sender.superuser.itemname == 'Customer'))
                        if (post.recipient != 0 && (post.recipient.superuser.itemname == 'Author' || post.recipient.superuser.itemname == 'Customer'))
							tmp_html += "<button data-index=\"" + post.id + "\"class=\"chtpl0-accept\">Одобрить</button>";
                    
                }
                
				p.find('.chtpl0-buttons').html(tmp_html);

                var btn_edit = p.find('button.chtpl0-share');
                btn_edit.click(function () {
                    actionPost($(this).closest('.post').find('.text').text(), function (ok) {
                        if (ok == true) {
                            scroll();
                            setTimeout(function () {
                                msg.focus();
                            }, 100);
                        }
                    }, {index: this.dataset.index, recipient: 'redir'});                });
                var btn_answer = p.find('button.chtpl0-answer');
                btn_answer.click(function () {
					var recepient = $(this).closest('.post').find('.owner').find('.ownerref:first').text();
					if (recepient != 'Админ' && recepient != 'Менеджер'){
						msg.data('index', this.dataset.index);
						var answer=$('.msg_answer');
						if (answer.length == 0) $(msg).parent().before('<div class="col-xs-12 msg_answer">Ответить ' + $(this).closest('.post').find('.owner').find('.ownerref:first').text() + 'у</div>');
						else $('.msg_answer').text('Ответить ' + $(this).closest('.post').find('.owner').find('.ownerref:first').text()+'у');
						$('#send_buttons').children().each(function(){$(this).hide()});
						answer=$('.msg_answer');
						if (answer.text()=='Ответить Автору') $('.button_author').show();
						if (answer.text()=='Ответить Заказчику') $('.button_customer').show();
						//if (answer.text()=='Ответить Админу') $('.button_send').show();
						//if (answer.text()=='Ответить Менеджеру') $('.button_send').show();
					}
                });
                var btn_remove = p.find('button.chtpl0-delete');
                btn_remove.click(function () {
                    setdata = this.dataset;
                    jQuery.ajax({
                        cache: false, type: 'post',
                        url: options.action + '&action=dpost&data=not_used',
                        data: {chat_id: options.chat_id, id: setdata.index},
                        success: function (data) {
                            clear();
                            $('#post_' + setdata.index).remove();
                        },
                        error: function (e) {
                            clear();
                            options.onError('init_error', e.responseText, e);
                        }
                    });
                });
                var btn_ok = p.find('button.chtpl0-accept');
                btn_ok.click(function () {
                    setdata = this.dataset;
                    jQuery.ajax({
                        cache: false, type: 'post',
                        url: options.action + '&action=dapprove&data=not_used',
                        data: {chat_id: options.chat_id, id: setdata.index},
                        success: function (data) {
                            clear();
                            $('.post').each(function () {
								var this_btn = $(this).find('button.chtpl0-accept');
                                if (this_btn.data('index') == setdata.index)
                                    this_btn.remove();
                            });
                        },
                        error: function (e) {
                            clear();
                            options.onError('init_error', e.responseText, e);
                        }
                    });
                });
                var btn_toggleexecutor = p.find('button.toggleexecutor');
                btn_toggleexecutor.click(function () {
                    setdata = this.dataset;
                    tmp_post = $('#post_' + setdata.index);
                    oldaction = tmp_post.find('button.toggleexecutor').attr('class').split(' ')[1];
                    owner = tmp_post.find('.chtpl0-content').find('.owner').data('ownerid');
                    if (oldaction == 'executor-unset') action = 'set'; else action = 'unset';
                    jQuery.ajax({
                        cache: false, type: 'post',
                        url: options.action + '&action=dtoggle&data=' + action,
                        data: {chat_id: options.chat_id, id: setdata.index, ex: owner},
                        success: function (data) {
							var cost = '';
                            $('.post').each(function () {
                                if ($(this).find('.owner').data('ownerid') == owner) {
                                    $(this).find('button.toggleexecutor').removeClass(oldaction).addClass('executor-' + action);
									if ($(this).find('.cost')) cost = Number($(this).find('.cost').text().match(/\d+/));
								}
                            });
                            if (oldaction == 'executor-unset'){
								//$('.findauthor').removeClass('hide');
								$('.work_price_input').val(0);
							} else {
								//$('.findauthor').removeClass('hide');
								//cost = 
								cost = prompt("Введите стоимость для автора", cost);
								$('.work_price_input').val(cost);
							}
                            clear();
                        },
                        error: function (e) {
                            clear();
                            options.onError('init_error', e.responseText, e);
                        }
                    });
                });
            } else
                p = posts.find(".post[id='post_" + postn + "']");
            p.find('.text').html(post.message);
        };

        var scroll = function () {
            //window.location = '#'+posts.find('.post:last').attr('id');
            var h = 0;
            posts.find('.post').each(function (k) {
                h += $(this).outerHeight();
            });
            posts.scrollTop(h);
        };

        ctrl=false;
        var chat = jQuery(options.selector);
        chat.addClass('yiichat mt5 posts');
        //chat.html('<div class="posts">posts</div><div class="you">you</div><div class="col-xs-12 log">Нажать ctrl+enter для ' + 'отправки сообщения всем</div>');
        //var posts = chat.find('div.posts');
		var posts = chat;
        //var you = chat.find('div.you');
		var you = jQuery(".chtpl0-form");
        //var log = chat.find('div.log');
		var log = jQuery(".chtpl0-show");

        you.html('<textarea class="pull-left im-msg-inp"></textarea><div class="exceded"></div>');
        you.append('<div id="send_buttons" class="buttons pull-right chtpl0-subm"></div>');
        var buttons = you.find('div.buttons');
		buttons.append("<h5>Отправить сообщение</h5><br>");
        //buttons.append("<button class='button_send btn-primary pull-left btn smooth im-send' data-recipient='no'>" + options.sendButtonText + "</button>");
        buttons.append("<button class='chtpl0-submit1 button_author btn-primary pull-left btn smooth im-send' data-recipient='Author'>" + options.sendAuthorText + "</button>");
        buttons.append("<button class='chtpl0-submit2 button_customer btn-primary pull-left btn smooth im-send' data-recipient='Customer'>" + options.sendCustomerText + "</button>");
        posts.html("");

        var send = buttons.find('button');
        var msg = you.find('textarea');
        msg.data('index', 0);
        send.click(function () {
            var text = jQuery.trim(msg.val());
            actionPost(text, function (ok) {
                if (ok == true) {
                    msg.val("");
                    msg.data('index', 0);
                    $(this).data('recipient', 0);
                    scroll();
                    setTimeout(function () {
                        msg.focus();
                    }, 100);
                }
            },
                {
                    index: msg.data('index'),
                    recipient: $(this).data('recipient'),
                    flags: Array.prototype.map.call( $("input:checkbox:checked"), function( input ) {return input.id;})
                }
            );
        });
        msg.keydown(function (e) {
            if (e.keyCode==17) ctrl=true;
            else if (e.keyCode==13 && ctrl){
                var text = jQuery.trim(msg.val());
                actionPost(text, function (ok) {
                    if (ok == true) {
                        msg.val("");
                        msg.data('index', 0);
                        $(this).data('recipient', 0);
                        scroll();
                        setTimeout(function () {
                            msg.focus();
                        }, 100);
                    }
                }, {index: msg.data('index'), recipient: 'no'});
            }
        });
        msg.keyup(function (e) {
            if (e.keyCode==17) ctrl=false;
            var text = jQuery.trim(msg.val());
            if (text.length > options.maxPostLen) {
                msg.css({color: 'red'});
                msg.parent().find(".exceded").text("size exceded");
            } else {
                msg.css({color: 'black'});
                msg.parent().find(".exceded").text("");
            }
        });
        var launchTimer = function () {
            setTimeout(function () {
                try {
                    actionTimer();
                } catch (e) {
                }
                launchTimer();
            }, options.timerMs);
        };
        actionInit(scroll);
        launchTimer();
    };
}; //end
