<?php
/* @var $this ZakazPartsController */
/* @var $model ZakazParts */

$this->breadcrumbs=array(
	'Zakaz Parts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ZakazParts', 'url'=>array('index')),
	array('label'=>'Create ZakazParts', 'url'=>array('create')),
	array('label'=>'View ZakazParts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ZakazParts', 'url'=>array('admin')),
);
?>

<h1>Update ZakazParts <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>