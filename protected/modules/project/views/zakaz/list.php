<?php
/* @var $this ZakazController */
/* @var $model Zakaz */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs')=>array('index'),
	ProjectModule::t('List'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#zakaz-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=ProjectModule::t('Zakazs')?></h1>

<p>
<?=ProjectModule::t('You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.')?>
</p>

<?php echo CHtml::link(ProjectModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'zakaz-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		array(
           'name' => 'user_id',
           'type' => 'raw',
           'value' => '$data->user->username'
        ),
		array(
           'name' => 'category_id',
           'type' => 'raw',
           'value' => 'isset($data->category) ? $data->category->cat_name : ""'
        ),
		array(
           'name' => 'job_id',
           'type' => 'raw',
           'value' => 'isset($data->job) ? $data->job->job_name : ""'
        ),
		'title',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}'
		),
	),
)); ?>
