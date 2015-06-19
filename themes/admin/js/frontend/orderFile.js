function st () {
    if($(".f").css('display')=='none') {
        $(".f").css('display','block');
        $("#s").html('Прикрепить файл (скрыть)');
	
    } else {
        $(".f").css('display','none');
        $("#s").html('Прикрепить файл (развернуть)');
	
    }

}

$(function() {
    $(".f").css('display','none');

    $("#add_fil").click(  function () {
        $($(this).parent()).before("<p class='f'><input type='file' name='file[]'><input type='button' value='-' id='min_fil'></p>");
    });

    if( $( '#min_fil' ).length )   {
        $("#min_fil").live( "click", function () {
            $($(this).parent()).remove();
        });
    }

});
