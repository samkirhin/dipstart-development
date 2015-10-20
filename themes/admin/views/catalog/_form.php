<?php
/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'catalog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=Yii::t('site','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cat_name'); ?>
		<?php echo $form->textField($model,'cat_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cat_name'); ?>
	</div>
	
	<div class="row"><?php
		echo $form->labelEx($model,'field_varname');
		//echo $form->textField($model,'field_varname',array('size'=>60,'maxlength'=>50));
		echo $form->error($model,'field_varname');
		$criteria = new CDbCriteria();
		$criteria->compare('field_type','LIST');
		$list = CHtml::listData(ProjectField::model()->findAll($criteria),'varname','title');
		$list = array_merge($list,CHtml::listData(ProfileField::model()->findAll($criteria),'varname','title'));
		echo $form->dropDownList($model, 'field_varname', $list, array('empty' => Yii::t('site','Select')));
	?></div>

	<div class="row">
	<?php
         echo $form->label($model,'parent_id');
         $criteria = new CDbCriteria();
         $criteria->compare('parent_id',0);
         $list = CHtml::listData(Catalog::model()->findAll($criteria),'id','cat_name');
         echo $form->dropDownList($model, 'parent_id', $list, array('empty' => Yii::t('site','Select')));
        ?>
	</div>

	<div class="row buttons">
		<?php $attr = array(); ?>
		<?php if(Yii::app()->user->isGuest) $attr['disabled'] = 'disabled'; ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('site','Create') : Yii::t('site','Save'), $attr); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->