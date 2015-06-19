$(function(){
    $('.accordion > dd').hide();
    $('.accordion > dt > div > a').live('click', function() {
        if($(this).attr('disp') == 'none') {
            var allPanels = $('.accordion > dd');
            $('dt').attr('class', 'bg2');
            allPanels.slideUp();
            $('.accordion > dt > div > a').attr('disp', 'none');
            $(this).parent().parent().next().slideDown();
            $(this).parent().parent().addClass('bg1');
            $(this).parent().parent().removeClass('bg2');
            $(this).attr('disp', 'block');
            uploader.refresh();
            uploader1.refresh();
        } else {
            $('dt').attr('class', 'bg2');
            $('.accordion > dt > div > a').attr('disp', 'none');
            $('.accordion > dd').slideUp();
        }
        return false;
    });
    
    $('.accordion > dt:first > div > a').click();
});