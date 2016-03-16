$(document).ready(function() {
	$('#Zakaz_specials2').change(function(){
		var work_type = $("#Zakaz_specials2 option:selected").val();
		$('[data-worktypes]').hide();
		if(work_type) $('[data-worktypes^='+work_type+']').show();
		$('.form-container form').masonry({itemSelector : '.form-item',});
		return false;
	});
});