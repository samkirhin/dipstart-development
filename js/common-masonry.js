var waitIfNotReady = function() {
	setTimeout(function(){
		waitIfNotReady();
	}, 100);
};
function masonry() {
	$('.form-container form').masonry({itemSelector : '.form-item',});
}
$(window).load(function() {
	waitIfNotReady = function() {
		$('panel-body').show();
		setTimeout(function(){
			masonry();
		}, 400);
		setTimeout(function(){
			masonry();
		}, 600);
	};
	waitIfNotReady();
});
$(function() {
	masonry();
	$('[data-toggle="collapse"]').click(function() {
		/*setTimeout(function(){
			masonry()
		}, 400);*/
		waitIfNotReady();
	});
});