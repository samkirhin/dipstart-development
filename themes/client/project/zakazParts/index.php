<?php
/* @var $this ZakazPartsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Zakaz Parts',
);

$this->menu=array(
	array('label'=>'Create ZakazParts', 'url'=>array('create')),
	array('label'=>'Manage ZakazParts', 'url'=>array('admin')),
);
?>

<h1>Zakaz Parts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
