<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>
<div class="row white-block">
<?php
/* @var $this TemplatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('site','Templates'),
);

$this->menu=array(
	array('label'=>Yii::t('site','Create Templates'), 'url'=>array('create')),
	array('label'=>Yii::t('site','Manage Templates'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('site','Templates')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>
