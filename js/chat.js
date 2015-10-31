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
	
	function view_chat(message, id){
        var order=$('#order').val();
        $.post('/project/chat?orderId='+order,{
            ProjectMessages:{
				id: id,
                message: message,
                recipient:this.name,
				order: order,
				cost: $('input#cost').val()
            }
        },function(data){
            $('#chat').html(data);
            $('.chat-view').scrollTop(10000);
            $('#message').val('');
        });
		return	false;
	};	

	
    $('.btn-chat').click(function(){
        view_chat($('#message').val(), 0);
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
			view_chat($('#edit-message').val(),text[text.length-1].id);			
		};
        return false;
    });
	$('.chat-view').scrollTop(10000);
});
function zakaz_done(part_id)
{
		$.ajax({
			type: "POST",
			url: 'chat/status'
			, data: 'cmd=done&id='+part_id+'&status_id=6'
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
