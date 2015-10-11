<?php
/* @var $this ZakazController */
/* @var $model Zakaz */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs')=>array('index'),
	ProjectModule::t('List'),
);
?>

<h1><?=ProjectModule::t('Zakazs')?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'zakaz-grid',
//	'dataProvider'=>$model->search(),
	'dataProvider'=> $dataProvider,
	//'filter'=>$model,
	'columns'=>array(
        'id',
		'title',
		array(
           'name' => 'category_id',
           'type' => 'raw',
           'value' => 'isset($data->category) ? $data->category->cat_name : null'
        ),
		array(
           'name' => 'job_id',
           'type' => 'raw',
           'value' => 'isset($data->job) ? $data->job->job_name : null'
        ),
		[
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("чат", ["/project/chat", "orderId"=>$data->id])'
        ],
	),
)); ?>
