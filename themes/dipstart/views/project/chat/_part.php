<div class="panel-group" id="part-block" style="margin-bottom: 15px; position: relative; float: left; width: 100%;">
  <div class="panel panel-default">
    <div class="panel-heading">
       <a data-toggle="collapse" data-parent="#part-block" href="#collapsePart<?php echo $data['id'];?>">
            <div class="col-xs-1"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/check.png" alt=""></div>
            <div class="col-xs-11 part-title"><?php echo CHtml::encode($data['title']);?></div>
            <div class="col-xs-12">Дата сдачи <?php echo CHtml::encode($data['date']);?></div>
       </a>
    </div>
<div>
   <div id="collapsePart<?php echo $data['id'];?>" class="panel-collapse collapse">
      <div class="panel-body">
            <?php
            if (User::model()->isAuthor()) {
                echo '<div class="col-xs-12" style="padding-left: 0; padding-right: 0;">Примечание</div><textarea class="col-xs-12" style="resize: none; margin: 5px 0; padding: 5px 10px;" disabled>'.CHtml::encode($data['comment']).'</textarea>';
            }
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
        echo '</div><div>';
            if (User::model()->isAuthor()) {
                echo '<div class="btn-upload">';
                $this->widget('ext.EAjaxUpload.EAjaxUpload',
                    array(
                        'id' => 'fileUpload' . $data->id,
                        'postParams' => array(
                            'id' => $data->id,
                            'proj_id' => $data->proj_id,
                        ),
                        'config' => array(
                            'action' => $this->createUrl('/project/zakazParts/upload?id='.$data['id']),
                            'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                            'disAllowedExtensions'=>array('exe'),
                            'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                            'minSizeLimit' => 10,// minimum file size in bytes
                            'onComplete' => "js:function(id, fileName, responseJSON){}"
                        )
                    )
                );
                echo '</div>';
            }
            echo '</div>';
        ?>
        </div>
    </div>
  </div>
</div>
