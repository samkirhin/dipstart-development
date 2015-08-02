$(document).ready(function() {

	$("#fastorder").submit(function() {
        if ($("#type").val() == "") {
			alert("Выберите тип работы");
        }else if ($("#volume").val() == "") {
			alert("Укажите объем");
        } else if ($("#phone").val() == "") {
			alert("Введите телефон");
        }else{
			fdata = $(this).serialize();
			$.post("/order", fdata, function(data){
				$("#volume").val('');
				$("#phone").val('');
				alert(data);
			});
		}
        return false;
    });
	
	/* Отзывы */
	$('#reviews').cycle({timeout:4000,fx:'fade',sync:false,pause:0,pauseOnPagerHover:0});
	
	// Expand Panel
	$("#open").click(function(){
		$("div#panel").slideDown("slow");
	
	});	
	
	// Collapse Panel
	$("#close").click(function(){
		$("div#panel").slideUp("slow");	
	});		
	
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("#toggle1 a").click(function () {
		$("#toggle a").toggle();
	});	
});
