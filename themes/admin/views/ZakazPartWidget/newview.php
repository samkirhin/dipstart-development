<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 05.05.15
 * Time: 15:55
 */

$js = <<<JS

    $(document).on("click", 'li span.deletefile', function(e) {
        
        var item = $(this).parent();
        
        var id = parseInt($(this).attr('id'));
        var file_name = $(this).attr('file_name');

        if(!isNaN(id) && file_name.toString().length>0) {
            $.ajax({
              type: "POST",
              url:'http://'+document.domain+'/project/zakaz/deleteFile',
              data : 'id='+id+'&file_name='+file_name,
              success: function(html) {
              	 if(html == 'true') {
              	     item.fadeOut(400,function(){
              	         item.remove();
              	     });
              	 }
              }
        		});
        
        }
      
    });

JS;

Yii::app()->clientScript->registerScript('loading', $js, CClientScript::POS_READY); 

?>

<div class="row zero-edge">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="partStatus">
					<div class="partStatus-header">Статус:</div>
					<div class="partStatus-status"><?= $this->select; ?></div>
				</div>	
				<div class="partStatus-bottom"></div>
                <div class="title-name">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapseOne<?php echo $data['id']; ?>" id="part_title_<?php echo $data['id']; ?>">
                            <?=$data['title'];?>
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
            <div id="collapseOne<?=$data['id'];?>" class="panel-collapse collapse">
                <div class="panel-body">

                    <p>
                        <input type="text" value="<?php echo $data['title']; ?>" onkeyup="change_title(this.value,<?php echo $data['id']; ?>);"/>
                        <textarea onkeyup="change_comment(this.value,<?php echo $data['id']; ?>);" class="col-xs-12"><?php echo $data['comment']; ?></textarea>

                        <?php 
						$tmp = '';
						foreach ($data['files'] as $k => $v){
						                /*print '<pre>';
                            print_r ($v);
                            print '</pre>';
                            die;*/
              
              
                            $tmp .= '<li><a href="' . $v['file_name'] . '" id="parts_file">' . $v['orig_name'] . '</a>';
                            $tmp .= '<button class="zakaz_part_approve_file on right btn'.(!isset($v['for_approved'])?' hidden':'').'" ';
                            foreach ($v as $kk => $vv)
                                $tmp .= 'data-'.$kk.'="'.$vv.'" ';
                            $tmp .= ' onclick="approve(this)">Одобрить</button>';
                            $tmp .= '<button class="zakaz_part_approve_file off right btn'.(isset($v['for_approved'])?' hidden':'').'" ';
                            foreach ($v as $kk => $vv)
                                $tmp .= 'data-'.$kk.'="'.$vv.'" ';
                            $tmp .= ' onclick="approve(this)">'. Yii::t('site', 'Reset') .'</button>';
                            $tmp .= '<span class="deletefile" style="color: #FF0000; display: inline; right: -10px; top: 10px; cursor: pointer;" id="'.$v['id'].'" file_name="'.$v['file_name'].'">x</span></li>';
                        }

                        $this->widget('ext.EAjaxUpload.EAjaxUpload',
                            array(
                                'id' => 'EAjaxUpload'.$data['id'],
                                'config' => array(
                                    'action' => Yii::app()->createUrl('/project/zakazParts/upload?id='.$data['id']),
                                    'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><ul class="qq-upload-list">'.$tmp.'</ul><span>'. Yii::t('site', 'Drag and drop files here') .'</span><div class="qq-upload-button">'. Yii::t('site', 'Upload file'). '</div></div></div>',
                                    'disAllowedExtensions' => array('exe'),
                                    'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                                    'minSizeLimit' => 10,// minimum file size in bytes
                                    'onComplete' => "js:function(id, fileName, responseJSON){
                                        $('.qq-upload-list').append(responseJSON.data.html);
                                    }"
                                )
                            )
                        ); ?>
                        
                        <!--Удаление отдельно взятого блока задания-->
                        <div class="col-xs-12 btn btn-primary deletePart"
                             onclick="delete_part(<?php echo $data['id']; ?>);"> <?=Yii::t('site', 'Remove part')?>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
