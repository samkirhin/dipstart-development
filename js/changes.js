var ChangesController = function (projectId, isEdited) {

    var self = this;
    var containerError = 'div#errors-block';
    var changeForm = $('form#project-changes-form');
    var containerListChanges = $('div#list-changes-block');
    var deleteButtons = 'div.delete-changes-button';
    var editButtons = 'div.edit-changes-button';
    var urlDeleteChanges = '/index.php?r=project/changes/delete';
    var urlEditChanges = '/index.php?r=project/changes/edit';
    var urlAddChanges = '/index.php?r=project/changes/add&ctr=' + projectId;
    var urlUpdateList = '/index.php?r=project/changes/list';
    var urlItemChanges = '/index.php?r=project/changes/item';
    var selectedClass = 'select-edit-changes';
    var idCancelButtonHtml = 'edit-changes-button-form';
    var cancelButtonHtml = '<input type="button" value="Отмена" id="' + idCancelButtonHtml + '">';

    this.init = function () {
        self.initHandlers();
        self.updateList();
        self.resetChangesForm();
    };

    this.updateList = function () {
        $.ajax({
            url: urlUpdateList + '&project=' + projectId,
            dataType: 'json',
            success: function (data) {
                if ("data" in data) {
                    var result = '';
                    forEach(data['data'], function (key, el) {
                        //TODO добавить поле одбрения
                        var crudButton = "";
                        if (isEdited == 1) {
                            crudButton = '<div class="changes-crud-block"><div class="changes-button delete-changes-button"><i class="glyphicon-remove glyphicon"></i></div>'
                            + '<div class="changes-button edit-changes-button"><i class="glyphicon-edit glyphicon"></i></div></div>';
                        }
                        result = result +
                        '<div class="changes-item"><div id="changes-' + el['id'] + '"><div class="changes-info"><a href="' + el['file'] + '">' + el['filename'] + '</a>' +
                        '<p>' + el['comment'] + '</p></div>' + crudButton + '</div></div>';
                    });

                    $(containerListChanges).html(result);
                    self.deleteButtonClickHandler();
                    self.editButtonClickHandler();


                }
            }

        });

    };


    this.editButtonClickHandler = function () {
        $(editButtons).click(self.clickEditChangesButton);
    };

    this.cancelButtonClickHandler = function () {
        $('#' + idCancelButtonHtml).click(self.resetChangesForm);
    };

    this.resetChangesForm = function () {
        changeForm.attr('action', urlAddChanges).removeClass(selectedClass)
            .find('input[type=submit]').attr('value', 'Добавить');
        changeForm.find("input[type=text],input[type=file],textarea").val('');
        $('#' + idCancelButtonHtml).remove();
        changeForm.parent().parent().find('div.changes-info').removeClass(selectedClass);
    };

    this.clickEditChangesButton = function () {

        var currentElement = $(this);
        self.resetChangesForm();
        var containerCurrentElement = currentElement.parent().parent();


        var changesId = containerCurrentElement.attr('id').split('-');

        $.ajax({
            url: urlItemChanges + '&id=' + changesId[1],
            dataType: 'json',
            success: function (data) {
                if ("data" in data) {
                    changeForm.attr('action', urlEditChanges + '&id=' + changesId[1]);
                    changeForm.find('textarea').val(data['data']['comment']);
                    changeForm.find('input[type=file]').val('');
                    changeForm.find('select').val(data['data']['moderate']);
                    containerCurrentElement.find('.changes-info').addClass(selectedClass);
                    changeForm.addClass(selectedClass);
                    changeForm.find('div.buttons input:last').after(cancelButtonHtml);
                    self.cancelButtonClickHandler();
                }
            }

        });
    };

    this.sendRequestEditChanges = function () {
        var curentElement = $(this);
        var changesId = curentElement.parent().parent().attr('id').split('-');
        var isConfirm = window.confirm('Вы действительно хотите изменить эту доработку?');
        if (isConfirm) {
            $.ajax({
                url: urlEditChanges + '&id=' + changesId[1],
                type: 'post',
                dataType: 'json',
                data: curentElement.parent('form').serialize(),
                success: function (data) {
                    if ("success" in data) {
                        self.updateList();
                    }
                }

            });
        }
    };
    this.deleteButtonClickHandler = function () {
        $(deleteButtons).click(self.sendRequestDeleteChanges);
    };

    this.sendRequestDeleteChanges = function () {
        var curentElement = $(this);
        var changesId = curentElement.parent().parent().attr('id').split('-');

        var isConfirm = window.confirm('Вы действительно хотите удалить эту доработку?');
        if (isConfirm) {
            $.ajax({
                url: urlDeleteChanges + '&id=' + changesId[1],
                type: 'post',
                dataType: 'json',
                data: {id: changesId[1], ajax: true},
                success: function (data) {
                    if ("success" in data) {
                        curentElement.parent().parent().remove();
                    }
                }

            });
        }

    };

    this.initHandlers = function () {
        changeForm.submit(function () {
            changeForm.ajaxForm().ajaxSubmit({
                url: changeForm.attr('action'),
                dataType: 'json',
                type: 'post',
                success: function (data) {
                    if ("error" in data) {
                        var result = '';
                        forEach(data['error'], function (key, el) {
                            result = result + '<p>' + el[0] + '</p>';
                        });
                        $(containerError).html(result).addClass('errorSummary');

                        changeForm.addClass(selectedClass);
                    } else if ("success" in data) {
                        $(containerError).removeClass('errorSummary').html('');
                        self.resetChangesForm();
                        self.updateList();
                    }
                }
            });
            return false;
        });

    };
};


function forEach(data, callback) {
    for (var key in data) {
        if (data.hasOwnProperty(key)) {
            callback(key, data[key]);

        }

    }

}
