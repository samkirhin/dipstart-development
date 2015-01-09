<?php
/* @var $this ZakazController */
/* @var $model Zakaz */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs')=>array('index'),
	ProjectModule::t('Create'),
);

$this->menu=array(
	array('label'=>ProjectModule::t('List Zakaz'), 'url'=>array('index')),
	array('label'=>ProjectModule::t('Manage Zakaz'), 'url'=>array('admin')),
);
?>

<h1><?=ProjectModule::t('Create Zakaz')?></h1>

<?php if (User::model()->isCustomer())
    $this->renderPartial('_form', array('model'=>$model));
 elseif (User::model()->isManager() || User::model()->isAdmin())
    $this->renderPartial('_formManager', array('model'=>$model));
?>