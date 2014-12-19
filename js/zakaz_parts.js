var ZakazPartsView = function(orderId) {
    var self = this;
    this.form = $('#zakaz_parts');
    this.orderId = orderId;
    
    /* Привязка имен */
    this.place = this.form.find('.show_parts');
    this.template = this.form.find('.zakazPartTemplate');
    this.templateEdit = this.form.find('.editPartTemplate');
    this.buttonEdit = this.form.find('button.edit');
    this.buttonDelete = this.form.find('button.delete');
    this.buttonAdd = this.form.find('button.add');
    this.addForm = this.form.find('.add_part');
    this.editPart = this.form.find('.edit_part');
    this.createNameInput = this.form.find('input.create_part_name');
    
    /* Загрузка и отображение списка */
    this.loadList = function () {
        self.addForm.hide();
        self.editPart.hide();
        $.post('index.php?r=project/zakazParts/apiGetAll', JSON.stringify({
            'orderId': self.orderId
        }), function (response) {
            if (response.data) {
                self.place.empty();
                self.template.tmpl(response.data.parts).appendTo('.show_parts');
                self.addActions();
            } else {
            }
        }, 'json');
        self.place.show();
    }
    /* Загрузка данных и отображения формы редактирования */
    this.editPartShow = function(id) {
        $.post('index.php?r=project/zakazParts/apiGetPart', JSON.stringify({
            'id': id
        }), function (response) {
            if (response.data) {
                self.editPart.empty();
                self.templateEdit.tmpl(response.data.part).appendTo('.edit_part');
            } else {
            }
        }, 'json');
        self.editPart.show();
        self.place.hide();
        self.addForm.hide();
    }
    
    this.loadList();
    
    /* Удаление по ИД */
    this.delete = function (id) {
        $.post('index.php?r=project/zakazParts/apiDelete', JSON.stringify({
            'id': id
        }), function (response) {
            if (response.data) {
                self.loadList();
            } else {
            }
        }, 'json');
    }
    
    /* Вызов формы добавления */
    self.form.find('button.add').on('click', function() {
        self.place.hide();
        self.editPart.hide();
        self.addForm.show();
    });
    
    /* Возврат на отбражение списка */
    self.form.find('button.cancel').on('click', function() {
        self.loadList();
    });
    
    /* Бинд на кнопку создания */
    self.form.find('button.create_part').on('click', function() {
        var name = self.createNameInput.val();
        $.post('index.php?r=project/zakazParts/apiCreate', JSON.stringify({
            'orderId': self.orderId,
            'name': name
            
        }), function (response) {
            if (response.data) {
                self.editPartShow(response.data.result);
            } else {
            }
        }, 'json');
    })
    
    /* Бинд кнопок редактирования и удаления */
    this.addActions = function() {
        self.form.find('button.edit').on('click', function() {
                    self.editPartShow($(this).attr('value'));
                });
        self.form.find('button.delete').on('click', function() {
                    self.delete($(this).attr('value'));
                });
    }
    
    
    
    
}
