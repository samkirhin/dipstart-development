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
                    if (User::model()->isAuthor()) echo $data['dbdate'];
                    ?>
                </div>
            </div>
            <div id="collapseOne<?php echo $data['id']; ?>" class="panel-collapse collapse">
                <div class="panel-body">

                    <p>
                        <?php echo $data['title']; ?>
                        <?php
                        if (User::model()->isAuthor()) {
                            ?>
                            <textarea class="col-xs-12" disabled><?php echo $data['comment']; ?></textarea>
                        <?php } ?>

                    <div class="part_files">
                        <?php foreach ($data['files'] as $k => $v){
                            echo '<div class="row">';
                            if ($v['id']!=0) echo '<a href="' . $v['file_name'] . '" id="parts_file" data-part="' . $data['id'] . '">';
                            if (User::model()->isAuthor() || ($v['id']!=0)) echo $v['orig_name'];
                            if ($v['id']!=0) echo '</a>';
                            echo '</div>';
                        } ?>
                    </div>

                        <?php if (User::model()->isAuthor()) $this->widget('ext.EAjaxUpload.EAjaxUpload',
                            array(
                                'id' => 'EAjaxUpload'.$data['id'],
                                'config' => array(
                                    'action' => Yii::app()->createUrl('/project/zakazParts/upload',array('proj_id'=>$data['proj_id'],'id'=>$data['id'])),
                                    'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                                    'disAllowedExtensions' => array('exe'),
                                    'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                                    'minSizeLimit' => 10,// minimum file size in bytes
                                    'onComplete' => "js:function(id, fileName, responseJSON){}"
                                )
                            )
                        );
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
