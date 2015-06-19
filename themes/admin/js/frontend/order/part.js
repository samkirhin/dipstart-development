$(function(){
    $('.br3').each(function(){
        if(!$(this).val().length) {
            $(this).val('Не заполнено');
        }
    });
    $('.br3').click(function(){
        if($(this).val() == 'Не заполнено') {
            $(this).val(null);
        }
    });
    $('.br3').blur(function(){
        if(!$(this).val().length) {
            $(this).val('Не заполнено');
        }
    });
    
    $('.performanceTerm_time').mask('99:99');
    $('body').on('click', '.part-save', function(){
        $.notice.show('Внимание', 'Выполняется сохранение информации', 'status', false);
        var row = $(this);
        $.ajax({
            url: '/order/partSave',
            type: 'POST',
            data: 'id='+row.attr('data')+'&payAuthor='+$('.payAuthor[data="'+row.attr('data')+'"]').val()
            +'&performanceTerm_date='+$('.performanceTerm_date[data="'+row.attr('data')+'"]').val()
            +'&performanceTerm_time='+$('.performanceTerm_time[data="'+row.attr('data')+'"]').val()
            +'&partName='+$('.partName[data="'+row.attr('data')+'"]').val(),
            success: function(data) {
                if(data.success) {
                    $.notice.destroy();
                    $('.txt_payAuthor[data="'+row.attr('data')+'"]').html(data.payAuthor);
                    $('.payAuthor[data="'+row.attr('data')+'"]').val(0);
                    $('div.part-name[data="'+row.attr('data')+'"]').html(data.partName);
                    $('input.part-name[data="'+row.attr('data')+'"]').val(data.partName);
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    });
    $('body').on('click', '.part-rm', function(e){
        e.preventDefault();
        if(confirm('Вы действительно хотите удалить часть?')) {
            $.notice.show('Внимание', 'Выполняется удаление части', 'status', false);
            var row = $(this);
            $.ajax({
                url: '/order/removePart',
                type: 'POST',
                data: 'id='+row.attr('data'),
                success: function(data) {
                    if(data.success) {
                        $('.part[data="'+row.attr('data')+'"]').remove();
                        $.notice.destroy();
                    } else {
                        $.notice.show('Ошибка', data.error, 'error', true);
                    }
                }
            });
        } else {
            return false;
        }
    });
    
    /*if(!!document.getElementById('check-upload')) {
        checkLoader.init();
        
        $('.check-upload').on('click', function(e){
            e.preventDefault();
            $('#check-upload-container').find('input').click();
        });
    }*/
    
    if(!!document.getElementById('upload-order-file')) {
        orderLoader.init();
        
        $('body').on('click', '.upload-order-file', function(e){
            e.preventDefault();
            $('#upload-order-file-container').find('input').click();
        });
    }
    
    if(!!document.getElementById('upload-part-file')) {
        fileLoader.init();
        
        $('body').on('click', '.upload-part-file', function(e){
            e.preventDefault();
            $('#upload-part-file-container').find('input').click();
        });
    }
    
    $('body').on('click', '.rm_part_file', function(e){
        e.preventDefault();
        if(confirm('Вы действительно хотите удалить файл?')) {
            $.notice.show('Внимание', 'Выполняется удаление файла', 'status', false);
            var row = $(this);
            $.ajax({
                url: '/order/rmFile',
                type: 'POST',
                data: 'id='+row.attr('data'),
                success: function(data) {
                    if(data.success) {
                        $.notice.destroy();
                        $('.file_'+row.attr('data')).remove();
                    } else {
                        $.notice.show('Ошибка', data.error, 'error', true);
                    }
                }
            });
        } else {
            return false;
        }
    });
    
    $('body').on('click', '.approve_part_file', function(e){
        e.preventDefault();
        $.notice.show('Внимание', 'Выполняется подтверждение файла', 'status', false);
        var row = $(this);
        $.ajax({
            url: '/order/fileApprove',
            type: 'POST',
            data: 'id='+row.attr('data'),
            success: function(data) {
                if(data.success) {
                    $.notice.destroy();
                    $('.file_'+row.attr('data')).css('background', (data.approved ? 'green' : '#B6494C'));
                } else {
                    $.notice.show('Ошибка', data.error, 'error', true);
                }
            }
        });
    });
    $('body').on('click', '.part_file_uniq', function(){
        var el = $('<input>', {
            'value': $(this).text(),
            'data-id': $(this).data('id'),
            'style': 'width: 15px;',
            'class': 'part_file_uniq_inp'
        });
        $(this).parent('td').prepend(el);
        $(this).remove();
        $('.part_file_uniq_inp[data-id="'+$(this).data('id')+'"]').focus();
    });
    
    $('body').on('click', function(e) {
        if(!$(e.target).hasClass('part_file_uniq_inp') && !$(e.target).hasClass('part_file_uniq')) {
            var row = $('.part_file_uniq_inp');
            if(row.data('id')) {
                var el = $('<span>', {
                    'class': 'part_file_uniq',
                    'data-id': row.data('id'),
                    'text': row.val()
                });
                $.ajax({
                    url: '/order/setFileUniq',
                    type: 'POST',
                    data: 'id='+row.data('id')+'&uniq='+row.val(),
                    success: function(data) {
                        if(data.success) {
                            var c_row = $('tr.file_'+el.data('id')).find('td input');
                            var container = c_row.parent('td');
                            c_row.remove();
                            container.prepend(el);
                        } else {
                            $.notice.show('Ошибка', data.error, 'error', true);
                        }
                    }
                });
            }
        }
    });
    
    $('body').on('click', '.rm_order_file', function(e){
        e.preventDefault();
        if(confirm('Вы действительно хотите удалить файл?')) {
            $.notice.show('Внимание', 'Выполняется удаление файла', 'status', false);
            var row = $(this);
            $.ajax({
                url: '/order/rmOrderFile',
                type: 'POST',
                data: 'id='+row.attr('num'),
                success: function(data) {
                    if(data.success) {
                        $.notice.destroy();
                        $('.order_file_'+row.attr('num')).remove();
                    } else {
                        $.notice.show('Ошибка', data.error, 'error', true);
                    }
                }
            });
        } else {
            return false;
        }
    });
    initCalendar();
    $('.add-part').click(function(){
        $.notice.show('Внимание', 'Выполняется добавление части', 'status', false);
        $.ajax({
            url: '/order/createPart',
            type: 'POST',
            data: 'id='+$('#item_id').val(),
            success: function(data) {
                if(!data.success) {
                    $.notice.show('Ошибка', data.error, 'error', true);
                } else {
                    var el = $('.hidden#dd_tpl');
                    el.find('.part.minimized, .part.full').attr('data', data.id);
                    el.find('.part-btn').attr('data', data.id);
                    el.find('.performanceTerm_time').attr('data', data.id);
                    el.find('.performanceTerm_date').attr('data', data.id);
                    el.find('.performanceTerm_date').removeClass('hasDatepicker');
                    el.find('.performanceTerm_date').removeAttr('id');
                    el.find('div.part-name').attr('data', data.id).html(data.partName);
                    el.find('input.part-name').attr('data', data.id).attr('value', data.partName); //because, val is not work
                    el.find('.payAuthor').attr('data', data.id);
                    el.find('.txt_payAuthor').attr('data', data.id);
                    el.find('.part-rm').attr('data', data.id);
                    el.find('.part-save').attr('data', data.id);
                    el.find('.file_table').attr('data', data.id);
                    el.find('.author-mail').html(data.author_email);
                    $('.parts-data').prepend(el.html());
                    $('.part:first .part-btn').click();
                    $.notice.destroy();
                    initCalendar();
                    $('.performanceTerm_time[data="'+data.id+'"]').mask('99:99');
                }
            }
        });
        
    });
    
    $('.n-btn').click(function(){
        $('.n-btn').removeClass('active');
        $('.na-ta').not('.hidden').addClass('hidden');
        $('.na-'+$(this).attr('type')).removeClass('hidden');
        $(this).addClass('active');
    });
    
    $('.np-btn').click(function(){
        $('.np-btn[num="'+$(this).attr('num')+'"]').removeClass('bordered');
        $('.np-btn[num="'+$(this).attr('num')+'"]').removeClass('bordered-tab');
        $('.np-btn[num="'+$(this).attr('num')+'"]').removeClass('br3');
        $('.np-btn[num="'+$(this).attr('num')+'"]').removeClass('pl5');
        $('.np-btn[num="'+$(this).attr('num')+'"]').removeClass('pr5');
        $('.np-btn[num="'+$(this).attr('num')+'"]').removeClass('pt5');
        $('.na-p-ta[num="'+$(this).attr('num')+'"]').not('.hidden').addClass('hidden');
        $('.na-p-'+$(this).attr('type')+'[num="'+$(this).attr('num')+'"]').removeClass('hidden');
        $(this).addClass('bordered');
        $(this).addClass('bordered-tab');
        $(this).addClass('br3');
        $(this).addClass('pl5');
        $(this).addClass('pr5');
        $(this).addClass('pt5');
    });
    
    $('.info-btn').click(function(){
        if($(this).data('open')) {
            $('.opened-info').slideDown();
            $('.hidden-info').hide();
        } else {
            $('.opened-info').slideUp(function(){
                $('.hidden-info').show();
            });
        }
    });
    
    $('body').on('click', '.part .part-btn', function(){
        if($(this).children('span').hasClass('icon-plus')) {
            $('.part.minimized').show();
            $('.part.full').hide();
            $('.part.minimized[data="'+$(this).attr('data')+'"]').hide();
            $('.part.full[data="'+$(this).attr('data')+'"]').slideDown();
            $('#actived-part').attr('value', $(this).attr('data'));
        } else {
            $('.part.minimized[data="'+$(this).attr('data')+'"]').show();
            $('.part.full[data="'+$(this).attr('data')+'"]').slideUp();
        }
    });
    
    $('.part:first .part-btn').click();

    $( '.viewAllChecks' ).on( 'click' , function() {
        $( '.allChecks' ).toggleClass( 'hidden' );
    } );

    $( '.getNote > span' ).on( 'click' , function() {
        var note = $( this ).parents( '.getNote' );
        $( '.viewNote' ).addClass( 'hidden' );
        note.find( '.viewNote' ).removeClass( 'hidden' );
        note.find( '.text .edit' ).addClass( 'hidden' );
        note.find( '.text .view' ).addClass( 'hidden' );
        note.find( '.actions .edit' ).addClass( 'hidden' );
        note.find( '.actions .save' ).addClass( 'hidden' );
        if( note.find( '.text .view' ).text().length == 0 )    {
            note.find( '.text .edit' ).removeClass( 'hidden' );
            note.find( '.actions .saveDescription' ).removeClass( 'hidden' );
            return;
        }
        note.find( '.text .view' ).removeClass( 'hidden' );
        note.find( '.actions .edit' ).removeClass( 'hidden' );
    } );

    $( '.getNote .actions .edit' ).on( 'click' , function() {
        var note = $( this ).parents( '.getNote' );
        note.find( '.text .view' ).addClass( 'hidden' );
        note.find( '.actions .edit' ).addClass( 'hidden' );
        note.find( '.text .edit' ).removeClass( 'hidden' );
        note.find( '.actions .saveDescription' ).removeClass( 'hidden' );
    } );

    $( '.getNote .close' ).on( 'click' , function() {
        var note = $( this ).parents( '.viewNote' );
        note.addClass( 'hidden' );
        note.find( '.text .view' ).addClass( 'hidden' );
        note.find( '.actions .edit' ).addClass( 'hidden' );
        note.find( '.text .edit' ).addClass( 'hidden' );
        note.find( '.actions .saveDescription' ).addClass( 'hidden' );
    } );

    $( '.saveDescription' ).on( 'click' , function() {
        var note = $( this ).parents( '.viewNote' );
        if( note.find( '.text .view' ).text() != note.find( '.text .edit textarea' ).val() )  {
            $.ajax( {
                url: '/order/savePartFileDescription'
                , 
                type: 'POST'
                , 
                data: {
                    id : $( this ).data('id') , 
                    description : note.find( '.text .edit textarea' ).val()
                }
                , 
                success: function( response ) {
                    if( ! response ) {
                        return;
                    }
                }
            } );
        }

        $( note ).addClass( 'hidden' );
        $( note ).find( '.text .view' ).addClass( 'hidden' );
        $( note ).find( '.actions .edit' ).addClass( 'hidden' );
        $( note ).find( '.text .edit' ).addClass( 'hidden' );
        $( note ).find( '.actions .saveDescription' ).addClass( 'hidden' );
    } );
});

$( document ).click( function( e ) {
    if( $(e.target).closest( '.viewNote , .getNote' ).length ) {
        console.log( $( e.target ) );
        return false;
    }
    $( '.viewNote' ).addClass('hidden');
} );


/*checkLoader = {
    uploader: null,
    init : function() { 
        this.uploader = new plupload.Uploader({
            runtimes : 'html5,html4',
            browse_button : 'check-upload',
            container : 'check-upload-container',
            max_file_size : '6mb',
            url : '/order/checkUpload',
            multipart_params: {
                id: $('#item_id').val(),
                part: $('#actived-part').val(),
                currency: $('.currency[num="'+$('#actived-part').val()+'"]').val()
            },
            multiple_queues : false,
            filters : [{
                title : "Image files",
                extensions : "jpg,gif,png,jpeg,JPG,GIF,PNG,JPEG,doc,docx,DOC,DOCX"
            }]
        });
        this.uploader.init();
        this.uploader.bind('FilesAdded', function(up, files) {
            up.settings.multipart_params.part = $('#actived-part').val();
            up.settings.multipart_params.currency = $('.currency[num="'+$('#actived-part').val()+'"]').val();
            up.start();
            up.refresh();
        });

        this.uploader.bind('UploadProgress', function(up, file) {
            $('.check .u-block').removeClass('hidden');
            $('.check .u-progress').css('width', file.percent + "%");
            $('.check .u-progress-text').html(file.percent + "%");
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
                var el = $('<li class="file_'+data.id+'">'
                    +'<a href="/files/order_part/'+data.part_id+'/'+
                    data.fileName+'" target="_blank">Файл</a>'
                    +'<a href="#" num="'+data.id+'" class="rm_part_file" cl="check_table" n="'+data.part_id+'">'
                    +'<img src="/images/frontend/delete_icon.png" alt="Удалить" title="Удалить" /></a></li>');
                $('.check_files[num="'+data.part_id+'"]').append(el);
            }
            $('.check .u-progress').css('width', "100%");
            $('.check .u-block').addClass('hidden');
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
fileLoader = {
    uploader: null,
    init: function() {
        this.uploader = new plupload.Uploader({
            runtimes : 'html5,html4',
            browse_button : 'upload-part-file',
            container : 'upload-part-file-container',
            max_file_size : '6mb',
            url : '/order/fileUpload',
            multipart_params: {
                id: $('#item_id').val(),
                part: $('#actived-part').val()
            },
            multiple_queues : false,
            filters : [{
                title : "Image files",
                extensions : "jpg,gif,png,jpeg,JPG,GIF,PNG,JPEG,doc,docx,DOC,DOCX"
            }]
        });
        this.uploader.init();
        this.uploader.bind('FilesAdded', function(up, files) {
            up.settings.multipart_params.part = $('#actived-part').val();
            up.start();
            up.refresh();
        });

        this.uploader.bind('UploadProgress', function(up, file) {
            $('.body').removeClass('hidden');
            $('.body .u-progress').css('width', file.percent + "%");
            $('.body .u-progress-text').html(file.percent + "%");
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
                if(data.userType == 215) {
                var el = $('<tr class="file_'+data.id+'" style="background: '+(!data.approved ? '#B6494C' : 'green')+';"><td>'
                    +'<a href="/files/order_part/'+data.part_id+'/'+data.fileName+'" target="_blank">'+data.name+'</a>'
                    +'<a href="#" class="approve_part_file" data="'+data.id+'">П</a> | '
                    +'<a href="#" class="rm_part_file" data="'+data.id+'">'
                    +'<img src="/images/frontend/delete_icon.png" alt="удалить" title="Удалить файл"></a>'
                    +'</td><td><span class="part_file_uniq" data-id="'+data.id+'">0</span>%</td></tr>');
                } else {
                var el = $('<tr class="file_'+data.id+'" style="background: '+(!data.approved ? '#B6494C' : 'green')+';"><td>'
                    +'<a href="/files/order_part/'+data.part_id+'/'+data.fileName+'" target="_blank">'+data.name+'</a>'
                    +'</td><td><span class="part_file_unique" data-id="'+data.id+'">0</span>%</td></tr>');
                }
                $('.file_table[data="'+data.part_id+'"]').append(el);
            }
            $('.body .u-progress').css('width', "100%");
            $('.body').addClass('hidden');
        });
    },
    reInit: function() {
        this.destroy();
        this.init();
    },
    destroy: function() {
        this.uploader.destroy();
    }
}
orderLoader = {
    uploader: null,
    init: function() {
        this.uploader = new plupload.Uploader({
            runtimes : 'html5,html4',
            browse_button : 'upload-order-file',
            container : 'upload-order-file-container',
            max_file_size : '6mb',
            url : '/order/orderFileUpload',
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
        this.uploader.bind('FilesAdded', function(up) {
            up.start();
            up.refresh();
        });

        this.uploader.bind('UploadProgress', function(up, file) {
            $('.body').removeClass('hidden');
            $('.body .u-progress').css('width', file.percent + "%");
            $('.body .u-progress-text').html(file.percent + "%");
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
                var el = $('<li class="order_file_'+data.id+'"><span class="bordered bordered-tab pull-left pt5 pb5 pr5 ml15 mr5">'
                    +'<span class="icon icon-file pull-left"></span><span><a href="/files/order/'
                    +data.order_id+'/'+data.fileName+'" target="_blnak">'+data.name+'</a></span></span>'
                    +'<a href="#" class="rm_order_file" num="'+data.id
                    +'"><img title="Удалить файл" alt="удалить" src="/images/frontend/delete_icon.png"></a>'
                    +'</li>');
                $('.order-files').append(el);
                $('.order-files').removeClass('hidden');
            }
            $('.body .u-progress').css('width', "100%");
            $('.body').addClass('hidden');
        });
    },
    reInit: function() {
        this.destroy();
        this.init();
    },
    destroy: function() {
        this.uploader.destroy();
    }
}

function initCalendar() {
    if($('.performanceTerm_date').length) {
        $('.performanceTerm_date').datepicker({
            dateFormat: 'dd.mm.yy'
        });
    }
}