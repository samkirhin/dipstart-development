<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 05.05.15
 * Time: 15:55
 */
?>

<div class="row zero-edge" style="margin-top:10px;">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="partStatus"></div>
                <div class="title-name">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapseOne<?php echo $data['id']; ?>" id="part_title_<?php echo $data['id']; ?>">
                            <?php echo $data['title']; ?>
                        </a>
                    </h4>
                </div>
                <div class="title-time">
                    <?php
                    $url=Yii::app()->createUrl('/project/zakazParts/apiEditPart');
                    $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                        'model' => ZakazParts::model()->findByPk($data['id']),
                        'id'=>'partDate'.$data['id'],
                        'attribute' => 'dbdate',
                        'options'=>array(
                            'onSelect'=> "js:function(dateText,inst){
                                jQuery.post('$url',JSON.stringify({dbdate:dateText,id:$(this).attr('id').substr(8)}));
                            }",
                        ),
                    ));
                    ?>
                </div>
            </div>
            <div id="collapseOne<?php echo $data['id']; ?>" class="panel-collapse collapse">
                <div class="panel-body">

                    <p>
                        <input type="text" value="<?php echo $data['title']; ?>"
                               onkeyup="change_title(this.value,<?php echo $data['id']; ?>);"/>
                        <textarea onkeyup="change_comment(this.value,<?php echo $data['id']; ?>);" class="col-xs-12"><?php echo $data['comment']; ?></textarea>

                    <div class="part_files">
                        <?php foreach ($data['files'] as $k => $v){
                            echo '<div class="row"><a href="' . $v['file_name'] . '" id="parts_file" data-part="' . $data['id'] . '">' . $v['orig_name'] . '</a>';
                            if ($v['id']==0)
                                echo '<button id="approve_file" data-id="' . $data['id'] . '" data-orig_name="' . $v['orig_name'] . '" class="right btn" onclick="approve(this)">Approve</button>';
                            echo '</div>';
                        } ?>
                    </div>
                        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                            array(
                                'id' => 'EAjaxUpload'.$data['id'],
                                'config' => array(
                                    'action' => Yii::app()->createUrl('/project/zakazParts/upload?id='.$data['id']),
                                    'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                                    'disAllowedExtensions' => array('exe'),
                                    'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                                    'minSizeLimit' => 10,// minimum file size in bytes
                                    'onComplete' => "js:function(id, fileName, responseJSON){}"
                                )
                            )
                        ); ?>
                        <div class="col-xs-12 btn btn-primary deletePart"
                             onclick="delete_part(<?php echo $data['id']; ?>);">Удалить часть
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
