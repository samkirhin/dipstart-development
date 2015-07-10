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
    $('.btn-chat').click(function(){
        var order=$('#order').val();
        $.post('/project/chat?orderId='+order,{
            ProjectMessages:{
                message:$('#message').val(),
                recipient:this.name,
				order: order,
				cost: $('.price-for-work-avtor input').val()
            }
        },function(data){
            $('#chat').html(data);
            $('.chat-view').scrollTop(10000);
            $('#message').val('');
        });
        return false;
    });
    $('.chat-view').scrollTop(10000);
});