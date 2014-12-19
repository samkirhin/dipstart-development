<?php
/* @var $this JobsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('site','Jobs'),
);

$this->menu=array(
	array('label'=>Yii::t('site','Create Jobs'), 'url'=>array('create')),
	array('label'=>Yii::t('site','Manage Jobs'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('site','Jobs')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
