<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */
?>


<div class="col-xs-12 terms-block" style="padding-right: 0px;">
    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'zakaz-form',
            'enableAjaxValidation' => false,
        ));
        echo $form->errorSummary($model); ?>
    </div>
    <div class="row">
        <div class="col-xs-6"><h4><?=ProjectModule::t('Deadlines')?></h4></div>
        <div class="col-xs-6" style="float:right;">
            <?php echo CHtml::submitButton(ProjectModule::t('Save'), array('class' => 'btn btn-primary terms-save-btn')); ?>
        </div>
        <div class="col-xs-4 terms-columns terms-column-1">
            <p><?php echo $form->labelEx($model, 'max_exec_date'); ?></p>

            <?php
            $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'dbmax_exec_date',
            ));?>
        </div>
        <div class="col-xs-4 terms-columns terms-column-2">
            <p><?php echo $form->labelEx($model, 'manager_informed'); ?></p>
            <?php
            $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'dbmanager_informed',
            ));?>
        </div>
        <div class="col-xs-4 terms-columns terms-column-3 terms-columns-last">
            <p><?php echo $form->labelEx($model, 'author_informed'); ?></p>
            <?php
            $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'dbauthor_informed',
            ));?>
        </div>




        <?php $this->endWidget(); ?>
    </div>
    <!-- form -->
</div>

<div class="col-xs-12 chatBlockBg">
    <div class="chatBlock chtpl0-chatblock chtpl0-admin">
		<div class="chtpl0-panel chtpl0-up">
			<button class="chtpl0-show"><?=ProjectModule::t('Show messages')?></button>
		</div>
        <div id="chatWindow" class="chtpl0-chat"></div>
		<div class="chtpl0-panel chtpl0-down chat-functions">
			<input id="send_email" type="checkbox"><p><?=ProjectModule::t('Send to e-mail')?></p>
			<input id="send_sms" type="checkbox"><p><?=ProjectModule::t('Send SMS')?></p>
			<button class="chtpl0-template" data-toggle="modal" data-target="#template"></button><p><?=ProjectModule::t('Use template')?></p>
		</div>
        <?php
        Yii::app()->getClientScript()->registerScriptFile('/js/tinymce/tinymce.min.js');
        $this->beginWidget('application.extensions.booster.widgets.TbModal', array(
            'id' => 'template',
        )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h4><?php echo Yii::t('project','Please select template');?></h4>
        </div>
        <div class="modal-body">
            <?php
            echo CHtml::dropDownList('templates', '', CHtml::listData(Templates::model()->findAll(), 'id', 'title'));
            ?>
        </div>
        <div class="modal-footer">
            <?php
            $this->widget('application.extensions.booster.widgets.TbButton', array(
                'buttonType' => 'submit',
                'label' => 'Выбрать',
                'id'=>'select_template',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            ));
            ?>
            <?php
/*            $this->widget('application.extensions.booster.widgets.TbButton', array(
                'label' => 'Закрыть',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            ));*/
            ?>
        </div>
        <?php
        $this->endWidget();
        ?>
		<div class="chtpl0-form">
			<textarea></textarea>
			<div class="chtpl0-subm">
				<h5><?=ProjectModule::t('Send message')?></h5>
				<br>
				<button class="chtpl0-submit1"><?=ProjectModule::t('to author')?></button>
				<button class="chtpl0-submit2">Заказчику</button><?=ProjectModule::t('to сustomer')?>
			</div>
		</div>
        <?php
        $this->widget('YiiChatWidget', array(
            'chat_id' => $model->id,
            'executor' => $model->executor,
            'identity' => Yii::app()->user->id,
            'selector' => '#chatWindow',
            'minPostLen' => 1,
            'maxPostLen' => 5000,
            'model' => new ChatHandler(),
            'data' => 'any data',
            'onSuccess' => new CJavaScriptExpression(
                "function(code, text, post_id){   }"),
            'onError' => new CJavaScriptExpression(
                "function(errorcode, info){  }"),
        ));
        ?>
    </div>
</div>

<div class="col-xs-12 payment-block">
    <?php
    $this->widget('application.modules.project.widgets.payment.PaymentWidget', array(
        'projectId' => $model->id
    ));
    ?>
</div>

</div>
</div>

<div class="row" style="display: none">
    <div class="col-xs-12 info-block">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-white">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#infoZakaz">
                            <?=ProjectModule::t('Order information').' '.$model->id.': "'.$model->title.'"'?> <i class="fa fa-angle-down fa-lg"></i>
		
                        </a>
						<br/><!--<a data-toggle="collapse" data-parent="#accordion" href="#infoZakaz">-->
						<!--<img onclick="this.style.transform+='rotate(180deg)'" src="http://crm.obshya.com/themes/admin/views/project/zakaz/line_2.jpg" id="str" />-->
						<!--</a>-->
                    </h4>
                </div>
                <div id="infoZakaz" class="panel-collapse collapse">
                    <div class="panel-body">

                        <div class="col-xs-12 aboutZakaz">
                            <div class="form">

                                <?php $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'zakaz-form',
                                    'enableAjaxValidation' => false,
                                ));
                                echo $form->errorSummary($model); ?>
                                <div class="col-xs-6 info-column">
                                    <div class="notesBlockArea">
                                        <?php echo $form->labelEx($model, 'author_notes'); ?>
                                        <?php echo $form->textArea($model, 'author_notes', array('rows' => 3, 'class' => 'notesBlockTextarea')); ?>
                                    </div>

                                    <?php
                                    // --- campaign
                                    if(isset(Zakaz::$files_folder)){
                                        $url = Zakaz::$files_folder.$model->id.'/';
                                    } else {
                                        $url = '/uploads/'.$model->id.'/';
                                    }
                                    // ---
                                    $path = Yii::getPathOfAlias('webroot').$url;
                                    $tmp = '';
                                    if (file_exists($path)) {
                                        foreach (array_diff(scandir($path), array('..', '.')) as $k => $v) {
                                            $tmp .= '<li><a class="link-to-material" href="' . $url . urlencode($v) . '">' . str_replace('#pre#', '', $v) . '</a>';
                                            $tmp .= '<a href="#" data-id="' . $model->id . '" data-name="' . $v . '" onclick="removeFile(this); return false;"><i class="glyphicon glyphicon-remove" title="'. Yii::t('site', 'Delete') .'"></i></a>'; #remove file btn
                                            if (strstr($v, '#pre#'))
                                                $tmp .= '<button id="approveFile_file" data-id="' . $model->id . '" data-name="' . $v . '" class="right btn" onclick="approveFile(this)">'. ProjectModule::t('Approve') .'</button>';
                                            $tmp .= '</li>';
                                        }
                                    }

                                    $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                        array(
                                            'id' => 'justFileUpload',
                                            'postParams' => array(
                                                'id' => $model->id,
                                            ),
                                            'config' => array(
                                                'action' => $this->createUrl('/project/chat/upload',array('id'=>$model->id)),
                                                'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>'. ProjectModule::t('Drag and drop files here') .'</span><div class="qq-upload-button">'. ProjectModule::t('Upload material') .'</div><ul class="qq-upload-list">'.$tmp.'</ul></div></div>',
                                                'disAllowedExtensions'=>array('exe'),
                                                'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                                                'minSizeLimit' => 10,// minimum file size in bytes
                                                'onComplete' => "js:function(id, fileName, responseJSON){}"
                                            )
                                        )
                                    );
                                    ?>

                                    <?php
									if (!Campaign::getId()){
									echo $form->labelEx($model, 'category_id');
                                    $models = Categories::model()->findAll();
                                    $list = CHtml::listData($models, 'id', 'cat_name');
                                    echo $form->dropDownList($model, 'category_id', $list, array('empty' => ProjectModule::t('Select a category')));
                                    echo $form->error($model, 'category_id');
                                    echo '<br>';
                                    echo $form->labelEx($model, 'job_id');
                                    $models = Jobs::model()->findAll();
                                    $list = CHtml::listData($models, 'id', 'job_name');
                                    echo $form->dropDownList($model, 'job_id', $list, array('empty' => ProjectModule::t('Select a job')));
                                    echo $form->error($model, 'job_id');
                                    echo '<br>';
                                    echo $form->labelEx($model, 'title');
                                    echo $form->textField($model, 'title', array('size' => 70, 'maxlength' => 255));
                                    echo $form->error($model, 'title');
                                    echo '<br>';
                                    echo $form->labelEx($model, 'text');
                                    echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 70));
                                    echo $form->error($model, 'text'); 
									} else {
										$projectFields = $model->getFields();
										if ($projectFields) {
											foreach($projectFields as $field) {
												echo '<div class="form-group">';
												echo $form->labelEx($model,$field->varname).'<br/>';
												if ($field->field_type=="LIST"){
													$models = Catalog::model()->findAllByAttributes(array('field_varname'=>$field->varname));
													$list = CHtml::listData($models, 'id', 'cat_name');
													echo $form->dropDownList($model, $field->varname, $list, array('empty' => ProjectModule::t('Select a category'),'class'=>'form-control'));
													echo $form->error($model,$field->varname);
												} elseif ($field->field_type=="TEXT") {
													echo $form->textArea($model,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control'));
												} elseif ($field->field_type!="TIMESTAMP") {
													echo $form->textField($model,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'));
												}
												echo '</div>';
											}
										}
									}
									?>
                                    <h3> <?=ProjectModule::t('Deadlines')?> </h3>

                                    <table class="table table-striped" style="font-size: 12px;">
                                        <thead>
                                        <th><?=ProjectModule::t('Product name')?></th>
                                        <th><?=ProjectModule::t('Date/Time')?></th>
                                        </thead>
                                        <tr>
                                            <td>
                                                <?php echo $form->labelEx($model, 'date'); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                                                    'model' => $model,
                                                    'attribute' => 'dbdate',
                                                ));?>
                                            </td>
                                        </tr>
										<?php if (!Campaign::getId()){ ?>
                                        <tr>
                                            <td>
                                                <?php echo $form->labelEx($model, 'date_finish'); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                                                    'model' => $model,
                                                    'attribute' => 'dbdate_finish',
                                                ));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php echo $form->labelEx($model, 'pages'); ?>
                                                <?php echo $form->textField($model, 'pages'); ?>
                                                <?php echo $form->error($model, 'pages'); ?>
                                            </td>
                                            <td>

                                            </td>
                                        </tr><?php
										} else {
											$projectFields = $model->getFields();
											if ($projectFields) foreach($projectFields as $field) {
												if ($field->field_type=="TIMESTAMP") {
												$varname = $field->varname;
												$model->timestampOutput($field);
                                        ?><tr>
                                            <td>
                                                <?php echo $form->labelEx($model, $varname); ?>
                                            </td>
                                            <td><?php
													$this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
														'model' => $model,
														'attribute' => $varname,
													));?>
                                            </td>
                                        </tr><?php
												}
											}
										} ?>
                                    </table>
									<?php if (!Campaign::getId()){ ?>
                                    <?php echo $form->labelEx($model, 'time_for_call'); ?><br>
                                    <?php echo $form->textField($model, 'time_for_call'); ?>
                                    <?php echo $form->error($model, 'time_for_call'); ?>
                                    <br>
                                    <?php echo $form->labelEx($model, 'edu_dep'); ?><br>
                                    <?php echo $form->textField($model, 'edu_dep'); ?>
                                    <?php echo $form->error($model, 'edu_dep'); ?>
									<?php } ?>
                                </div>
								<?php if (!Campaign::getId()){ ?>
                                <div class="col-xs-6 info-column">

                                    <?php echo $form->labelEx($model, 'add_demands'); ?><br>
                                    <?php echo $form->textArea($model, 'add_demands', array('rows' => 6, 'cols' => 53)); ?>
                                    <?php echo $form->error($model, 'add_demands'); ?>
                                </div>
								<?php } ?>
                                <div class="col-xs-12 info-buttons">
                                    <div><?php echo CHtml::submitButton(ProjectModule::t('Save'), array('class' => 'btn btn-primary')); ?></div>
                                </div>

                                <?php $this->endWidget(); ?>
                            </div>
                            <!-- form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
