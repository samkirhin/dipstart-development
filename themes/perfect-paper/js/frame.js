var FrameHeightManager =
{
    FrameId: 'order_form_frame',
    getCurrentHeight : function()
    {
          myHeight = 0;
          
          if( typeof( window.innerWidth ) == 'number' ) {
            myHeight = window.innerHeight;
          } else if( document.documentElement && document.documentElement.clientHeight ) {
            myHeight = document.documentElement.clientHeight;
          } else if( document.body && document.body.clientHeight ) {
            myHeight = document.body.clientHeight;
          }
          
          return myHeight;      
    },    
    publishHeight : function()
    { 
        if (this.FrameId == '') return;

        if(typeof jQuery === "undefined") {
            var actualHeight = (document.body.scrollHeight > document.body.offsetHeight)?document.body.scrollHeight:document.body.offsetHeight;
            var currentHeight = this.getCurrentHeight();            
        } else {
            
            var actualHeight = $("div.page").height();
            var currentHeight = $(window).height();            
        }

        if(Math.abs(actualHeight - currentHeight) > 5)
        {
            pm({
              target: window.parent,
              type: this.FrameId, 
              data: {height:actualHeight, id:this.FrameId}
            });
        }       
    }   

};

pm.bind("register", function(data) { 
    FrameHeightManager.FrameId = data.id;
    window.setInterval(function() {FrameHeightManager.publishHeight.call(FrameHeightManager)}, 300);
});