<?php
/*$this->breadcrumbs=array(
	UserModule::t('Project Fields')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	UserModule::t('Update'),
);*/
$this->menu=array(
    array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('create')),
    array('label'=>UserModule::t('View Profile Field'), 'url'=>array('view','id'=>$model->id)),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
);
$this->widget('zii.widgets.CMenu', array(
	'items'=>$this->menu,
	'htmlOptions'=>array('class'=>'operations'),
));
?>

<h1><?php echo UserModule::t('Update Project Field ').$model->id; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>