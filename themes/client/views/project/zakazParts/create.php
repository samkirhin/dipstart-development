<?php
/* @var $this ZakazPartsController */
/* @var $model ZakazParts */

$this->breadcrumbs=array(
	ProjectModule::t('Zakaz Parts')=>array('index'),
	ProjectModule::t('Create'),
);

$this->menu=array(
	array('label'=>ProjectModule::t('List ZakazParts'), 'url'=>array('index')),
	array('label'=>ProjectModule::t('Manage ZakazParts'), 'url'=>array('admin')),
);
?>

<h1><?=ProjectModule::t('Create ZakazParts')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>