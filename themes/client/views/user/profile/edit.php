<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);

?><div class="row"><div class="col-md-offset-3 col-md-4"><h3><?php echo UserModule::t('Edit profile'); ?></h3></div></div>

<?php if(Yii::app()->user->hasFlash('profileMessage'))
    echo '<div class="success" >'.Yii::app()->user->getFlash('profileMessage').'</div >';
?>
<div class="row">
    <div class="col-md-7">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'form-horizontal'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {	?>
                <div class="form-group">
                    <?php echo $form->labelEx($profile,$field->varname,array('class'=>'col-md-4 control-label'));
                    if ($widgetEdit = $field->widgetEdit($profile,array('htmlOptions'=>array('class'=>'form-control')))) {
                        echo '<div class="col-md-8">'.$widgetEdit.'</div>';
                    } elseif ($field->range) {
                        echo '<div class="col-md-8">'.$form->dropDownList($profile,$field->varname,Profile::range($field->range),array('class'=>'form-control')).'</div>';
                    } elseif ($field->field_type=="TEXT") {
                        echo '<div class="col-md-8">'.$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'form-control')).'</div>';
                    } else {
                        echo '<div class="col-md-8">'.$form->textField($profile,$field->varname,array('class'=>'form-control','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255))).'</div>';
                    }
                    echo $form->error($profile,$field->varname);
                    ?>
                    </div><?php
            }
        }?>
        <div class="form-group">
            <?php echo $form->labelEx($model,'username',array('class'=>'col-md-4 control-label')); ?>
            <div class="col-md-8">
                <?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'username'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'email',array('class'=>'col-md-4 control-label')); ?>
            <div class="col-md-8">
                <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="form-group">
            <div class="col-md-offset-4 col-md-8">
                <?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),array('class'=>'btn btn-primary btn-save')); ?>
            </div>
	</div>

<?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
