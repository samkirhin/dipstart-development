<?php
/* @var $this JobsController */
/* @var $model Jobs */

$this->breadcrumbs=array(
	Yii::t('site','Jobs')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('site','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('site','List Jobs'), 'url'=>array('index')),
	array('label'=>Yii::t('site','Create Jobs'), 'url'=>array('create')),
	array('label'=>Yii::t('site','View Jobs'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('site','Manage Jobs'), 'url'=>array('admin')),
);
?>

<h1><?= Yii::t('site','Update Jobs').' '.$model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>