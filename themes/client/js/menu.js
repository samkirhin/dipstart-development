$(document).ready(function(){
 
    var touch = $('#touch-menu');
    var menu = $('.menu');
 
    $(touch).on('click', function(e) {
        e.preventDefault();
        menu.slideToggle();
    });
    $(window).resize(function(){
        var w = $(window).width();
        if(w > 760 && menu.is(':hidden')) {
            menu.removeAttr('style');
        }
    });
    
    function chatEmpty() {
        if ($('div#chatWindow').has('div.post').length > 0) {
            $('div#chatWindow').removeClass('chat-window');
        } else {
            $('div#chatWindow').addClass('chat-window');
        }
    }
    
    chatEmpty();
    
    $('input.btn-chat').on('click', chatEmpty);
    
    
    $('div.info-block h4.panel-title a').append('<i style="font-size: 1.8em!important;" class="fa fa-angle-down fa-lg">');
    
    $('div.project-changes div.panel-heading h4.panel-title a').append('<i style="font-size: 1.8em!important;" class="fa fa-angle-up fa-lg">');

    $('div.project-left-bar div.col-xs-12').not('.project-changes').find('div#accordion .panel-title a').append('<i style="font-size: 1.8em!important;" class="fa fa-angle-down fa-lg">');
    
    
    var arrow = 'fa-angle-down fa-lg';
    $('div.info-block h4.panel-title a').on('click', function() {
        if (arrow == 'fa-angle-down fa-lg') {
            arrow = 'fa-angle-up fa-lg';
            $('div.info-block h4.panel-title a i').removeClass('fa-angle-down fa-lg').addClass(arrow);
        } else {
            arrow = 'fa-angle-down fa-lg';
            $('div.info-block h4.panel-title a i').removeClass('fa-angle-up fa-lg').addClass(arrow);
        }
    });
    
    $('div.project-changes div.panel-heading h4.panel-title a').on('click', function() {
        if ($(this).children('i').hasClass('fa-angle-down fa-lg')) {
            $(this).children('i').removeClass('fa-angle-down fa-lg').addClass('fa-angle-up fa-lg');
        } else {
            $(this).children('i').removeClass('fa-angle-up fa-lg').addClass('fa-angle-down fa-lg');
        }
    });
    
    $('div.project-left-bar div.col-xs-12').not('.project-changes').find('div#accordion .panel-title a').on('click', function() {
        if ($(this).children('i').hasClass('fa-angle-down fa-lg')) {
            $(this).children('i').removeClass('fa-angle-down fa-lg').addClass('fa-angle-up fa-lg');
        } else {
            $(this).children('i').removeClass('fa-angle-up fa-lg').addClass('fa-angle-down fa-lg');
        }
    });
    
    var activeLi = $('li').has('a[href="/project/zakaz/ownList"]');
    if (activeLi.hasClass('active')) {
        console.log('aaaaa');
        $('h1.projects-title').css('visibility', 'hidden');
    }
});