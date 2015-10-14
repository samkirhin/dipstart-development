<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>
	<p class="note">=)<?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>
<style>
.center-div-admin-form{
	float:	left;
	width:	70%;
    margin: auto;	
}
.left-div-admin-form{
	float:	left;
	width:	50%;
}
.right-div-admin-form{
	float:	right;
	width:	50%;
}
.select-specilization{
	width:	280px;
}
</style>

	<div class="row"><div class="left-div-admin-form">
		<?php echo $form->labelEx($model,'username');	?>
		</div><div class="right-div-admin-form">
		<?php $attributes = array('size'=>40,'maxlength'=>20,'placeholder'=>$model->getAttributeLabel( 'username' ).($model->isAttributeRequired('username')?' *':''));	?>
		<?php if (!$admin && $manager) $attributes['disabled'] = true;	?>
		<?php echo $form->textField($model,'username',$attributes); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
	</div>

	<div class="row"><div class="left-div-admin-form">
		<?php echo $form->labelEx($model,'email'); ?>
		</div><div class="right-div-admin-form">
		<?php $attributes = array('size'=>40,'maxlength'=>128,'placeholder'=>$model->getAttributeLabel( 'email' ).($model->isAttributeRequired('email')?' *':''));?>
		<?php if (!$admin && $manager && $fields['email']) $attributes['disabled'] = true;	?>
		<?php echo $form->textField($model,'email', $attributes); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
	</div>
<?php 
		if ($admin) { ?>

	<div class="row"><div class="left-div-admin-form">
		<?php echo $form->labelEx($model,'superuser'); ?>
		</div><div class="right-div-admin-form">
		<?php $attributes = array(); $attributes['options'] = User::itemAlias('AdminStatus');?>
		<?php $disabled = array(); if (!$admin && $manager && $fields['superuser']) $disabled = array('disabled'=>true);?>
		<?php echo $form->dropDownList($model,'superuser',$attributes, $disabled); ?>
		<?php echo $form->error($model,'superuser'); ?>
	</div>

	<div class="row"><div class="left-div-admin-form">
		<?php echo $form->labelEx($model,'status'); ?>
		</div><div class="right-div-admin-form">
		<?php $attributes = array(); $attributes['options'] = User::itemAlias('AdminStatus');?>
		<?php $disabled = array(); if (!$admin && $manager && $fields['status']) $disabled = array('disabled'=>true); ?>
		<?php echo $form->dropDownList($model,'status',$attributes, $disabled); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	
<?php 
		};
		$mailing_list = 0;
		foreach($fields as $field) {
			$name = strtolower($field->varname);
			if ($name == 'mailing_list') {
				$mailing_list = $model->profile->getAttribute($name);
				$mailing_list = array('isq','sms','email')[$mailing_list];
			};
			
?>
	<div class="row"><div class="left-div-admin-form">
		<?php echo $form->labelEx($profile, $field->varname); ?>
		<?php //echo $form->labelEx($profile,YII::t( 'project', $field->varname)); ?>
		</div><div class="right-div-admin-form">
<?php 
			if ($widgetEdit = $field->widgetEdit($profile)) {
				echo $widgetEdit;
			} elseif (($field->range) || ($field->field_type=="LIST")) {
				if ($field->varname == 'specials' ) {
					echo $specials;
				} else {	
				
					$attributes = Profile::range($field->range);
					if (!$admin && $manager && $field[paymentProps]) $disabled['disabled'] = 'disabled';
					echo $form->dropDownList($profile,$field->varname,Profile::range($field->range),$disabled);
				};	
			} elseif ($field->field_type=="TEXT") {
				$attributes = array('rows'=>6, 'cols'=>38, 'placeholder'=>$profile->getAttributeLabel( $field->varname ).($profile->isAttributeRequired($field->varname)?' *':''));
				if (!$admin && $manager && $field[paymentProps]) $attributes['disabled'] = true;
				echo CHtml::activeTextArea($profile,$field->varname, $attributes);
			} else {
				$attributes = array('size'=>40,'maxlength'=>(($field->field_size)?$field->field_size:255),'placeholder'=>$profile->getAttributeLabel( $field->varname ).($profile->isAttributeRequired($field->varname)?' *':''));
				if (!$admin && $manager && $field[paymentProps]) $attributes['disabled'] = true;
				echo $form->textField($profile,$field->varname, $attributes);
			}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
		</div>
	</div>
			<?php
		}
?>
	<div class="row buttons"><div class="left-div-admin-form">&nbsp;
		</div><div class="right-div-admin-form">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
		</div>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<input type="hidden" id="mailing_list" value="<?= $mailing_list ?>">

<script>
	$(document).ready(function()
	{
		$('#Profile_mailing_list').val($('#mailing_list').val());
	});
</script>
