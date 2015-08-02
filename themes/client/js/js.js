//$( document ).ready(function() {
   //     var ww = $(".header .col_25:nth-child(4)").css("width");
	 // alert(ww);
//});
$(window).load(function() {
	//var ww = $(".navbar-mobile .navbar-inner .nav > li:first-child").css("width");
	  //$('.nav li:first-child ul').css('width',ww);
	  
	  var ee = $(".navbar-mobile .navbar-inner .nav > li:last-child").css("width");
	  $('.nav li:last-child ul').css('width',ee);
	   var rr = $("#slider1 .viewport").css("width");
	   rr=parseInt(rr);
	  $('#slider1 .overview li').css('width',rr-4+'px');
});

$(document).ready(function()
{
    $("#slider1").tinycarousel({ interval: true });

    var slider7 = $("#slider1").data("plugin_tinycarousel");

    // The move method you can use to make a
    // anchor to a certain slide.
    //
    $('#gotoslide4').click(function()
    {
        slider7.move(4);

        return false;
    });

    // The start method starts the interval.
    //
    $('#startslider').click(function()
    {
        slider7.start();

        return false;
    });

    // The stop method stops the interval.
    //
    $('#stopslider').click(function()
    {
        slider7.stop();

        return false;
    });
});