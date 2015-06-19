$(function(){
    $('tr[data-href] td').click(function() {
        if(!$(this).hasClass('option'))
            window.location.href = $(this).parent().data('href');
    });
});