<?php
/* @var $this JobsController */
/* @var $model Jobs */

$this->breadcrumbs=array(
	Yii::t('site','Jobs')=>array('index'),
	Yii::t('site','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('site','List Jobs'), 'url'=>array('index')),
	array('label'=>Yii::t('site','Manage Jobs'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('site','Create Jobs')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>