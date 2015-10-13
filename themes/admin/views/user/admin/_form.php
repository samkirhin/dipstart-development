<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
    $manager = !User::model()->isAuthor();
    $admin	 = User::model()->isAdmin();
	$ProfileFields = ProfileField::model()->findAll();
	$fields	= array();
	foreach($ProfileFields as $field){
//		$fields[$field['varname']] =  $field['editable'];
		$fields[$field['varname']] =  $field['paymentProps'];
	};	
	unset($ProfileFields);
?>

	<p class="note">=)<?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username');	?>
		<?php $attributes = array('size'=>40,'maxlength'=>20,'placeholder'=>$model->getAttributeLabel( 'username' ).($model->isAttributeRequired('username')?' *':''));	?>
		<?php if (!$admin && $manager) $attributes['disabled'] = true;	?>
		<?php echo $form->textField($model,'username',$attributes); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php $attributes = array('size'=>40,'maxlength'=>128,'placeholder'=>$model->getAttributeLabel( 'password' ).($model->isAttributeRequired('password')?' *':''));?>
		<?php if (!$admin && $manager) $attributes['disabled'] = true;	?>
		<?php echo $form->passwordField($model,'password',$attributes); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php $attributes = array('size'=>40,'maxlength'=>128,'placeholder'=>$model->getAttributeLabel( 'email' ).($model->isAttributeRequired('email')?' *':''));?>
		<?php if (!$admin && $manager && $fields['email']) $attributes['disabled'] = true;	?>
		<?php echo $form->textField($model,'email', $attributes); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'superuser'); ?>
		<?php $attributes = array(); $attributes['options'] = User::itemAlias('AdminStatus');?>
		<?php $disabled = array(); if (!$admin && $manager && $fields['superuser']) $disabled = array('disabled'=>true);?>
		<?php echo $form->dropDownList($model,'superuser',$attributes, $disabled); ?>
		<?php echo $form->error($model,'superuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php $attributes = array(); $attributes['options'] = User::itemAlias('AdminStatus');?>
		<?php $disabled = array(); if (!$admin && $manager && $fields['status']) $disabled = array('disabled'=>true); ?>
		<?php echo $form->dropDownList($model,'status',$attributes, $disabled); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
				$name = strtolower($field->varname);
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname); ?>
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			$attributes = Profile::range($field->range);
			if (!$admin && $manager && $fields[$name]) $disabled['disabled'] = 'disabled';
			echo $form->dropDownList($profile,$field->varname,$attributes,$disabled);
		} elseif ($field->field_type=="TEXT") {
			$attributes = array('rows'=>6, 'cols'=>41.5, 'placeholder'=>$profile->getAttributeLabel( $field->varname ).($profile->isAttributeRequired($field->varname)?' *':''));
			if (!$admin && $manager && $fields[$name]) $attributes['disabled'] = true;
			echo CHtml::activeTextArea($profile,$field->varname, $attributes);
		} else {
			$attributes = array('size'=>40,'maxlength'=>(($field->field_size)?$field->field_size:255),'placeholder'=>$profile->getAttributeLabel( $field->varname ).($profile->isAttributeRequired($field->varname)?' *':''));
			if (!$admin && $manager && $fields[$name]) $attributes['disabled'] = true;
			echo $form->textField($profile,$field->varname, $attributes);
		}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
	</div>
			<?php
			}
		}
?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->