<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>

<h1><?php echo UserModule::t("Hello, please fill an anket for authors".$profile->regType); ?> :)</h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode', 'discipline', 'job_type'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">(=<?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo $form->errorSummary(array($model,$profile)); ?>
	
	<div class="row registration-first">
	<?php echo $form->labelEx($model,'username'); ?><br/>
	<?php echo $form->textField($model,'username'); ?><br/>
	<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?><br/>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?><br/>
	<?php echo $form->passwordField($model,'verifyPassword'); ?><br/>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'email'); ?><br/>
	<?php echo $form->textField($model,'email'); ?><br/>
	<?php echo $form->error($model,'email'); ?>
	</div>
	
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php
		if (($field->varname == 'mailing_list') && ($profile->regType=='Customer')) $list=array('style'=>'display:none;');
		echo $form->labelEx($profile,$field->varname); ?><br/>
		<?php
		if($field->varname == 'discipline'){
        $htmlOptions = array('size' => '10', 'multiple' => 'true','style'=>'width:400px;','size'=>'10', 'empty'=>UserModule::t('Use Ctrl for multiply'));
        $data = Categories::model()->performCatsTree();
        echo CHtml::listBox('Profile[discipline]', array(), $data, $htmlOptions);
        /*echo $form->dropDownList($profile,'discipline',
                     CHtml::listData(Categories::model()->performCatsTree(), 'id', 'cat_name'),
                     array('empty'=>UserModule::t('Use Ctrl for multiply'),'multiple'=>true ,'style'=>'width:400px;','size'=>'10'));
        */
        }elseif ($field->varname == 'job_type'){
                echo $form->dropDownList($profile,'job_type',
                     CHtml::listData(Jobs::model()->findAll(), 'id', 'job_name'),
                     array('empty'=>UserModule::t('Use Ctrl for multiply'),'multiple'=>true ,'style'=>'width:400px;','size'=>'10'));
        }elseif ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range),$list);
		} elseif ($field->field_type=="TEXT") {
            echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
	</div>
			<?php
			}
		}
?>
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
		<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
	</div>
	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>
