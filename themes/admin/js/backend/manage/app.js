Ext.ns('App');

App.layout = function(){
    return {
        init: function(){
            this.logout = new Ext.Button({
                text: 'Выйти',
                handler: this.doLogout
            });

            this.north = new Ext.Panel({
                region: 'north',
                bodyStyle:'display:none',
                tbar: new Ext.Toolbar({
                    height: 28
                })
            });
            
            requestModules.apply(this);

            this.tabs = new Ext.TabPanel({
                activeTab: 0,
                region: 'center',
                defaults: {
                    tabs: this
                },
                items: [
                new App.Tabs.Catalog()
                ]
            });

            new Ext.Viewport({
                layout: 'border',
                defaults: {
                    autoScroll: true
                },
                items: [this.north, this.tabs]
            });
                
            App.SessionHandler();
        },

        doLogout: function(){
            Ext.Msg.confirm('Внимание!', 'Вы действительно хотите выйти?', function(btn){
                if (btn == 'yes'){
                    document.location = '/main/logout.adm';
                }
            });
        }
    }
}();

Ext.onReady(App.layout.init, App.layout, {
    single: true
});