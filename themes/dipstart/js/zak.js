
function vibor() {
window.open( Host+"ajax/vibor.php"  , " _blank" , " height=150,width=300, status=yes,toolbar=no,menubar=no,location=no" )
}

   function add_zakaz()
    {
        $.post('/registration/zakaz_mini', $("#FormPanelAddRega2").serializeArray(), function(e) {
            if(e.error==1) {
                alert(e.notice);
                $("#close").click();
                $("input[name='zakaz_mini_phone']").val('');
                $("input[name='zakaz_mini_email']").val('');
            } else {
                alert(e.error);
            }
        }, 'json');
        return false;
    }

function restore_password() {
    $.post( '/user/restore_password' , $("#FormRestorePass").serializeArray() , function( e ) {
        if( e.error == 1 ) {
            alert( e.notice );
            $( "#restore_pass_email" ).val('');
            $( "#close" ).click();
            $( ".modal-close" ).click();
        } else {
            alert( e.error );
        }
    } , 'json' );
    return false;
}


jQuery(document).ready(function($) {


    $("#applay").click ( function () {
        var res = $("#nex_2_v").attr("value");
        res='vid_'+res;
        var objSel = window.opener.document.getElementById(res);
        $(objSel).attr("selected","selected");
        $(window.opener.document.getElementById('mySelord')).change();
        var val     = $("select[name='dicip'] option:selected", window.opener.document).text();
        var parent  = $("select[name='dicip']", window.opener.document).parent();
        $(".customStyleSelectBoxInner", parent).text(val);
        window.close();

        var button = $('#add_file'), interval;
        var j=0;
        var f=0;
        var i,res="";

	$.ajax_upload(button, {
            action : Host+'upload.php',
            name : 'myfile',
            type : 'myfile',
            id : 'myfile',
            onSubmit : function(file, ext) {
                var i=0,fil='';
                for (i=0; i<file.length; i++) {
                    if(file[i]!=' ')  {fil+=file[i];}
                }
                file=fil;
                res=file;
                name=res;
                var pos=res.lastIndexOf('.');
                f=res.substring(pos+1,res.length);
                file=res;
					
            },
            onComplete : function(res, response) {
                file=res;
                j++;
                $('<p>'+res + '</p>').appendTo("#file1");
                    var f=$("#f").attr('value');
                    f+='|'+response+'-'+res;
                    $("#f").attr('value',f);
            }
        });
				

    });
    
    //Новый заказ
    $("input[id='add_rega']").click(function() {
        $.post('/registration/zakaz_mini', $("#FormPanelAddRega").serializeArray(), function(e) {
            if(e.error==1) {
                alert(e.notice);
                $("#close").click();
                $("input[name='zakaz_mini_phone']").val('');
                $("input[name='zakaz_mini_email']").val('');
            } else {
                alert(e.error);
            }
        }, 'json');
        return false;
    });

    //Restore p[ass]
    $( '#do_restore_password' ).click( function() {
        restore_password();
    } );
    
 
    
 
    $("#user_login").click(function() {
        var method = $("#user_login_method").is(':checked');
        if(method==true) method = '1'; else method = '0';
        
        $.post('r=site/login', {login: '', mail: $("#user_login_email").val(), method: method, pass: $("#user_login_pass").val()}, function(e) {
            if(e.error==1) {
                window.location = '';
            } else {
                alert(e.error);
            }
        }, 'json');
        return false;
    });
    
    
    
});