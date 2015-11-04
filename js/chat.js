$(document).ready(function() {
	$('.del').click(function(){
		self = $(this);
		$.get( $(this).attr('href'), function( data ) {
 			self.remove();
 		});
		return false;
	});

	$('.approve').click(function(){
		self = $(this);
		$.get( $(this).attr('href'), function( data ) {
 			self.remove();
 		});
		return false;
	});

	$('.request').click(function(){
		var userId = parseInt($(this).attr('user'));
		var userName = $(this).attr('username');
		$('#recipient').val(userId);

		$('#msgLabel').text('Сообщение для '+userName);
		return false;
	});

	$('.setexecutor').click(function(){
		$.get( $(this).attr('href'), function( data ) {
 			$('.setexecutor').remove();
 			$('.delexecutor').remove();
 		});
		return false;
	});

	$('.delexecutor').click(function(){
		$.get( $(this).attr('href'), function( data ) {
 			$('.delexecutor').remove();
 		});
		return false;
	});

	$('.readdress').click(function(){
		self = $(this);
		$.get( $(this).attr('href'), function( data ) {
 			self.remove();
 		});
		return false;
	});
	
	function view_chat(name, message, id){
	    message = Trim(message);
        if (message.length<=0) return false;
        var role = parseInt($('div#message_send').attr('role'));
        var order=$('#order').val();
        var message_send = $('div#message_send').attr('message_send');
        var html_message_send = 
            '<div class="message_send info"><div class="message_send flash-success"><a>'+message_send+'</a></div></div>';
        $('#message_send div.message_send').remove();
        $.post('/project/chat?orderId='+order,{
            ProjectMessages:{
				id: id,
                message: message,
                recipient: name,
				order: order,
				cost: $('input#cost').val()
            }
        },function(data){
          
              $('#chat').html(data);
              $('.chat-view').scrollTop(10000);
              $('#message').val('');
              
              if (role==1) {
                $('#message_send').append(html_message_send);
                $('.message_send').fadeIn(400,function(){
                    setTimeout(function() {
                      $('.message_send').fadeOut(400);
                    },5000);
                });
              }
            
        });
	};

	
    $('.btn-chat').click(function(){
        view_chat( this.name, $('#message').val(), 0);
		return false;
    });
    $('.chat-edit').click(function(){
		var step = $('#chat-edit').attr('step');
		step++;	step &= 1;
		$('#chat-edit').attr( 'step', step);
		var text = document.getElementsByClassName("text");
		if (step)	{ 
			text = text[text.length-1].innerHTML;
			text = text.replace(/<br>/g,"\r\n");
			$('#edit-message').val(text);
            $('#div-edit-message').css('display', 'block');
			$('#chat-edit').val('Сохранить'); 
			$('#chat-edit').css('display', 'block');
			$('.chat-view').scrollTop(10000);
		} else { 
			$('#chat-edit').val('Редактирование последнего сообщения'); 
            $('#div-edit-message').css('display', 'none');
			view_chat( 'customer', $('#edit-message').val(),text[text.length-1].id);			
		};
        return false;
    });
	$('.chat-view').scrollTop(10000);
});
function zakaz_done(part_id)
{
		var orderId = $('#order').val();
		$.ajax({
			type: "POST",
			url: 'chat/status'
			, data: 'cmd=done&id='+part_id+'&status_id=6'+'&orderId='+orderId
			, success: function(html) {
				html = BackReplacePlusesFromStr(html);
				ajax_response = html;
				if (html != 'null') {
				}
			}
		});
		document.getElementById('zakaz-done-'+part_id).style.display = 'none';
		document.getElementById('partStatus-status-'+part_id).innerHTML = 'завершён';
        return false;
};

function Trim(s) {
    s = s.replace(/^ +/,'');
    s = s.replace(/ +$/,'');
    return s;
}
