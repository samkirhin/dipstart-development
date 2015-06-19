<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>
<div class="row white-block">
<?php
/* @var $this CategoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('site','Categories'),
);

$this->menu=array(
	array('label'=>Yii::t('site','Create Categories'), 'url'=>array('create')),
	array('label'=>Yii::t('site','Manage Categories'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('site','Categories')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>