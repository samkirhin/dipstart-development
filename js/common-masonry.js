var waitIfNotReady = function() {
	setTimeout(function(){
		waitIfNotReady();
	}, 100);
};

$(window).load(function() {
	waitIfNotReady = function() {
		$('panel-body').show();
		setTimeout(function(){
			$('.form-container form').masonry({itemSelector : '.form-item',})
		}, 400);
	};
});
$(function() {
	$('.form-container form').masonry({itemSelector : '.form-item',});
	$('[data-toggle="collapse"]').click(function() {
		/*setTimeout(function(){
			$('.form-container form').masonry({itemSelector : '.form-item',})
		}, 400);*/
		waitIfNotReady();
	});
});