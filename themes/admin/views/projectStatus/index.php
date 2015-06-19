<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>
<div class="row white-block">
<?php
/* @var $this ProjectStatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('site','Project Statuses')
);

$this->menu=array(
	array('label'=>Yii::t('site','Create ProjectStatus'), 'url'=>array('create')),
	array('label'=>Yii::t('site','Manage ProjectStatus'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('site','Project Statuses')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>