Ext.onReady(function(){
    Ext.QuickTips.init();
 
    // Create a variable to hold our EXT Form Panel. 
    // Assign various config options as seen.	 
    var login = new Ext.FormPanel({ 
        labelWidth:80,
        url:'/main/logon.adm', 
        frame:true, 
        title:'Авторизация', 
        defaultType:'textfield',
        monitorValid:true,
        // Specific attributes for the text fields for username / password. 
        // The "name" attribute defines the name of variables sent to the server.
        items:[{ 
            fieldLabel:'Логин', 
            name:'login', 
            allowBlank:false 
        },{ 
            fieldLabel:'Пароль', 
            name:'pass', 
            inputType:'password', 
            allowBlank:false 
        }],
 
        // All the magic happens after the user clicks the button     
        buttons:[{ 
            text:'Вход',
            formBind: true,	 
            // Function that fires when user clicks the button 
            handler:function(){ 
                login.getForm().submit({ 
                    method:'POST', 
                    waitTitle:'Авторизация', 
                    waitMsg:'Выполняется процесс авторизации...',
 
                    success:function(){ 
                        Ext.Msg.alert('Статус', 'Успешная авторизация!', function(btn, text){
                            if (btn == 'ok'){
                                window.location = '/manage.adm';
                            }
                        });
                    },
 
                    failure:function(form, action){ 
                        if(action.failureType == 'server'){
                            Ext.Msg.alert('Ошибка', 'Возникла ошибка при авторизации'); 
                        }else{ 
                            Ext.Msg.alert('Warning!', 'Authentication server is unreachable : ' + action.response.responseText); 
                        } 
                        login.getForm().reset(); 
                    } 
                }); 
            } 
        }] 
    });
 
 
    // This just creates a window to wrap the login form. 
    // The login object is passed to the items collection.       
    var win = new Ext.Window({
        layout:'fit',
        resizeble: false,
        draggable: false,
        width:300,
        height:150,
        closable: false,
        resizable: false,
        plain: true,
        border: false,
        items: [login]
    });
    win.show();
});