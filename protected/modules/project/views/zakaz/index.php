<?php
/* @var $this ZakazController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs'),
);

$this->menu=array(
	array('label'=>ProjectModule::t('Create Zakaz'), 'url'=>array('create')),
	array('label'=>ProjectModule::t('Manage Zakaz'), 'url'=>array('admin')),
);
?>

<h1><?=ProjectModule::t('Zakazs')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
