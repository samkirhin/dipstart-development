var ZakazPartsView = function(orderId) {
    var self = this;
    this.form = $('#zakaz_parts');
    this.orderId = orderId;
    this.partId = 0;
    this.filename;
    
    /* Привязка имен */
    this.place = this.form.find('.show_parts');
    this.template = this.form.find('.zakazPartTemplate');
    this.fileTemplate = this.form.find('.zakazFileTemplate');
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
                self.editPart.find('.qq-upload-list').empty();
                self.partId = response.data.part.id;
                self.editPart.find('span.id').text(response.data.part.id);
                self.editPart.find('span.author').text(response.data.part.author_id);
                self.editPart.find('input.part_title').val(response.data.part.title);
                self.editPart.find('input.part_date').val(response.data.part.date);
                self.editPart.find('input.part_comment').val(response.data.part.comment);
                if (response.data.part.show == 1) {
                    var but = self.editPart.find('.change_is_showed');
                    but.attr('value', response.data.part.id);
                    but.text('Не отображать');
                } else {
                    var but = self.editPart.find('.change_is_showed');
                    but.attr('value', response.data.part.id);
                    but.text('Отображать');
                }
                self.editPart.find('button.change_is_showed').on('click', function() {
                    self.change_isshowed($(this).attr('value'));
                });
                self.fileTemplate.tmpl(response.data).appendTo('ul.qq-upload-list');
                self.editPart.find('button.save_files_comment').on('click', function() {
                    self.editFilesComment($(this).attr('value'));
                });
                self.editPart.find('button.delete_file').on('click', function() {
                    self.deleteFile($(this).attr('value'));
                });
            } else {
            }
        }, 'json');
        self.editPart.show();
        self.place.hide();
        self.addForm.hide();
    }
    
    this.editFilesComment = function(id) {
        var comment = self.editPart.find('.files_comment_'+id).val();
        $.post('index.php?r=project/zakazParts/apiEditFilesComment', JSON.stringify({
            'id': id,
            'comment': comment
        }), function (response) {
            if (response.data) {
                self.editPartShow(response.data.id);
            }
        }, 'json');
    }
    
    this.change_isshowed = function(id) {
        $.post('index.php?r=project/zakazParts/apiChangeIsShowed', JSON.stringify({
            'id': id
        }), function (response) {
            if (response.data) {
                self.editPartShow(id);
            }
        }, 'json');
    }
    
    self.form.find('button.save_changes').on('click', function() {
        var title = self.editPart.find('input.part_title').val();
        var date = self.editPart.find('input.part_date').val();
        var comment = self.editPart.find('input.part_comment').val();
        var files = new Array();
        var test = self.editPart.find('.qq-upload-file');
        test.each(function(i){
           files.push($(this).text()); 
        });
        $.post('index.php?r=project/zakazParts/apiEditPart', JSON.stringify({
            'id': self.partId,
            'title': title,
            'date': date,
            'comment': comment,
            'files': files
        }), function (response) {
            if (response.data.result) {
                self.editPart.find('.qq-upload-list').empty();
                self.loadList();
            } else {
                self.partId = response.data.part.id;
                self.editPart.find('span.id').text(response.data.part.id);
                self.editPart.find('span.author').text(response.data.part.author_id);
                self.editPart.find('input.part_title').val(response.data.part.title);
                self.editPart.find('input.part_date').val(response.data.part.date);
                self.editPart.find('input.part_comment').val(response.data.part.comment);
            }
        }, 'json');
        
    });
    
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
