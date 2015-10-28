<tr>
    <?php
	die();
    foreach ($data as $k=>$v) {
        if ($k=='file') {
            echo '<td>';
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>new CActiveDataProvider('ZakazPartsFiles', array(
                    'criteria'=>array(
                        'condition'=>'part_id='.$data->id,
                        ),
                    )),
                'itemView'=>'_files',
                'enablePagination'=>false,
                'summaryCssClass'=>'hidden',
            ));
            echo '</td>';
        } else if (User::model()->isAuthor()) echo '<td>'.CHtml::encode($v).'</td>';
    }
    if (User::model()->isAuthor()) {
        echo '<td>' . CHtml::encode($data->author->username) . '</td><td>';
        $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id' => 'fileUpload' . $data->id,
                'postParams' => array(
                    'id' => $data->id,
                    'proj_id' => $data->proj_id,
                ),
                'config' => array(
                    'action' => $this->createUrl('zakazParts/upload/'),
                    'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>'. ProjectModule::t('Drop files here to upload') .'</span></div><div class="qq-upload-button">'. ProjectModule::t('Upload a file').'</div><ul class="qq-upload-list"></ul></div>',
                    'debug' => false,
                    'allowedExtensions' => array('jpg', 'gif', 'txt', 'doc', 'docx'),
                    'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                    'minSizeLimit' => 10,// minimum file size in bytes
                    'onComplete' => "js:function(id, fileName, responseJSON){
                                         alert(fileName + ' in ' + id);
                                     }"
                )
            )
        );
    }
    echo '</td>';
?>
</tr>
