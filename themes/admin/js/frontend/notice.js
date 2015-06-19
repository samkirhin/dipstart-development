$.notice = {
    show: function(title, msg, type, btn) {
        $.notice.destroy();
        var colors = {
            'error': '#B22222',
            'status': '#0000FF'
        };
        var tpl = '<div class="ui-block-container"><div class="ui-block-bg"></div>'
        +'<div class="ui-block"><table border=\'0\' width=\'100%\' height=\'100%\'>'
        +'<tr><td align=\'center\'><table border=\'0\' cellpadding=\'0\' cellspacing=\'0\' style=\'width: 300px;\'><tr><td bgcolor=\'#000000\'>'
        +'<table border=\'0\' cellpadding=\'3\' cellspacing=\'1\' style=\'width: 300px;\'><tr>'
        +'<td align=\'center\' height=\'30\' bgcolor=\''+colors[type]+'\'>'
        +'<font color=\'#FFFFFF\' face=\'Verdana, Arial, Helvetica, sans-serif\'>'
        +'<b style="font-size: 15px;">'+title+'</b></font></td></tr><tr>'
        +'<td align=\'center\' bgcolor=\'#FFFFFF\'>'
        +'<font color=\'#000000\' face=\'Verdana, Arial, Helvetica, sans-serif\'><div style="margin-top: 6px; font-size: 12px;">'+msg+'</div>'
        +(btn ? '<div style="margin: 10px"><input type="button" value="Закрыть" id="notice-close" style="width: 200px; height: 30px;"></div>' : '')
        +'</font></td></tr></table></td></tr></table></td></tr></table></div></div>';
        $(document.body).prepend(tpl);
        if(btn) {
            $('#notice-close').click(function(){
                $.notice.destroy();
            });
        }
        $(document).on('keyup', function(e) {
            if (e.keyCode == 27) {
                $.notice.destroy();
            }
        });
    },
    destroy: function(){
        $('.ui-block-container').remove();
    }
}