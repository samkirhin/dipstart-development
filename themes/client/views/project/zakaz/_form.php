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
		$projectFields = $model->getFields();
		if ($projectFields) {
			foreach($projectFields as $field) {
				echo '<div class="form-group">';
				echo $form->labelEx($model,$field->varname).'<br/>';
				if (isset($field->field_id)){
					$models = Catalog::model()->findAllByAttributes(array('field_id'=>$field->field_id));
					$list = CHtml::listData($models, 'id', 'cat_name');
					echo $form->dropDownList($model, $field->varname, $list, array('empty' => ProjectModule::t('Select a category'),'class'=>'form-control'));
					echo $form->error($model,$field->varname);
				} elseif ($field->field_type=="TEXT") {
					echo$form->textArea($model,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control'));
				} elseif ($field->field_type=="TIMESTAMP") {
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
	} else {
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php $models = Categories::model()->findAll();
		  $list = CHtml::listData($models, 'id', 'cat_name');
		  echo $form->dropDownList($model, 'category_id', $list, array('empty' => ProjectModule::t('Select a category')));?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_id'); ?>
		<?php $models = Jobs::model()->findAll();
		  $list = CHtml::listData($models, 'id', 'job_name');
		  echo $form->dropDownList($model, 'job_id', $list, array('empty' => ProjectModule::t('Select a job')));?>
		<?php echo $form->error($model,'job_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>70,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>70)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<table class="table table-striped" style="font-size: 12px">
	    <tr>
			<td>
				<?php echo $form->labelEx($model,'max_exec_date'); ?>
			</td>
			<td>
                <?php
                $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                    'model' => $model,
                    'attribute' => 'dbmax_exec_date',
                ));?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $form->labelEx($model,'date_finish');?>
			</td>
			<td>
                <?php
                $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                    'model' => $model,
                    'attribute' => 'dbdate_finish',
                ));?>
			</td>
		</tr>
</table>

	<div class="row">
		<?php echo $form->labelEx($model,'pages'); ?>
		<?php echo $form->textField($model,'pages'); ?>
		<?php echo $form->error($model,'pages'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_demands'); ?>
		<?php echo $form->textArea($model,'add_demands',array('rows'=>6, 'cols'=>53)); ?>
		<?php echo $form->error($model,'add_demands'); ?>
	</div>
	<h3>Заметки</h3>

	<div class="row">
		<?php echo $form->labelEx($model,'time_for_call'); ?>
		<?php echo $form->textField($model,'time_for_call'); ?>
		<?php echo $form->error($model,'time_for_call'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edu_dep'); ?>
		<?php echo $form->textField($model,'edu_dep'); ?>
		<?php echo $form->error($model,'edu_dep'); ?>
	</div>
	<?php } ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? ProjectModule::t('Create') : ProjectModule::t('Save')); ?>
	</div>

<?php $this->endWidget();
?>

</div><!-- form -->
