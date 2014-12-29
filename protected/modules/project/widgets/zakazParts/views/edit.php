<script src="/js/zakaz_parts.js"></script>
<script src="/js/jquery.tmpl.min.js"></script>
<div id="zakaz_parts">
    <!--Тэмплэйт для редактирования файлов частей -->
    <script class="zakazFileTemplate" type="text/x-jquery-tmpl">
        {{each files}}
            <li>
                <a href="/uploads/additions/${part_id}/${file_name}">${orig_name}</a> Комментарий:<input type="text" class="files_comment_${id}" value="${comment}"><button class='save_files_comment' type='submit' value='${id}'>Сохранить</button>
            </li>
        {{/each}}
    </script>
    <!-- Тэмплэйт для отображения частей -->
    <script class="zakazPartTemplate" type="text/x-jquery-tmpl">
        <table style="background-color:lightgrey; font-size: 14px" >
        <tr>
            <td width="100px">
                id: '${id}'
            </td>
            <td width="100px">
                date: '${date}'
            </td>
            <td width="100px">
                title: '${title}'
            </td>
        </tr>
        <tr>
            <td>{{each files}}
                    <a href="/uploads/additions/${part_id}/${file_name}">${orig_name}</a></br>
                {{/each}}
            </td>
            <td>
                comment: '${comment}'
            </td>
            <td>
                author: '${author_id}'
            </td>
        </tr>
        <tr>
            <td>
                <button class='edit' type='submit' value='${id}'>Edit</button>
            </td>
            <td>
                <button class='delete' value='${id}'>Delete</button>
            </td>
            <td>
            </td>
        </tr>
        </table>
    </script>
    <h4>Части</h4>
    <button class="add">Add</button>
    
    <!-- Див для отображения списка частей -->
    <div class="show_parts">
        
    </div>
    <!-- Див для создания части -->
    <div class="add_part">
        <input class="create_part_name" type="text" name="part_title" value=""/> Название</br>
        <button class="create_part">Добавить</button>&nbsp;<button class="cancel">Отмена</button>
    </div>
    <!-- Див для редактирования части -->
    <div class="edit_part">
        <table style="background-color:lightgrey; font-size: 14px" >
        <tr>
            <td width="100px">
                id: <span class='id'>id</span>
            </td>
        </tr>
        
        <tr>
            <td width="100px">
                date: <input class='part_date' type='text' />
            </td>
        </tr>
        <tr>
            <td width="100px">
                title: <input class='part_title' type='text' />
            </td>
        </tr>
        <tr>
            <td>
                <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                    array(
                       'id'=>'EAjaxUpload',
                       'config'=>array(
                            'action'=>$this->createUrl('zakazParts/upload/'),
                            'template'=>'<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                            'debug'=>false,
                            'allowedExtensions'=>array('jpg', 'gif', 'txt', 'doc', 'docx'),
                            'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                            'minSizeLimit'=>10,// minimum file size in bytes
                            'onComplete'=>"js:function(id, fileName, responseJSON){
                                 alert(fileName + ' in ' + id);
                             }"
                        )
                    ));
                ?>
            </td>
        </tr>
        <tr>
            <td>
                comment: <input class='part_comment' type='text' />
            </td>
        </tr>
        <tr>
            <td>
                author: <span class='author'>Author</span>
            </td>
        </tr>
        <tr>
            <td>
                <button class='change_is_showed' type='submit' value=''>Отображать</button>
            </td>
        </tr>
        </table>
	
        <button class="save_changes">Сохранить</button>
        <button class="cancel">Отмена</button>
    </div>
</div>
<!-- Вызов скрипта для обраьртки вьюхи -->
<script type="text/javascript">
    $(document).ready(function () {
        var zakazPartsView = new ZakazPartsView(
            <?php echo $orderId;?>
        );
    });
</script>