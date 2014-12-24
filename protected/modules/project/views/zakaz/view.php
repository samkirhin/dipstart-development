<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
$filelist = Yii::app()->fileman->list_files($model->id);
    foreach ($filelist as $fd) {
      $real_path = Yii::app()->fileman->get_file_path($fd['id'], $fd['file_id']);
      $files .= CHtml::link($fd['filename'], array('zakaz/download', 'path' => $real_path)).'&nbsp;&nbsp;';
      //echo EDownloadHelper::download($real_path);
}
$this->breadcrumbs=array(
	ProjectModule::t('Zakazs')=>array('index'),
	$model->title,
);
if (User::model()->isAdmin() || User::model()->isManager()){
$this->menu=array(
	array('label'=>ProjectModule::t('List Zakaz'),  'url'=>array('index')),
	array('label'=>ProjectModule::t('Create Zakaz'), 'url'=>array('create')),
	array('label'=>ProjectModule::t('Update Zakaz'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>ProjectModule::t('Delete Zakaz'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>ProjectModule::t('Manage Zakaz'), 'url'=>array('admin')),
);
} else {
$this->menu=array(
    array('label'=>ProjectModule::t('Last Zakaz'), 'url'=>array('/project/zakaz/list', 'status' => '2'), 'visible'=>User::model()->isAuthor()),
    array('label'=>ProjectModule::t('My Zakaz'), 'url'=>array('/project/zakaz/list', 'status' => '4', 'user_id' => Yii::app()->user->id), 'visible'=>User::model()->isAuthor()),
    array('label'=>Yii::t('site','Create Zakaz'), 'url'=>array('/project/zakaz/create'), 'visible'=> User::model()->isCustomer()),
);
}
?>

<h1><?=ProjectModule::t('View Zakaz')?> #<?php echo $model->id; ?></h1>
<?php if (User::model()->isManager() || User::model()->isAdmin()){
$attr = array(
        'id',
		array(
           'name' => 'user_id',
           'type' => 'raw',
           'value' => User::model()->findByPk($model->user_id)->username,
        ),
		array(
           'name' => 'category_id',
           'type' => 'raw',
           'value' => Categories::model()->findByPk($model->category_id)->cat_name,
        ),
		array(
           'name' => 'job_id',
           'type' => 'raw',
           'value' => Jobs::model()->findByPk($model->job_id)->job_name,
        ),
		'title',
		'text',
		'date',
		'max_exec_date',
		'date_finish',
		'pages',
		'budget',
        'with_prepayment',
        'customer_price',
        'author_price',
        'author_payed',
		'add_demands',
		array(
           'name' => 'status',
           'type' => 'raw',
           'value' => ProjectStatus::model()->findByPk($model->status)->status,
        ),
        'is_payed',
        'informed',
        'notes',
        
    );
}else{
$attr = array(
        'id',
		array(
           'name' => 'user_id',
           'type' => 'raw',
           'value' => User::model()->findByPk($model->user_id)->username,
        ),
		array(
           'name' => 'category_id',
           'type' => 'raw',
           'value' => Categories::model()->findByPk($model->category_id)->cat_name,
        ),
		array(
           'name' => 'job_id',
           'type' => 'raw',
           'value' => Jobs::model()->findByPk($model->job_id)->job_name,
        ),
		'title',
		'text',
		'date',
		'max_exec_date',
		//'date_finish',
		'pages',
		'budget',
        'with_prepayment',
        //'customer_price',
        //'author_price',
        //'author_payed',
		'add_demands',
		array(
           'name' => 'status',
           'type' => 'raw',
           'value' => ProjectStatus::model()->findByPk($model->status)->status,
        ),
        //'is_payed',
        //'informed',
        //'notes',
        
    );
}
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$attr,
)); ?>
<?php
    $this->widget('application.modules.project.widgets.zakazParts.ZakazPartWidget', array(
    'projectId'=>$model->id,
    'userType'=>'1',
    'action'=>'show'
));?>
