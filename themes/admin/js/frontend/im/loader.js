/*$.im.loader = {
    uploader: null,
    init: function() {
        this.uploader = new plupload.Uploader({
            runtimes : 'html5,html4',
            browse_button : 'upload-im-file',
            container : 'upload-im-file-container',
            max_file_size : '6mb',
            url : '/im/upload',
            multipart_params: {
                id: $('#item_id').val()
            },
            multiple_queues : false,
            filters : [{
                title : "Image files",
                extensions : "jpg,gif,png,jpeg,JPG,GIF,PNG,JPEG,doc,docx,DOC,DOCX"
            }]
        });
        this.uploader.init();
        this.uploader.bind('FilesAdded', function(up, files) {
            up.settings.multipart_params.description = $('.description_part[num="'+$('.bg1').attr('num')+'"]').val();
            up.start();
            up.refresh();
        });

        this.uploader.bind('UploadProgress', function(up, file) {
            $('.im .u-block').removeClass('hidden');
            $('.im .u-progress').css('width', file.percent + "%");
            $('.im .u-progress-text').html(file.percent + "%");
        });

        this.uploader.bind('Error', function(up, err) {
            switch(err.code) {
                case -601:
                    $.unotice('Неверный формат');
                    break;
                    
                case -600:
                    $.unotice('Файл слишком большой (макс. 6мб)');
                    break;
            }
            up.refresh();
        });

        this.uploader.bind('FileUploaded', function(up, file, r) {
            var data = $.parseJSON(r.response);
            if (!data.success){
                $.notice.show('Ошибка', data.error, 'error', true);
            } else {
                var el = $('<span class="file_'+data.id+' mr20px"><input type="button" num="'
                    +data.id+'" class="rm_im_file" value="[ X ]" />'
                    +'<a href="/files/im/'+data.order_id+'/'+
                    data.fileName+'" target="_blank">'+data.name
                    +'</a></span>');
                $('.im_file_list').append(el);
            }
            $('.im .u-progress').css('width', "100%");
            $('.im .u-block').addClass('hidden');
        });
        
        this.getFiles();
    },
    remove: function(id) {
        $.notice.show('Внимание', 'Выполняется удаление файла', 'status');
        $.ajax({
            url: '/im/rmFile',
            type: 'POST',
            data: 'id='+id,
            success: function(data) {
                if(data.success) {
                    $.notice.destroy();
                    $('.file_'+id).remove();
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true)
                }
            }
        });
    },
    getFiles: function() {
        $.ajax({
            url: '/im/fileList',
            type: 'POST',
            data: 'order_id='+$('#item_id').val(),
            success: function(data) {
                if(data.success) {
                    $('.im_file_list').html(null);
                    for(var i = 0; i < data.data.length; i++) {
                        var el = $('<span class="file_'+data.data[i].id+' mr20px"><input type="button" num="'
                            +data.data[i].id+'" class="rm_im_file" value="[ X ]" />'
                            +'<a href="/files/im/'+data.data[i].order_id+'/'+
                            data.data[i].fileName+'" target="_blank">'+data.data[i].name
                            +'</a></span>');
                        $('.im_file_list').append(el);
                    }
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    },
    reInit: function() {
        this.destroy();
        this.init();
    },
    destroy: function() {
        this.uploader.destroy();
    }
}*/