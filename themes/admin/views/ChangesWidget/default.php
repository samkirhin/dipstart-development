<?php
/* @var $this CWidget */
/* @var $user User */
/* @var $changes ProjectChanges */
?>


<div class="row zero-edge change-row">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="partStatus"></div>
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapseEdits"><?php echo ProjectModule::t('Changes'); ?></a>
                </h4>
            </div>

            <div id="collapseEdits<?php echo $data['id']; ?>" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div id="list_files">
                    <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider'=>$changes,
                            'itemView'=>'_list',
                            'summaryCssClass'=>'hidden',
                            'emptyText'=>'',
                        ));
                        ?>
                    </div>
                    <div class="form">
                        <div id="errors-block"></div>
                    </div>
                </div>
				
				<div id="new-changes-block" class="row zero-edge">
					<div id="new-changes-link"><a data-toggle="collapse" data-parent="#new-changes-block" href="#new-changes-collapse">Новая доработка</a></div>
					<div id="new-changes-collapse" class="collapse">
						<?php
						echo CHtml::form('', 'post', array('id' => 'up_file', 'enctype' => 'multipart/form-data'));
						?>
						<div class="col-xs-12">
							<?php echo CHtml::label('Прикрепить файл', 'fileupload'); ?>
							<?php echo CHtml::fileField('ProjectChanges[fileupload]', $fileupload, array('class' => 'col-xs-12 btn btn-user')); ?>
						</div>

						<div class="col-xs-12">
							<?php echo CHtml::label('Комментарий', 'comment'); ?>
							<?php echo CHtml::textArea('ProjectChanges[comment]', $comment, array('class' => 'col-xs-12')); ?>
						</div>
						<?php echo CHtml::endForm(); ?>
						<?php
						$url = Yii::app()->createUrl("/project/changes/add",array('project'=>$project->id));
						echo CHtml::htmlButton(ProjectModule::t('Add changes'), array(
							'class' => 'col-xs-12 btn btn-primary addPart',
							'onclick' => "javascript: send('$url')",
						));?>
					</div>
				</div>
				
            </div>
        </div>
    </div>
</div>

