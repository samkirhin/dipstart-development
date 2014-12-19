<?php
/* @var $this ZakazController */
/* @var $model Zakaz */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs')=>array('index'),
	ProjectModule::t('List'),
);
if (User::model()->isAdmin() || User::model()->isManager()){
  $this->menu=array(
	array('label'=>ProjectModule::t('Last Zakaz'), 'url'=>array('/project/zakaz/list', 'status' => '2'), 'visible'=>User::model()->isAuthor()),
    array('label'=>Yii::t('site','Create Zakaz'), 'url'=>array('/project/zakaz/create'), 'visible'=> User::model()->isCustomer()),
);
}elseif (User::model()->isCustomer() || User::model()->isAuthor()){
$this->menu=array(

	array('label'=>ProjectModule::t('Last Zakaz'), 'url'=>array('/project/zakaz/list', 'status' => '2'), 'visible'=>User::model()->isAuthor()),
    array('label'=>ProjectModule::t('My Zakaz'), 'url'=>array('/project/zakaz/list', 'status' => '4', 'user_id' => Yii::app()->user->id), 'visible'=>User::model()->isAuthor()),
    array('label'=>Yii::t('site','Create Zakaz'), 'url'=>array('/project/zakaz/create'), 'visible'=> User::model()->isCustomer()),
);
}
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
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
           'name' => 'user_id',
           'type' => 'raw',
           'value' => 'User::model()->findByPk($data->user_id)->username',
        ),
		array(
           'name' => 'category_id',
           'type' => 'raw',
           'value' => 'Categories::model()->findByPk($data->category_id)->cat_name',
        ),
		array(
           'name' => 'job_id',
           'type' => 'raw',
           'value' => 'Jobs::model()->findByPk($data->job_id)->job_name',
        ),
		'title',
		/*'text',
		'file',
		'date',
		'max_exec_date',
		'date_finish',
		'pages',
		'budget',
		'add_demands',
		'is_payed',
		'with_prepayment',
		'status',
		'executor',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}',
		),
	),
)); ?>
