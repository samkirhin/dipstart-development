<?php

/*$js = <<<JS



JS;

Yii::app()->clientScript->registerScript('loading', $js, CClientScript::POS_READY); 
*/
?>

<div class="row zero-edge">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="partStatus">
					<div class="partStatus-header">
                        <?=ProjectModule::t('Status')?>:
                        <?php if ($this->hints['Zakaz_part_status']) { ?>
                        <div class="hint-block __part_status">
                            ?
                            <div class="hint-block_content">
                                <?=$this->hints['Zakaz_part_status']?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
					<div class="partStatus-status"><?= $this->select; ?></div>
				</div>	
				<div class="partStatus-bottom"></div>
                <div class="title-name">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapseOne<?php echo $data['id']; ?>" id="part_title_<?php echo $data['id']; ?>">
                            <?=$data['title'];?>
                        </a>
                        <?php if ($this->hints['Zakaz_part_title']) { ?>
                        <div class="hint-block __part_title">
                            ?
                            <div class="hint-block_content">
                                <?=$this->hints['Zakaz_part_title']?>
                            </div>
                        </div>
                        <?php } ?>
                    </h4>
                </div>
                <div class="title-time">
                    <?php if ($this->hints['Zakaz_part_time']) { ?>
                    <div class="hint-block __part_time">
                        ?
                        <div class="hint-block_content">
                            <?=$this->hints['Zakaz_part_time']?>
                        </div>
                    </div>
                    <?php } ?>
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
            <div id="collapseOne<?=$data['id'];?>" class="panel-collapse collapse">
                <div class="panel-body">

                    <p>
                        <input type="text" value="<?php echo $data['title']; ?>" onkeyup="change_title(this.value,<?php echo $data['id']; ?>);"/>
                        <textarea onkeyup="change_comment(this.value,<?php echo $data['id']; ?>);" class="col-xs-12"><?php echo $data['comment']; ?></textarea>

                        <?php 
						$tmp = '';
						foreach ($data['files'] as $k => $v){
                            $tmp .= '<li><a target="_blank" href="'.ZakazPartsFiles::model()->folder(). $v['part_id'] . '/' . $v['file_name'] . '" id="parts_file">' . $v['orig_name'] . '</a>';
                            $tmp .= '<button class="zakaz_part_approve_file on right btn'.(($v['approved'])?' hidden':'').'" ';
							$tmp .= 'data-id="'.$v['id'].'" ';
                            $tmp .= ' onclick="stageFileApprove(this)">'.ProjectModule::t('Approve').'</button>';
                            $tmp .= '<button class="zakaz_part_approve_file off right btn'.(!($v['approved'])?' hidden':'').'" ';
							$tmp .= 'data-id="'.$v['id'].'" ';
                            $tmp .= ' onclick="stageFileApprove(this)">'. Yii::t('site', 'Reset') .'</button>';
                            $tmp .= '<span class="deletefile" style="color: #FF0000; display: inline; right: -10px; top: 10px; cursor: pointer;" id="'.$v['id'].'">x</span></li>';
                        }

                        $this->widget('ext.EAjaxUpload.EAjaxUpload',
                            array(
                                'id' => 'EAjaxUpload'.$data['id'],
                                'config' => array(
                                    'action' => Yii::app()->createUrl('/project/zakazParts/upload?id='.$data['id']),
                                    'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><ul class="qq-upload-list">'.$tmp.'</ul><span>'. Yii::t('site', 'Drag and drop files here') .'</span><div class="qq-upload-button">'. Yii::t('site', 'Upload file'). '</div></div></div>',
                                    'disAllowedExtensions' => array('exe','scr'),
                                    'sizeLimit' => Tools::maxFileSize(), //200 * 1024 * 1024,// maximum file size in bytes
                                    'minSizeLimit' => 1,// minimum file size in bytes
                                    'onComplete' => "js:function(id, fileName, responseJSON){
                                        $('.qq-upload-list').append(responseJSON.data.html);
                                    }"
                                )
                            )
                        ); ?>
                        
                        <!--Удаление отдельно взятого блока задания-->
                        <div class="col-xs-12 btn btn-primary deletePart"
                             onclick="delete_part(<?php echo $data['id']; ?>);"> <?=Yii::t('site', 'Remove part')?>
                            <?php if ($this->hints['Zakaz_part_delete']) { ?>
                            <div class="hint-block __part_delete">
                                ?
                                <div class="hint-block_content">
                                    <?=$this->hints['Zakaz_part_delete']?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
