var intervalTimer = null;
var titleStar = '***************';
var titleMessage = 'Новое событие';
var defaultTitle = document.title;

$(document).ready(function(){
	setInterval(update_events, 5000);
	$(window).focus(removeTitleSignal);
	$(window).mousemove(removeTitleSignal);
});

function removeTitleSignal(){
	clearInterval(intervalTimer);
	intervalTimer = null;
	document.title = defaultTitle;
}

function getEventObjects(html){
	var events = [];
	$(html).find('tr').each(function(){
		if ($(this).data('id'))
			events.push({
				id: $(this).data('id'),
				type: $(this).data('type')
			});
	});
	return events;
}

function checkNewEvent(data){
	var oldEvents = getEventObjects($('.events-list').html());
	var newEvents = getEventObjects(data);
	var newEvent = null;
	newEvents.forEach(function(newItem){
		var isNew = oldEvents.every(function(oldItem){
			return oldItem.id != newItem.id;
		});
		if (isNew)
			newEvent = newItem;
	});
	return newEvent;
}

function titleSignal(){
	document.title = document.title == titleStar ? titleMessage : titleStar;
}

function update_events(){
    $.post('/project/event/', {update: 1}, function(data){
		var newEvent = checkNewEvent(data);
		$('.events-list').html(data);
		if (newEvent)
		{
			titleMessage = newEvent.type == 1 ? 'Новый заказ' : 'Новое событие';
			// alert(titleMessage);
			if (!intervalTimer)
				intervalTimer = setInterval(titleSignal, 500);
		}
	});
};