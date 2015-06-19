<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	Yii::t('site','Categories')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('site','Update')
);

$this->menu=array(
	array('label'=>Yii::t('site','List Categories'), 'url'=>array('index')),
	array('label'=>Yii::t('site','Create Categories'), 'url'=>array('create')),
	array('label'=>Yii::t('site','View Categories'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('site','Manage Categories'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('site','Update Categories').' '.$model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>