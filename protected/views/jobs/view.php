<?php
/* @var $this JobsController */
/* @var $model Jobs */

$this->breadcrumbs=array(
	Yii::t('site','Jobs')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('site','List Jobs'), 'url'=>array('index')),
	array('label'=>Yii::t('site','Create Jobs'), 'url'=>array('create')),
	array('label'=>Yii::t('site','Update Jobs'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('site','Delete Jobs'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('site','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('site','Manage Jobs'), 'url'=>array('admin')),
);
?>

<h1><?= Yii::t('site', 'View Jobs').' #'.$model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'job_name',
	),
)); ?>
