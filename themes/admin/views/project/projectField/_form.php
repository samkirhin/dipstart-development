<div class="form">

<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row varname">
		<?php echo CHtml::activeLabelEx($model,'varname'); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'varname',array('size'=>60,'maxlength'=>50,'readonly'=>true)):CHtml::activeTextField($model,'varname',array('size'=>60,'maxlength'=>50))); ?>
		<?php echo CHtml::error($model,'varname'); ?>
		<p class="hint"><?php echo UserModule::t("Allowed lowercase letters and digits."); ?></p>
	</div>

	<div class="row title">
		<?php echo CHtml::activeLabelEx($model,'title'); ?>
		<?php echo CHtml::activeTextField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'title'); ?>
		<p class="hint"><?php echo UserModule::t('Field name on the language of "sourceLanguage".'); ?></p>
	</div>

	<div class="row field_type">
		<?php echo CHtml::activeLabelEx($model,'field_type'); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'field_type',array('size'=>60,'maxlength'=>50,'readonly'=>true,'id'=>'field_type')):CHtml::activeDropDownList($model,'field_type',ProjectField::itemAlias('field_type'),array('id'=>'field_type'))); ?>
		<?php echo CHtml::error($model,'field_type'); ?>
		<p class="hint"><?php echo UserModule::t('Field type column in the database.'); ?></p>
	</div>

	<div class="row field_size">
		<?php echo CHtml::activeLabelEx($model,'field_size'); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'field_size',array('readonly'=>true)):CHtml::activeTextField($model,'field_size')); ?>
		<?php echo CHtml::error($model,'field_size'); ?>
		<p class="hint"><?php echo UserModule::t('Field size column in the database.'); ?></p>
	</div>

	<div class="row required">
		<?php echo CHtml::activeLabelEx($model,'required'); ?>
		<?php echo CHtml::activeDropDownList($model,'required',ProjectField::itemAlias('required')); ?>
		<?php echo CHtml::error($model,'required'); ?>
		<p class="hint"><?php echo UserModule::t('Required field (form validator).'); ?></p>
	</div>

	<div class="row error_message">
		<?php echo CHtml::activeLabelEx($model,'error_message'); ?>
		<?php echo CHtml::activeTextField($model,'error_message',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'error_message'); ?>
		<p class="hint"><?php echo UserModule::t('Error message when you validate the form.'); ?></p>
	</div>

	<div class="row default">
		<?php echo CHtml::activeLabelEx($model,'default'); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'default',array('size'=>60,'maxlength'=>255,'readonly'=>true)):CHtml::activeTextField($model,'default',array('size'=>60,'maxlength'=>255))); ?>
		<?php echo CHtml::error($model,'default'); ?>
		<p class="hint"><?php echo UserModule::t('The value of the default field (database).'); ?></p>
	</div>

	<div class="row position">
		<?php echo CHtml::activeLabelEx($model,'position'); ?>
		<?php echo CHtml::activeTextField($model,'position'); ?>
		<?php echo CHtml::error($model,'position'); ?>
		<p class="hint"><?php echo UserModule::t('Display order of fields.'); ?></p>
	</div>

	<div class="row visible">
		<?php echo CHtml::activeLabelEx($model,'visible'); ?>
		<?php echo CHtml::activeDropDownList($model,'visible',ProjectField::itemAlias('visible')); ?>
		<?php echo CHtml::error($model,'visible'); ?>
	</div>

	<div class="row buttons">
   		<?php $attr = array (); ?>
		<?php if(Yii::app()->user->isGuest) $attr['disabled'] = 'disabled'; ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'), $attr); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->
