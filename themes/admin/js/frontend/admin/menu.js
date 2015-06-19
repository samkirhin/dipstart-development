$(function(){
    $('select[name="type_id"]').change(function(){
        switch($(this).val()) {
            case '1':
                $('#menu-content > .span2').html('Содержимое страницы');
                var row = $('<textarea>', {
                    'rows': '15',
                    'cols': '3',
                    'class': 'tinyMCE row-content',
                    'name': 'content'
                });
                $('#menu-content > .cont').html(null);
                $('#menu-content > .cont').append(row);
                $('.row-content').val($('.content_val').val());
                mceInit('tinyMCE');
                break;
                
            case '2':
                $('#menu-content > .span2').html('Ссылка');
                var row = $('<input>', {
                    'name': 'content',
                    'class': 'input-xlarge row-content',
                    'type': 'text'
                });
                $('#menu-content > .cont').html(null);
                $('#menu-content > .cont').append(row);
                setTimeout(function(){
                    $('.row-content').val($('.content_val').val());
                }, '200');
                break;
                    
            case '3':
            default:
                $('#menu-content > .span2').html(null);
                $('#menu-content > .cont').html(null);
                break;
        }
    });
    setTimeout(function(){
        $('select[name="type_id"]').change();
    }, '300');
});

function mceInit(selector) {
    $('textarea.'+selector).tinymce({
        // Location of TinyMCE script
        script_url : '/js/tinymce/jscripts/tiny_mce/tiny_mce.js',

        // General options
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
        language: 'ru',
        theme : "advanced",
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom"
    });
}