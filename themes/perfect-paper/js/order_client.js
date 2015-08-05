$(document).ready(function() {
    window.mobileView = false;
    window.tabletView = false;
    window.desktopView = false;
    
    switchFormClass();

    $('.radio-group .button-group label').click(function(){
        if ($(this).hasClass('disabled')) {
            $(this).removeClass('active');
            return false;
        }
        
        $(this).parents('.radio-group').find('.button-group.active').removeClass('active');
        $(this).parent('.button-group').addClass('active');
        $(this).parents('.radio-group').find('input').removeAttr('checked'); 
        $(this).find('input').attr('checked','checked');
        $(this).find('input').trigger('change');
        
        /* change select on button click */ 
        var selval = $(this).find('input').val();
        $(this).closest('.radio-group').parent().find('.select-order select option:selected').removeAttr("selected");
        $(this).closest('.radio-group').parent().find('.select-order select option[value="'+selval+'"]').attr("selected", "selected");
    });

    /* change button on select click */ 
    $('.select-order select').change(function(){
        var selval = $(this).val();
        $(this).closest('.select-order').parent().find('.radio-group label input[value="'+selval+'"]').parent().trigger('click');
    });

    $('.autocomplete-block select').change(function(){
        $('.autocomplete-block input.ui-autocomplete-input').val($(this).find('option:selected').text());
    });
    
     // The same .button-group height
    calcBtnHeight();

    $(window).resize(function() {
        switchFormClass();
        // The same .button-group height
        calcBtnHeight();
     });

    // Tabs
    $('#order_contact_block .order-tabs li').click(function(){
        if (!$(this).hasClass('active')) {
            $(this).siblings('li.active').removeClass('active');
            $(this).addClass('active');
            var current_tab = $('#' + $(this).attr('tab-target'));
            current_tab.siblings('div.active').removeClass('active');
            current_tab.addClass('active');
        }
    });
});

/* -------- All tooltip ---------- */
function TooltipCalc(tool) {
    tool.after('<div class="order-tooltip">' + tool.attr('order-tooltip') + '</div>');
    
    // offset-top 
    var topOffset = 15;

    // tooltit item
    var tooltip = tool.siblings('.order-tooltip');
    var tooltipHeight = tooltip.outerHeight();
    var tooltipWidth = tooltip.outerWidth();
    var tooltipWidthHalf = tooltipWidth/2;

    // tooltip caller
    var tooltipCaller = tool;
    var tooltipCallerPosX = tooltipCaller.position().left;
    var tooltipCallerWidthHalf = tooltipCaller.outerWidth()/2;

    // tooltip calculate
    var tooltipPosY = -(tooltipHeight + topOffset);
    var tooltipPosX = (tooltipCallerPosX + tooltipCallerWidthHalf) - (tooltipWidthHalf);

    tooltip.css({ "top": tooltipPosY + 'px', "left": tooltipPosX + 'px', "width" : tooltipWidth + 'px', "height" : tooltipHeight + 'px'});
	
	$(".last-icon-info").next(".order-tooltip").css({"right":"0","left":"initial"});
	$(".icon-info").next(".order-tooltip").append("<span class='after-block'></span>");
	$(".last-icon-info").next(".order-tooltip").find(".after-block ").css({"right":"1px","left":"initial"});
	
}


var htmlwidth = $("html").width();
if((htmlwidth>768) && (htmlwidth<1024)) {

    $(window).resize(function(){
        $(".order-tooltip").css("display","none");
        $('[order-tooltip]').removeClass('showed-tooltip');
    });
}

function desctopTooltipShow(){
    if ( !$(this).hasClass('false-tooltip') ) {
        if(!$(this).attr('order-tooltip')){return false;}

        TooltipCalc($(this));
    }
}
function desctopTooltipHide(){
    if ( !$(this).hasClass('false-tooltip') ) {
        var orderTooltip = $(this).parent().find('.order-tooltip');
        setTimeout(function(){
            orderTooltip.fadeOut(50,function(){orderTooltip.remove();});
        }, 10);
    }
}
function hideTooltipTablet() { /* hide Tooltip on click wherever */
    if ( !$(this).hasClass('false-tooltip') ) {
        var orderTooltip = $('.order-tooltip');
        setTimeout(function(){
            orderTooltip.fadeOut(50,function(){orderTooltip.remove();});
        }, 10);
        $('[order-tooltip]').removeClass('showed-tooltip');
    }
}
function tabletTooltip(e) {
    if ( !$(this).hasClass('false-tooltip') ) {
        if (!$(this).hasClass('showed-tooltip')) {

            if(!$(this).attr('order-tooltip')){return false;}

            var orderTooltip = $('.order-tooltip');
            setTimeout(function(){
                orderTooltip.fadeOut(50,function(){orderTooltip.remove();});
            }, 10);

            $('[order-tooltip]').removeClass('showed-tooltip');
            $(this).addClass('showed-tooltip');

            TooltipCalc($(this));

//            $('.order-tooltip').click(function(e){
//                e.stopPropagation();
//            });

            $('body').unbind('click', hideTooltipTablet);
            $('body').bind('click', hideTooltipTablet);
        }
        else {
            var orderTooltip = $(this).next('.order-tooltip');
            setTimeout(function(){
                orderTooltip.fadeOut(50,function(){orderTooltip.remove();});
            }, 10);

            $(this).removeClass('showed-tooltip');
        }
    }
    e.stopPropagation();
}

function mobileTooltip() {
    if ( !$(this).hasClass('false-tooltip') ) {
        if (!$(this).hasClass('showed-tooltip')) {
            
            if(!$(this).attr('order-tooltip')){return false;}

            $(this).addClass('showed-tooltip');
            
            $(this).closest('.button-group').addClass('no-radius');
            $(this).closest('.top-checkbox-btn').addClass('no-radius');

            $(this).after('<div class="order-tooltip">' + $(this).attr('order-tooltip') + '</div>');
            $('.order-tooltip').click(closeoTooltipclick);
        }
        else {
            var orderTooltip = $(this).next('.order-tooltip');
            setTimeout(function(){
                orderTooltip.fadeOut(50,function(){orderTooltip.remove();});
            }, 10);

            $(this).removeClass('showed-tooltip');
            
            $(this).closest('.button-group').removeClass('no-radius');
            $(this).closest('.top-checkbox-btn').removeClass('no-radius');
        }
    }
}

function closeoTooltipclick() {
    var orderTooltip = $(this);
    setTimeout(function(){
        orderTooltip.fadeOut(50,function(){orderTooltip.remove();});
    }, 10);

    $(this).parent().find('.icon-info').removeClass('showed-tooltip');
    $(this).closest('.button-group').removeClass('no-radius');
    $(this).closest('.top-checkbox-btn').removeClass('no-radius');
}

function falseButtonTooltip() { /* on mobile and tablet */
    $('.button-group label[order-tooltip], .top-checkbox-btn label[order-tooltip]').addClass('false-tooltip');
    $('.button-group span.icon-info[order-tooltip], .top-checkbox-btn span.icon-info[order-tooltip]').removeClass('false-tooltip');
}
function falseIconTooltip() { /* on desctop */
    $('.button-group label[order-tooltip], .top-checkbox-btn label[order-tooltip]').removeClass('false-tooltip');
    $('.button-group span.icon-info[order-tooltip], .top-checkbox-btn span.icon-info[order-tooltip]').addClass('false-tooltip');
}
/* ------ All tooltip End -------- */


function calcBtnHeight () {

    var labelContainers = $('div.radio-group');

    if ( (window.tabletView) || (window.desktopView) ) {
        labelContainers.each(function(){
           getMaxHeight($(this).find('.button-group label')); 
        });
    }
    else {
        removeMaxHeight();
    }
}

function getMaxHeight (elms) {
    var maxHeight = 0;
    var labelPadding = 14;
    var height = 0;
    elms.each(function () {
        height = $(this).find('span').height();
        // console.log(height);
        if (height > maxHeight) {
            maxHeight = height;
        }
    });
    elms.css('height', maxHeight + labelPadding);
}

function removeMaxHeight() {
    $('div.radio-group .button-group label').attr('style', '');
}

function switchFormClass () {
    if ( $('.what-mobile-view').is(":visible") ) { window.mobileView = true; window.tabletView = false; window.desktopView = false; }
    if ( $('.what-tablet-view').is(":visible") ) { window.mobileView = false; window.tabletView = true; window.desktopView = false; }
    if ( $('.what-desktop-view').is(":visible") ) { window.mobileView = false; window.tabletView = false; window.desktopView = true; }

    if( (window.desktopView) || (window.tabletView) ) {
        /* desctop and tablet */
        $('.form-wrap').removeClass('mobile-view').addClass('desktop-view');
        if ( ($('div.to-step-3').hasClass('active-step')) && ($('div.to-step-2').hasClass('active-step')) ) {
            $('div.to-step-2').removeClass('active-step');
        }

        if($('div.to-step-2').hasClass('active-step')){
            $("#order-step-1").hide();   
            $("#order-step-3").hide();   
        }else  if($('div.to-step-1').hasClass('active-step')){
            $("#order-step-2").hide();   
            $("#order-step-3").hide();   
        }else  if($('div.to-step-3').hasClass('active-step')){
            $("#order-step-2").hide();   
            $("#order-step-1").hide();   
        }
        
    } else {
        /* mobile */
        $('.form-wrap').removeClass('desktop-view').addClass('mobile-view');
        
        /*if ( ($('div.to-step-3').hasClass('active-step')) ) {
            $('div.to-step-2').addClass('active-step');
        }
        
        if( ($('div.to-step-2').hasClass('active-step')) || ($('div.to-step-3').hasClass('active-step')) ){
            $("#order-step-1").hide();   
            $("#order-step-2").show();
            $("#order-step-3").show();
        } else  if($('div.to-step-1').hasClass('active-step')){
            $("#order-step-2").hide();
            $("#order-step-3").hide();   
        }*/
        
        $("#order-step-1, #order-step-2, #order-step-3").show();
    }
    
    if ( window.desktopView ) {
        /* desktop */
        $('[order-tooltip]').unbind('mouseenter', desctopTooltipShow);
        $('[order-tooltip]').unbind('mouseleave', desctopTooltipHide);
        $('[order-tooltip]').unbind('click', tabletTooltip);
        $('[order-tooltip]').unbind('click', mobileTooltip);
        $('body').unbind('click', hideTooltipTablet);
        
        falseIconTooltip();
        
        $('[order-tooltip]').bind('mouseenter', desctopTooltipShow);
        $('[order-tooltip]').bind('mouseleave', desctopTooltipHide);
    }
    else if ( window.tabletView ) {
        /* tablet */
        $('[order-tooltip]').unbind('mouseenter', desctopTooltipShow);
        $('[order-tooltip]').unbind('mouseleave', desctopTooltipHide);
        $('[order-tooltip]').unbind('click', tabletTooltip);
        $('[order-tooltip]').unbind('click', mobileTooltip);
        $('body').unbind('click', hideTooltipTablet);
        
        falseButtonTooltip();
        
        $('[order-tooltip]').bind('click', tabletTooltip);
    }
    else {
        /* mobile */
        $('[order-tooltip]').unbind('mouseenter', desctopTooltipShow);
        $('[order-tooltip]').unbind('mouseleave', desctopTooltipHide);
        $('[order-tooltip]').unbind('click', tabletTooltip);
        $('[order-tooltip]').unbind('click', mobileTooltip);
        $('body').unbind('click', hideTooltipTablet);
        
        falseButtonTooltip();
        
        $('[order-tooltip]').bind('click', mobileTooltip);
    }
    
    
    
}