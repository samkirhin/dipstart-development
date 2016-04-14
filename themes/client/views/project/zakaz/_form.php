<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
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

	<?php echo $form->errorSummary($model);
	
	if(Campaign::getId()){
		echo '<div class="row">';
		echo $form->labelEx($model,'max_exec_date');
		$this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
			'model' => $model,
			'attribute' => 'dbmax_exec_date',
		));
		echo '</div>';
		$projectFields = $model->getFields();
		if ($projectFields) {
			foreach($projectFields as $field) {
				echo '<div class="row">';
				echo $form->labelEx($model,$field->varname).'<br/>';
				if ($field->field_type=="BOOL"){
					echo $form->checkBox($model,$field->varname);
                } elseif ($field->field_type=="LIST"){
					$models = Catalog::model()->findAllByAttributes(array('field_varname'=>$field->varname));
					$list = CHtml::listData($models, 'id', 'cat_name');
					echo $form->dropDownList($model, $field->varname, $list, array('empty' => ProjectModule::t('Select a category'),'class'=>'form-control'));
					echo $form->error($model,$field->varname);
				} elseif ($field->field_type=="TEXT") {
					echo$form->textArea($model,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control'));
				} elseif ($field->field_type=="TIMESTAMP" || $field->field_type=="DATE") {
						$varname = $field->varname;
						$model->timestampOutput($field);
						$this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
							'model' => $model,
							'attribute' => $varname,
						));
				} else {
					echo $form->textField($model,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'));
				}
				echo '</div>';
			}
		}
	} ?>
	<?php
		if (User::model()->isCorrector()) {
			echo $form->hiddenField($model, 'technicalspec', array('value' => 0));
			echo CHtml::hiddenField('accepted', 1);
		}
	?>
	<div class="row buttons">
		<?php $attr = array('class' => 'btn btn-primary'); ?>
		<?php if(Yii::app()->user->isGuest) $attr['disabled'] = 'disabled'; ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? ProjectModule::t('Create') : (User::model()->isCorrector() ? ProjectModule::t('Technical spec accepted') : ProjectModule::t('Save')), $attr); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
