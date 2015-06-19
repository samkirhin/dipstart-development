Ext.override(Ext.grid.GridPanel, {
    enableColumnHide: false,
    enableColumnMove: false,
    enableDragDrop: false,
    enableHdMenu: false
});

Ext.override(Ext.Component, {hideMode: 'offsets'});

Ext.override(Ext.form.FormPanel, {
    labelAlign: 'top',
    autoScroll: true,
    padding: 10
});

Ext.override(Ext.Window, {
    padding: 5,
    modal: true,
    closable: true,
    closeAction: 'hide'
});

Ext.override(Ext.form.ComboBox, {
    valueField: 'id',
    displayField: 'name',
    triggerAction: 'all',
    editable: false,
    mode: 'local'
});

Ext.ns('App.Components');

App.Components.ImageEditWindow = Ext.extend(Ext.Window, {
    title: 'Редактирование изображения',
    modal: true,
    closable: true,
    closeAction: 'hide',
    resizable: true,
    width: 500,
    height: 500,
    layout: 'fit',
    jcrop: null,
    jcropCoords: {
        x: 0, 
        y: 0,
        width: 0,
        height: 0
    },
    initComponent: function(){
        this.createTools();
        this.createItems();
        this.on({
            show: function(){
                var rand = Math.floor(Math.random()*100);
                this.image.el.set({src: this.cmp.baseAddr+this.cmp.currentAddr+'?p='+rand});
            },
            scope: this
        })
        App.Components.ImageEditWindow.superclass.initComponent.apply(this, arguments);
    },
    createItems: function(){
        this.image = new Ext.BoxComponent({
            autoEl: {
                tag: 'img'
            }
        });
        this.items = new Ext.Container({
            autoScroll: true,
            items: this.image
        });
    },
    createTools: function(){
        this.vertSizeField = new Ext.form.NumberField({
            xtype: 'numberfield',
            emptyText: 'Высота'
        });
        this.horSizeField = new Ext.form.NumberField({
            xtype: 'numberfield',
            emptyText: 'Ширина'
        });
        this.allSizeField1 = new Ext.form.NumberField({
            xtype: 'numberfield',
            emptyText: 'Ширина'
        });
        this.allSizeField2 = new Ext.form.NumberField({
            xtype: 'numberfield',
            emptyText: 'Высота'
        });
        this.tbar = new Ext.Toolbar({
            items: [{
                text: 'Изменить размер',
                menu: [{
                    text: 'По вертикали',
                    menu: [this.vertSizeField, {
                        text: 'Применить',
                        handler: this.resizeImage.createDelegate(this, ['vertical']),
                        scope: this
                    }]
                }, {
                    text: 'По горизонтали',
                    menu: [this.horSizeField, {
                        text: 'Применить',
                        handler: this.resizeImage.createDelegate(this, ['horizontal']),
                        scope: this
                    }]
                }, {
                    text: 'По всем',
                    menu: [this.allSizeField1, this.allSizeField2, {
                        text: 'Применить',
                        handler: this.resizeImage.createDelegate(this, ['all']),
                        scope: this
                    }]
                }]
            }, '-', {
                text: 'Вырезать',
                menu: [{
                    text: 'Квадрат',
                    handler: this.setCropArea.createDelegate(this, ['square']),
                    scope: this
                }, {
                    text: 'Прямоугольник',
                    handler: this.setCropArea.createDelegate(this, ['rectangle']),
                    scope: this
                }, {
                    text: 'Сохранить',
                    handler: this.cropImage,
                    scope: this
                }, {
                    text: 'Отменить',
                    handler: this.removeCropArea,
                    scope: this
                }]
            }, '-', {
                text: 'Повернуть влево',
                handler: this.rotateImage.createDelegate(this, ['left']),
                scope: this
            }, {
                text: 'Повернуть вправо',
                handler: this.rotateImage.createDelegate(this, ['right']),
                scope: this
            }]
        })
    },
    setCropArea: function(type){
        if (!this.jcrop){
            this.jcrop = $.Jcrop('#'+this.image.el.id);
            this.jcrop.setOptions({
                onSelect: this.onJcropChange.createDelegate(this)
            });
        }
        this.jcrop.setOptions({aspectRatio: type == 'square' ? 1 : 0});
    },
    onJcropChange: function(c){
        this.jcropCoords = {
            x: c.x,
            y: c.y,
            width: c.w,
            height: c.h
        }
    },
    cropImage: function(){
        if (!!this.jcrop){
            Ext.Ajax.request({
                url: 'photo/crop.adm',
                method: 'POST',
                params: {
                    file: this.cmp.baseAddr+this.cmp.currentAddr,
                    x: this.jcropCoords.x,
                    y: this.jcropCoords.y,
                    width: this.jcropCoords.width,
                    height: this.jcropCoords.height
                },
                callback: this.refreshView,
                scope: this
            });
        }
    },
    removeCropArea: function(){
        this.jcrop.destroy();
        this.jcrop = null;
    },
    rotateImage: function(type){
        Ext.Ajax.request({
            url: '/photo/rotate.adm',
            method: 'POST',
            params: {
                file: this.cmp.baseAddr+this.cmp.currentAddr,
                type: type
            },
            callback: this.refreshView,
            scope: this
        });
    },
    resizeImage: function(type){
        var width=null, height=null;
        switch (type){
            case 'horizontal':
                width = this.horSizeField.getValue();
                height = null;
                break;
            case 'vertical':
                width = null;
                height = this.vertSizeField.getValue();
                break;
            case 'all':
                width = this.allSizeField1.getValue();
                height = this.allSizeField2.getValue();
                break;
        }
        Ext.Ajax.request({
            url: '/photo/resize.adm',
            method: 'POST',
            params: {
                file: this.cmp.baseAddr+this.cmp.currentAddr,
                type: type,
                width: width,
                height: height
            },
            callback: this.refreshView,
            scope: this
        })
    },
    refreshView: function(){
        if (!!this.jcrop){
            this.removeCropArea();
        }
        var rand = Math.floor(Math.random()*100);
        this.image.el.set({src: this.cmp.baseAddr+this.cmp.currentAddr+'?p='+rand});
        this.cmp.reloadView();
    }
});

App.Components.Image = Ext.extend(Ext.BoxComponent, {
    defaultImg: '/images/admin/no_photo_big.gif',
    editable: false,
    editWindowInited: false,
    currentAddr: null,
    initComponent: function(){
        App.Components.Image.superclass.initComponent.apply(this, arguments);
    },
    afterRender: function(){
        App.Components.Image.superclass.afterRender.apply(this, arguments);
        var el = this.getEl();
        el.setStyle('background', 'url('+this.defaultImg+') center center no-repeat');
        if (this.editable){
            el.on({
                dblclick: this.showEditWindow,
                scope: this
            });
        }
    },
    showEditWindow: function(){
        if (Ext.isEmpty(this.currentAddr)){
            Ext.Msg.alert('Внимание', 'Не загружено изображение для редактирования.');
            return ;
        }
        if (!this.editWindowInited){
            this.editWindow = new App.Components.ImageEditWindow({cmp: this});
            this.editWindowInited = true;
        }
        this.editWindow.show();
    },
    resetView: function(){
        this.setRawView(this.defaultImg);
    },
    setView: function(addr){
        if (Ext.isEmpty(addr)) {
            this.resetView();
            this.currentAddr = null;
        } else {
            this.currentAddr = addr;
            this.setRawView(this.baseAddr+addr);
        }
    },
    reloadView: function(){
        if (!Ext.isEmpty(this.currentAddr)){
            this.setRawView(this.baseAddr+this.currentAddr);
        }
    },
    setRawView: function(addr){
        if (this.rendered){
            var rand = Math.floor(Math.random()*10000);
            this.getEl().setStyle('background-image', 'url('+addr+'?p='+rand+')');
        } else this.on('afterrender', this.setRawView.createDelegate(this, [addr]), this, {single: true});
    },
    setBase: function(base){
        this.baseAddr = base;
    }
});

function executeModule(){
    window.location = this.base;
}

function executeModuleAction(base, act){
    if (window.location.pathname == base){
        if (!!act){
            this.executeAction(act.replace('#', ''));
        }
        return ;
    }
    if (!!act){
        window.location = base+act;
    } else window.location = base;
}

function requestModules(){
    Ext.Ajax.request({
        url: '/main/modules.adm',
        method: 'GET',
        callback: function(o, s, r){
            var obj = Ext.decode(r.responseText);
            var tb = this.north.getTopToolbar();
            for (var i=0, cnt=obj.data.length; i<cnt; i++){
                var itemObj = {
                    text: obj.data[i].name
                }
                if (obj.data[i]['modules'] != undefined){
                    var menu = new Ext.menu.Menu();
                    for (var j=0, cnt2=obj.data[i].modules.length; j<cnt2; j++){
                        var fnc = Ext.emptyFn;
                        if (obj.data[i].modules[j][1] != undefined){
                            fnc = window.executeModuleAction.createDelegate(this, [obj.data[i].base, obj.data[i].modules[j][1]]);
                        }
                        menu.add({
                            text: obj.data[i].modules[j][0],
                            handler: fnc
                        });
                    }
                    itemObj.menu = menu;
                } else {
                    itemObj.handler = executeModuleAction.createDelegate(this, [obj.data[i].base]);
                }
                var menuItem = new Ext.Button(itemObj);
                if (obj.data[i]['handler'] != undefined){
                    menuItem.on('click', window[obj.data[i].handler]);
                }
                tb.add(menuItem);
                if (i != cnt-1) tb.add('-');
            }
            tb.add('->');
            tb.add(this.logout);
            tb.doLayout();
        },
        scope: this
    });
}

App.SessionHandler = function(){
    var task = {
        run: function(){
            Ext.Ajax.request({
                url: '/main/session.adm',
                method: 'GET'
            });
        },
        interval: 600000
    }
    Ext.TaskMgr.start(task);
}