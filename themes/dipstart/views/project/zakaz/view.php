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

?>

<h1><?=ProjectModule::t('View Zakaz')?> #<?php echo $model->id; ?></h1>
<?php
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
       'value' => $model->job_id > 0 ? Jobs::model()->findByPk($model->job_id)->job_name : null,
    ),
    'title',
    'text',
    array(
        'name'=>'date',
        'value'=>$model->dbdate,
    ),
    array(
        'name'=>'max_exec_date',
        'value'=>$model->dbmax_exec_date,
    ),
    'pages',
    'add_demands',
);
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$attr,
)); ?>
<?php /*
    $this->widget('application.modules.project.widgets.zakazParts.ZakazPartWidget', array(
    'projectId'=>$model->id,
    'userType'=>'1',
    'action'=>'show'
));*/?>
