<?php
/* @var $this PartStatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('site','Part Statuses')
);

$this->menu=array(
	array('label'=>Yii::t('site','Create PartStatus'), 'url'=>array('create')),
	array('label'=>Yii::t('site','Manage PartStatus'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('site','Part Statuses')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
