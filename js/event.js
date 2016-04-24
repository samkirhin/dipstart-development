$(document).ready(function(){
	setInterval(update_events, 5000);
});

function update_events(){
    $.post('/project/event/', {update: 1}, function(data){
		$('.events-list').html(data);
	});
};