<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/reset.css');?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/plate-form.css');?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/plate-form-media.css');?>
<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */
$c_id = Campaign::getId();
$url = '/uploads/c'.$c_id.'/temp/'.$model->unixtime.'/';
$html_string = $model->generateMaterialsList($url);

?>
    <div class="container form-container">
		<?php
		$company = Campaign::getCompany();
		if ($company->text4customers) echo '<div class="text4customerts">'.$company->text4customers.'</div>';
		$form = $this->beginWidget('CActiveForm', array(
			'id'=>'zakaz-form',
			'action'=>isset ($model->id) ? $this->createUrl('zakaz/update', ['id'=>$model->id]) : '',
			//'type' => 'horizontal',
			//'htmlOptions' => array('class' => 'well'),
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,

		)); ?>
		
			<p class="note"><?=ProjectModule::t('Fields with <span class="required">*</span> are required.')?></p>
			
            <?php //echo $form->errorSummary($model); ?>
			<div class="form-items">
			
			<?php
			if(Campaign::getId()){ ?>
				<div class="form-item">
                <?php echo $form->labelEx($model,'max_exec_date');?>
                <?php
                $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                    'model' => $model,
                    'attribute' => 'dbmax_exec_date',
                ));?>
				</div>
                <?php echo  $form->hiddenField($model,'unixtime');?>
                <?php
				$projectFields = $model->getFields();
				if ($projectFields) {
					foreach($projectFields as $field) {
						if ($field->field_type=="BOOL"){
							echo '<div class="form-item" style="padding-left: 20px;">';
							echo $form->checkBox($model,$field->varname);
							echo $form->labelEx($model,$field->varname);
							echo $form->error($model,$field->varname);
							echo '</div>';
                        } elseif ($field->field_type=="LIST"){
							echo '<div class="form-item">';
							echo $form->labelEx($model,$field->varname).'<br/>';
							$list = Catalog::model()->performCatsTree($field->varname);
							echo $form->dropDownList($model, $field->varname, $list, array('empty' => ProjectModule::t('Select a category'),'class'=>'form-control'));
							echo $form->error($model,$field->varname);
							echo '</div>';
						} elseif ($field->field_type=="TIMESTAMP" || $field->field_type=="DATE") {
							?>
							<div class="form-item" style="position: relative; float: left; width: 100%;">
								<label style="position: relative; float: left; width: 100px;"><?php echo $form->labelEx($model,$field->varname);?></label>
								<?php
								$this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
									'model' => $model,
									'attribute' => $field->varname,
								));
								echo $form->error($model,$field->varname);
								?>
							</div><?php
						} elseif ($field->field_type=="TEXT") {
							echo '<div class="form-item">';
							echo $form->labelEx($model,$field->varname).'<br/>';
							echo $form->textArea($model,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control'));
							echo $form->error($model,$field->varname);
							echo '</div>';
						} else {
							echo '<div class="form-item">';
							echo $form->labelEx($model,$field->varname).'<br/>';
							echo $form->textField($model,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'));
							echo $form->error($model,$field->varname);
							echo '</div>';
						}
					}
				}
			} ?>
            <div class="form-item">
              <?php
                //if (User::model()->isCustomer()) {
                    
                    $this->widget('ext.EAjaxUpload.EAjaxUpload',
                        array(
                            'id' => 'justFileUpload',
                            'postParams' => array(
                                'unixtime' => $model->unixtime,
                            ),
                            'config' => array(
                                'action' => $this->createUrl('/project/zakaz/upload', array('unixtime' => $model->unixtime)),
                                'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>'. ProjectModule::t('Drag and drop files here') .'</span><div class="qq-upload-button">'. ProjectModule::t('Attach materials to the order') .'</div><ul class="qq-upload-list">'.$html_string.'</ul></div></div>',
                                'disAllowedExtensions' => array('exe'),
                                'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                                'minSizeLimit' => 10,// minimum file size in bytes
                                'onComplete' => "js:function(id, fileName, responseJSON){}"
                            )
                        )
                    );
                //}                
                ?>
            </div>
			<?php if ( $isGuest ) { ?>
			<div class="form-item">
			<?php echo $form->labelEx($user,'email'); ?><br/>
			<?php echo $form->textField($user,'email'); ?>
			<?php echo $form->error($user,'email'); ?>
			</div>
			<div class="form-item">
			<?php echo $form->labelEx($user,'phone_number'); ?><br/>
			<?php echo $form->textField($user,'phone_number'); ?>
			<?php echo $form->error($user,'phone_number'); ?>
			</div>
			<?php } ?>
		    </div>
			<?php echo CHtml::submitButton(ProjectModule::t('Create'), array('class' => 'create-order-button') ); ?>
		
		<?php $this->endWidget(); ?>
    

	</div>


<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/masonry.min.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/common-masonry.js', CClientScript::POS_END);
?>
<script>
    /*Remove attachment file*/
    function removeFile(obj){
        if (confirm("<?php echo Yii::t('site', 'Are you sure you want to delete this item?');?>")) {
            var data=$(obj).data();
            $.post('/project/zakaz/apiRenameFile?unixtime=<?php echo $model->unixtime; ?>', JSON.stringify({
                'data': data
            }), function (response) {
                if (response.data){
                    obj.remove();
                    $('#'+data.link).remove();
                }
            }, 'json');
    }}/*END Remove attachment file*/
</script>