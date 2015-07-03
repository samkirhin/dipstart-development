<?php
/* @var $this CWidget */
/* @var $user User */
/* @var $changes ProjectChanges */
?>

<h4><?php echo ProjectModule::t('Changes'); ?></h4>
<div class="row zero-edge">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="partStatus"></div>
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapseEdits<?php echo $data['id']; ?>"><?php echo $data['title']; ?></a>
                </h4>
            </div>

            <div id="collapseEdits<?php echo $data['id']; ?>" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p>
                        <?php echo $data['date']; ?>
                    </p>
                    <div id="list_files">
                    <?php
                    $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $changes,
                        'itemView' => '_list',
                        'summaryCssClass' => 'hidden',
                        'emptyText' => '',
                        'enablePagination' => false,
                    ));?>
                    </div>
                    <?php
                    if ($user->isCustomer()) { ?>
                        <div class="form">
                            <div id="errors-block"></div>
                            <?php
                            echo CHtml::form(Yii::app()->createUrl('/project/changes/add?ctr=' . $project->id), 'post', array('id' => 'up_file', 'enctype' => 'multipart/form-data'));
                            ?>
                            <div class="row">
                                <?php echo CHtml::label('Прикрепить файл', 'fileupload'); ?>
                                <?php echo CHtml::fileField('ProjectChanges[fileupload]', $fileupload, array('class' => 'col-xs-12 btn btn-user')); ?>
                            </div>

                            <div class="row">
                                <?php echo CHtml::label('Комментарий', 'comment'); ?>
                                <?php echo CHtml::textArea('ProjectChanges[comment]', $comment, array('class' => 'col-xs-12')); ?>
                            </div>

                            <?php if (ProjectChanges::approveAllowed()) { ?>
                                <div class="row">
                                    <label for="ProjectChanges_moderate">Модерация</label>
                                    <?php echo CHtml::dropDownList($changes,
                                        'moderate',
                                        array('1' => ProjectModule::t('Approved'), '0' => ProjectModule::t('Not approved')),
                                        array('style' => ''));
                                    ?>
                                </div>
                            <?php } ?>
                            <div class="row buttons">
                                <?php
                                echo CHtml::htmlButton(ProjectModule::t('Add changes'), array(
                                    'class' => 'col-xs-12 btn btn-user addPart',
                                    'onclick' => 'javascript: send();',
                                    'id' => 'post-submit-btn',
                                )); ?>
                            </div>

                            <?php echo CHtml::endForm(); ?>
                            <script type="text/javascript">
                                function send() {
                                    var formData = new FormData($("#up_file")[0]);
                                    $.ajax({
                                        url: '<?php echo Yii::app()->createUrl("/project/changes/add",array('project'=>$project->id)); ?>',
                                        type: 'POST',
                                        data: formData,
                                        datatype: 'json',
                                        success: function (data) {
                                            jQuery("#list_files").load("<?php echo Yii::app()->createUrl("/project/changes/list",array('project'=>$project->id)); ?>");
                                        },
                                        cache: false,
                                        contentType: false,
                                        processData: false
                                    });

                                    return false;
                                }
                            </script>
                        </div><!-- form -->
                    <?php
                    }
                    ?>        </div>
            </div>
        </div>
    </div>
</div>
