<?php
$this->breadcrumbs=array(
	UserModule::t('Profile Fields')=>array('admin'),
	UserModule::t($model->title),
);
$this->menu=array(
    array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('create')),
    array('label'=>UserModule::t('Update Profile Field'), 'url'=>array('update','id'=>$model->id)),
    array('label'=>UserModule::t('Delete Profile Field'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
);
$this->widget('zii.widgets.CMenu', array(
	'items'=>$this->menu,
	'htmlOptions'=>array('class'=>'operations'),
));
?>
<h1><?php
//echo UserModule::t('View Project Field #').$model->varname;
echo UserModule::t('FieldOfOrders').' "'.$model->varname.'"';
?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'varname',
		'title',
		'field_type',
		'field_size',
		'required',
		'error_message',
		'default',
		'position',
		'visible',
	),
)); ?>
