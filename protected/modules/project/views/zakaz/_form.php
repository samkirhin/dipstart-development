<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'zakaz-form',
    //'type' => 'horizontal',
    //'htmlOptions' => array('class' => 'well'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=ProjectModule::t('Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

    <!--<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>70,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>-->

    <div class="row">
		<?php echo $form->labelEx($model,'executor');
          $list = CHtml::listData(User::model()->findAllAuthors(), 'id', 'username');
          echo $form->dropDownList($model, 'executor', $list, array('empty' => ProjectModule::t('Select a author')));?>
        <?php //echo $form->textField($model,'executor',array('size'=>53,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'executor'); ?>
	</div>

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

	<div class="row">
		<?php echo $form->labelEx($model,'max_exec_date');
		 $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'name'=>'Zakaz[max_exec_date]',
            // additional javascript options for the date picker plugin
            'language' => 'ru',
            //'datevalue' => $model->max_exec_date ? $model->max_exec_date : date('d.m.yy'),
            'options'=>array(
                'dateFormat'=>'Y-m-d',
                'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
            ),
            'htmlOptions'=>array(
                'style'=>'height:20px;background-white:blue;color:black;',
            ),
        ));
        ?>

	</div>

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



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? ProjectModule::t('Create') : ProjectModule::t('Save')); ?>
	</div>

<?php $this->endWidget();
?>

</div><!-- form -->