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

<?php 

    if (User::model()->isCustomer()) {
        $view = '_form';
    }
    elseif (User::model()->isManager() || User::model()->isAdmin()) {
        $view = '_formManager';
    } else {
        throw new CHttpException(403);
    }
    
    $this->renderPartial($view, [
        'model'=>$model,
        'times'=>$times
        ]
    );
?>