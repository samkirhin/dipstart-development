$(document).ready(function(){
	$('#ZakazUpdate_status').click(function (){
		$.ajax({
			url: 'index.php?r=project/zakaz/apiFindAuthor',
			type: 'post',
			data: {
				value: $('#ZakazUpdate_status').prop('checked').toString(),
				id: $(this).data('id')
			},
			success: function (data) {
				if (data['data']) alert('Не удалось');
			}
		});
	});
});
var YiiChat = function(options){
	this.run = function(){

	var clear = function(){
		send.attr('disabled',null);
		msg.attr('disabled',null);
	}

	var busy = function(){
		send.attr('disabled','disabled');
		msg.attr('disabled','disabled');
	}

	var actionPost = function(text, callback, data){
		busy();
		jQuery.ajax({ cache: false, type: 'post',
			url: options.action+'&action=sendpost&data=not_used',
			data: { chat_id: options.chat_id, identity: options.identity, text: text, post: data},
			success: function(post){
				if(post == null || post == ""){
					options.onError('post_empty','');
				}else
				if(post == 'REJECTED'){
					options.onError('post_rejected',text);
					callback(false);
				}else{
					add(post,data.index);
					callback(true);
					options.onSuccess('post',text,post);
				}
				clear();
			},
			error: function(e){
				clear();
				options.onError('send_post_error',e.responseText,e);
				callback(false);
			}
		});
	}

	var actionInit = function(callback){
		busy();
		jQuery.ajax({ cache: false, type: 'post',
			url: options.action+'&action=init&data=not_used',
			data: { chat_id: options.chat_id, identity: options.identity },
			success: function(_posts){
				if(_posts == null || _posts == ""){
					options.onError('init_empty','');
				}else
				if(posts == 'REJECTED'){
					options.onError('init_rejected',text);
				}else{
					// _posts.chat_id, _posts.identity, _posts.posts
					jQuery.each(_posts.posts, function(k,post){
						add(post,0);
					});
					options.onSuccess('init','');
					callback();
				}
				clear();
			},
			error: function(e){
				clear();
				options.onError('init_error',e.responseText,e);
			}
		});
	}

	var actionTimer = function(){
		var last_id = '';
		//var lastPost = posts.find('.post:not(.yiichat-post-myown):last');
		var lastPost = posts.find('.post:last');
		var data = lastPost.data('post'); //data setted in add method
		if(data != null)
			last_id = data.id;
		//log.html('last_id='+last_id);
		jQuery.ajax({ cache: false, type: 'post',
			url: options.action+'&action=timer&data=not_used',
			data: { chat_id: options.chat_id, identity: options.identity,
				last_id: last_id },
			success: function(_posts){
				if(_posts == null || _posts == ""){
					options.onError('timer_empty','');
				}else
				if(posts == 'REJECTED'){
					options.onError('timer_rejected',text);
				}else{
					// _posts.chat_id, _posts.identity, _posts.posts
					var hasPosts=false;
					jQuery.each(_posts.posts, function(k,post){
						add(post,0);
						hasPosts=true;
					});
					options.onSuccess('timer','');
					if(hasPosts==true)
						scroll();
				}
			},
			error: function(e){
				options.onError('timer_error',e.responseText,e);
			}
		});
	}

	// fields:
	//	id: postid, owner: 'i am', time: 'the time stamp', text: 'the post'
	//  chat_id: the_chat_id, identity: whoami_id
	var add = function(post,postn){
		if (postn==0) {
			posts.append("<div id='post_"+post.id+"' class='post'>"
				+"<div class='track'></div>"
				+"<div class='text'></div>"
			+"</div>");
			var p = posts.find(".post[id='post_"+post.id+"']");
			p.data('post',post);
			var flag=false;
			if(options.identity == post.sender.id)
				{ p.addClass('yiichat-post-myown'); flag=true; }
			if(flag == true){
				if(options.myOwnPostCssStyle != null){
					p.removeClass('yiichat-post-myown');
					p.addClass(options.myOwnPostCssStyle);
				}
			}else{
				if(options.othersPostCssStyle != null)
					p.addClass(options.othersPostCssStyle);
			}

			var tmp_html = "<div class='time'>"+post.date+"</div>"
				+ "<div class='owner' data-ownerid='"+post.sender.id+"'><a class='ownerref' href='http://dipstart.coolfire.pp.ua/index.php?r=user/user/view&id="+post.sender.id+"'>"+post.sender.username+"</a>";
				if (post.recipient!=0) tmp_html += "ответил"
				+ "<a class='ownerref' href='http://dipstart.coolfire.pp.ua/index.php?r=user/user/view&id="+post.recipient.id+"'>"+post.recipient.username+"</a>";
				tmp_html += "</div>";
				if (post.cost>0) tmp_html += "<div class='cost'>Цена:"+post.cost+"</div>";
				tmp_html += "<div class='buttons'>"
				+ "<button data-index=\""+post.id+"\" class=\"glyphicon-edit glyphicon\"></button>"
				+ "<button data-index=\""+post.id+"\" class=\"glyphicon-remove glyphicon\"></button>";
			if(options.identity != post.sender.id) {
				if (post.moderated==0) tmp_html += "<button data-index=\""+post.id+"\"class=\"glyphicon-ok glyphicon\"></button>";
				tmp_html += "<button data-index=\""+post.id+"\" class=\"glyphicon-envelope glyphicon\"></button>";
				if (post.sender.superuser.itemname=='Author') {
					if (options.executor == post.sender.id)
						tmp_html += "<button data-index=\"" + post.id + "\" class=\"toggleexecutor glyphicon glyphicon-minus\"></button>";
					else
						tmp_html += "<button data-index=\"" + post.id + "\" class=\"toggleexecutor glyphicon glyphicon-plus\"></button>";
				}
			}
			tmp_html += "</div>";
			p.find('.track').html(tmp_html);
			var btn_edit = p.find('button.glyphicon-edit');
			btn_edit.click(function (){
				msg.data('index',this.dataset.index);
				msg.val($(this).closest('.post').find('.text').text());
			});
			var btn_answer = p.find('button.glyphicon-envelope');
			btn_answer.click(function (){
				msg.data('index',this.dataset.index);
				msg.val('Вы писали: "'+$(this).closest('.post').find('.text').text()+'"');
				if ($('.msg_answer').length==0) $(msg).before('<div class="msg_answer">Ответить '+$(this).closest('.post').find('.owner').text()+'</div>');
				else $('.msg_answer').text('Ответить '+$(this).closest('.post').find('.owner').text());
				$('.main_send').data('recipient',$(this).closest('.post').find('.owner').data('ownerid'));
			});
			var btn_remove = p.find('button.glyphicon-remove');
			btn_remove.click(function (){
				setdata=this.dataset;
				jQuery.ajax({ cache: false, type: 'post',
					url: options.action+'&action=dpost&data=not_used',
					data: { chat_id: options.chat_id, id: setdata.index},
					success: function(data){
						clear();
						$('#post_'+setdata.index).remove();
					},
					error: function(e){
						clear();
						options.onError('init_error',e.responseText,e);
					}
				});
			});
			var btn_ok = p.find('button.glyphicon-ok');
			btn_ok.click(function (){
				setdata=this.dataset;
				jQuery.ajax({ cache: false, type: 'post',
					url: options.action+'&action=dapproved&data=not_used',
					data: { chat_id: options.chat_id, id: setdata.index},
					success: function(data){
						clear();
						$(this).remove();
					},
					error: function(e){
						clear();
						options.onError('init_error',e.responseText,e);
					}
				});
			});
			var btn_toggleexecutor = p.find('.track').find('button.toggleexecutor');
			btn_toggleexecutor.click(function (){
				setdata=this.dataset;
				oldaction = $('#post_'+setdata.index).find('button.toggleexecutor').attr('class').split(' ')[2];
				owner = $('#post_'+setdata.index).find('.ownerref').html();
				if (oldaction == 'glyphicon-minus') action = 'plus'; else action = 'minus';
				jQuery.ajax({ cache: false, type: 'post',
					url: options.action+'&action=dtoggle&data='+action,
					data: { chat_id: options.chat_id, id: setdata.index, ex: owner},
					success: function(data){
						$('.post').each(function(){
							if ($(this).find('.owner').html()==owner)
								$(this).find('button.toggleexecutor').removeClass(oldaction).addClass('glyphicon-'+action);
						});
						if (oldaction == 'glyphicon-minus') $('.findauthor').removeClass('hide'); else $('.findauthor').removeClass('hide');
						clear();
					},
					error: function(e){
						clear();
						options.onError('init_error',e.responseText,e);
					}
				});
			});
		} else
			var p = posts.find(".post[id='post_"+postn+"']");
		p.find('.text').html(post.message);
	}

	var scroll = function(){
		//window.location = '#'+posts.find('.post:last').attr('id');
		var h=0;
		posts.find('.post').each(function(k){
			h += $(this).outerHeight();
		});
		posts.scrollTop(h);
	}

	//
	//
	var chat = jQuery(options.selector);
	chat.addClass('yiichat');
	chat.html("<div class='posts'>posts</div><div class='you'>you</div><div class='log'></div>");
	var posts = chat.find('div.posts');
	var you = chat.find('div.you');
	var log = chat.find('div.log');

	you.html("<textarea rows=\"5\" cols=\"60\"></textarea><div class='exceded'></div><br/>");
	you.append("<button class='main_send' data-recipient='no'>"+options.sendButtonText+"</button>");
	you.append("<button data-recipient='Author'>"+options.sendAuthorText+"</button>");
	you.append("<button data-recipient='Customer'>"+options.sendCustomerText+"</button>");
	posts.html("");

	var send = you.find('button');
	var msg = you.find('textarea');
	msg.data('index',0);
	send.click(function(){
		var text = jQuery.trim(msg.val());
		if(text.length<options.minPostLen)
			options.onError('very_short_text',text);
		else if(text.length > options.maxPostLen)
			options.onError('very_large_text',text);
		else
			actionPost(text, function(ok){
				if(ok==true){
					msg.val("");
					msg.data('index',0);
					$(this).data('recipient',0);
					scroll();
					setTimeout(function(){ msg.focus(); },100);
				}
			}, {index: msg.data('index'),recipient: $(this).data('recipient')});
	});
	msg.keyup(function(e){
		var text = jQuery.trim(msg.val());
		if(text.length > options.maxPostLen){
			msg.css({ color: 'red' });
			msg.parent().find(".exceded").text("size exceded");
		}else{
			msg.css({ color: 'black' });
			msg.parent().find(".exceded").text("");
		}
	});
	var launchTimer = function(){
		setTimeout(function(){
			try{
				actionTimer();
			}catch(e){}
			launchTimer();
		},options.timerMs);
	}
	actionInit(scroll);
	launchTimer();
	};
} //end
