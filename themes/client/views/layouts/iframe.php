<!DOCTYPE html>
<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/main.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/skin.css" />
</head><body>
<?php echo $content; ?>
<!--Send height to parent-->
<script type="text/javascript">
var FrameHeightManager = {
	FrameId: '',
	publishHeight : function() {
		var actualHeight = $("body").height();
		var currentHeight = $(window).height();
		if(Math.abs(actualHeight - currentHeight) > 20) {
			window.parent.postMessage([this.FrameId, {height:actualHeight, id:this.FrameId}], '*');
            /*pm({
              target: window.parent,
              type: this.FrameId, 
              data: {height:actualHeight, id:this.FrameId}
            });*/
        }       
    }   

};

/*pm.bind("register", function(data) {
    FrameHeightManager.FrameId = data.id;
    // не забываем передать правильный this
    window.setInterval(function() {FrameHeightManager.publishHeight.call(FrameHeightManager)}, 300);
});*/

function listener(event) {
	var $iframe = $('#the-iframe');
	var eventName = event.data[0];
    var data      = event.data[1];

    switch (eventName) {
        case 'register':
			FrameHeightManager.FrameId = data.id;
			// не забываем передать правильный this
			window.setInterval(function() {FrameHeightManager.publishHeight.call(FrameHeightManager)}, 300);
            break;
    }
	/*
	// IMPORTANT: Check the origin of the data!
	var origin = event.origin || event.originalEvent.origin; // For Chrome, the origin property is in the event.originalEvent object.
	alert(event.origin);
	if (origin == "http://adco.obshya.com") {
        // The data has been sent from your site
		var data = event.data;
		alert(data); // sup
        // The data sent with postMessage is stored in event.data
        console.log(event.data);
    } else {
        // The data hasn't been sent from your site!
        // Be careful! Do not use it.
        return;
    }*/
}
if (window.addEventListener) {
  window.addEventListener("message", listener, false);
} else {
  // IE8
  window.attachEvent("onmessage", listener);
}

</script>
</body></html>