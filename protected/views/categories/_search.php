<?php
/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cat_name'); ?>
		<?php echo $form->textField($model,'cat_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
         <?php
         echo $form->label($model,'parent_id');
         $criteria = new CDbCriteria();
         $criteria->compare('parent_id',0);
         $list = CHtml::listData(Categories::model()->findAll($criteria),'id','cat_name');
         echo $form->dropDownList($model, 'parent_id', $list, array('empty' => Yii::t('site','Select')));
        ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('site','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->