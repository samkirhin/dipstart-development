Ext.ns('App.Tabs.Catalog', 'App.Stores', 'App.Components');


App.Components.ItemWindow = Ext.extend(Ext.Window, {
    title: 'Управление элементом',
    width: 550,
    height: 240,
    padding: 5,
    autoScroll: true,
    defaults: {
        anchor: '98%',
        xtype: 'textfield'
    },
    initComponent: function(){
        this.createTools();
        this.createItems();
        App.Components.ItemWindow.superclass.initComponent.apply(this, arguments);
    },
    createTools: function(){
        this.tbar = new Ext.Toolbar({
            items: [{
                text: 'Сохранить',
                handler: function(){
                    this.editForm.getForm().submit({
                        url: '/systemcatalogitem/save.adm',
                        method: 'POST',
                        waitTitle: 'Внимание!',
                        waitMsg: 'Сохранение информации...',
                        success: function(data, res){
                            this.loadForm(res.result.data.id, this.category_id);
                        },
                        scope: this
                    });
                },
                scope: this
            }]
        });
    },
    confirmDelete: function(){
        Ext.Msg.confirm('Внимание!', 'Вы действительно хотите удалить эту контактную информацию?', this.doDelete, this);
    },
    createItems: function(){
        this.itemID = new Ext.form.Hidden({
            name: 'id'
        });
        this.categoryId = new Ext.form.Hidden({
            name: 'category_id'
        });
        var item =  [this.itemID,this.categoryId,{
            name: 'name',
            fieldLabel: 'Название'
        }, {
            xtype: 'textarea',
            name: 'description',
            fieldLabel: 'Описание'
        }];
    
        this.editForm = new Ext.form.FormPanel({
            defaults: {
                xtype: 'textfield',
                anchor: '95%'
            },
            items: item,
            listeners: {
                actioncomplete: function(f, a){
                    this.show();
                    if (a.type == 'submit'){
                        this.cmp.itemGrid.enable();
                    }
                },
                beforeaction: function(f, a){
                    if (a.type == 'submit'){
                        this.cmp.itemGrid.disable();
                    }
                },
                scope: this
            }
        });
        this.items = this.editForm;
    },
    loadForm: function(id, category_id){
        this.category_id = category_id;
        this.editForm.getForm().load({
            url: '/systemcatalogitem/get.adm',
            method: 'GET',
            params: {
                id: id,
                category_id: category_id
            }
        });
    }
});

App.Components.CategoryGrid = Ext.extend(Ext.grid.GridPanel, {
    width: 300,
    initComponent: function(){
        this.createColumns();
        this.on({
            rowclick: this.onRowClick,
            scope: this
        });
        App.Components.CategoryGrid.superclass.initComponent.apply(this, arguments);
    },
    onRowClick: function(g, i){
        this.cmp.categoryForm.loadForm(g.store.getAt(i).data.id);
    },
    createColumns: function(){
        this.store = new Ext.data.Store({
            reader: new Ext.data.JsonReader(),
            proxy: new Ext.data.HttpProxy({
                url: '/systemcatalog/list.adm',
                method: 'GET'
            }),
            autoLoad: true
        });
        this.sm = new Ext.grid.RowSelectionModel({
            singleSelect: true
        });
        this.cm = new Ext.grid.ColumnModel({
            defaults: {
                sortable: false
            },
            columns: [{
                header: '#',
                dataIndex: 'id',
                width: 80
            }, {
                header: 'Название',
                dataIndex: 'name',
                width: 200
            }]
        });
    }
});

App.Components.ItemGrid = Ext.extend(Ext.grid.GridPanel, {
    split: true,
    width: 300,
    currentCategoryID: null,
    currentID: null,
    initComponent: function(){
        this.createTools();
        this.createColumns();
        this.on({
            rowdblclick: this.onRowDblClick,
            rowclick: this.onRowClick,
            scope: this
        });
        App.Components.ItemGrid.superclass.initComponent.apply(this, arguments);
    },
    onEnable: function(){
        this.currentCategoryID = this.cmp.categoryForm.itemID.getValue();
        this.store.load({
            params: {
                id: this.currentCategoryID
            }
        });
        App.Components.ItemGrid.superclass.onEnable.apply(this, arguments); 
    },
    onDisable: function(){
        this.store.removeAll();
        App.Components.ItemGrid.superclass.onDisable.apply(this, arguments); 
    },
    createTools: function(){
        this.deleteBtn = new Ext.Button({
            text: 'Удалить',
            handler: this.confirmDelete,
            disabled: true,
            scope: this
        });
        this.addBtn = new Ext.Button({
            text: 'Добавить',
            handler: this.showed,
            scope: this
        });
        this.tbar = new Ext.Toolbar({
            items: [this.addBtn, '->', this.deleteBtn]
        });
    },
    showed: function(){
        this.showItemWindow(0,this.currentCategoryID);
    },
    onRowDblClick: function(g, i){
        this.showItemWindow(g.store.getAt(i).data.id,this.currentCategoryID);
    },
    confirmDelete: function(){
        Ext.Msg.confirm('Внимание!', 'Вы действительно хотите удалить эту контактную информацию?', this.doDelete, this);
    },
    onRowClick: function(g, i){
        this.deleteBtn.enable();
        this.currentID = g.store.getAt(i).data.id;
    },
    createColumns: function(){
        this.store = new Ext.data.Store({
            reader: new Ext.data.JsonReader(),
            proxy: new Ext.data.HttpProxy({
                url: '/systemcatalogitem/list.adm',
                method: 'GET'
            })
        }),
        this.sm = new Ext.grid.RowSelectionModel({
            singleSelect: true
        });
        this.cm = new Ext.grid.ColumnModel({
            defaults: {
                sortable: false
            },
            columns: [{
                header: '#',
                dataIndex: 'id',
                width: 80
            }, {
                header: 'Название',
                dataIndex: 'name',
                width: 200
            }]
        });
    },
    doDelete: function(btn, g, i){
        if (btn != 'yes') return ;
        Ext.Ajax.request({
            url: '/systemcatalogitem/delete.adm',
            method: 'GET',
            params: {
                id: this.currentID
            },
            callback: function(){
                this.store.reload();
                this.deleteBtn.disable();
            },
            scope: this
        });
    },
    showItemWindow: function(id,category_id){
        if (!this.itemWindowInited){
            this.itemWindow = new App.Components.ItemWindow({
                cmp: this.cmp
            });
            this.itemWindowInited = true;
        }
        this.itemWindow.loadForm(id, category_id);
    }
});



App.Components.CategoryForm = Ext.extend(Ext.FormPanel, {
    width: 250,
    defaults: {
        anchor: '98%',
        xtype: 'textfield'
    },
    initComponent: function(){
        this.createTools();
        this.createItems();
        this.on({
            beforeaction: this.onBeforeAction,
            actioncomplete: this.onActionComplete,
            scope: this
        });
        App.Components.CategoryForm.superclass.initComponent.apply(this, arguments);
    },
    onBeforeAction: function(f, a){
        this.deleteBtn.disable();
        this.cmp.itemGrid.disable();
        if (a.type == 'load'){
        //
        }
    },
    onActionComplete: function(f, a){
        if (a.result.data.id != 0){
            this.deleteBtn.enable();
            this.itemID.setValue(a.result.data.id);
            this.cmp.categoryGrid.store.reload();
            this.cmp.itemGrid.enable();
        }
        if (a.type == 'load'){
        //
        } else {
            this.cmp.categoryGrid.store.reload();
        }
    },
    createTools: function(){
        this.deleteBtn = new Ext.Button({
            text: 'Удалить',
            handler: this.confirmDelete,
            scope: this,
            disabled: true
        });
        this.tbar = new Ext.Toolbar({
            items: [{
                text: 'Сохранить',
                handler: function(){
                    this.getForm().submit({
                        url: '/systemcatalog/save.adm',
                        method: 'POST',
                        waitTitle: 'Внимание!',
                        waitMsg: 'Сохранение информации...'
                    });
                },
                scope: this
            }, '->', this.deleteBtn]
        });
    },
    confirmDelete: function(){
        Ext.Msg.confirm('Внимание!', 'Вы действительно хотите удалить это категорию?', this.doDelete, this);
    },
    doDelete: function(btn){
        if (btn != 'yes') return ;
        Ext.Ajax.request({
            url: '/systemcatalog/delete.adm',
            method: 'GET',
            params: {
                id: this.itemID.getValue()
            },
            callback: function(){
                this.cmp.categoryGrid.store.reload();
                this.loadForm();
            },
            scope: this
        });
    },
    createItems: function(){
        this.itemID = new Ext.form.Hidden({
            name: 'id'
        });
        this.items = [this.itemID, {
            name: 'name',
            fieldLabel: 'Название'
        }];
    },
    loadForm: function(id){
        this.getForm().load({
            url: '/systemcatalog/get.adm',
            method: 'GET',
            params: {
                id: id
            }
        });
    }
});


App.Tabs.Catalog = Ext.extend(Ext.Panel, {
    title: 'Системные каталоги',
    layout: 'border',
    initComponent: function(){
        this.createTools();
        this.createItems();
        App.Tabs.Catalog.superclass.initComponent.apply(this, arguments);
    },
    createTools: function(){
        this.tbar = new Ext.Toolbar({
            items: [{
                text: 'Добавить',
                handler: function(){
                    this.categoryForm.loadForm(0)
                },
                scope: this
            }]
        });
    },
    createItems: function(){
        this.categoryGrid = new App.Components.CategoryGrid({
            region: 'west',
            split: true,
            cmp: this
        });
        this.categoryForm = new App.Components.CategoryForm({
            region: 'center',
            split: true,
            cmp: this
        });
        this.itemGrid = new App.Components.ItemGrid({
            region: 'east',
            split: true,
            disabled: true,
            cmp: this
        });
        this.items = [this.categoryGrid, this.categoryForm, this.itemGrid]
    }
});