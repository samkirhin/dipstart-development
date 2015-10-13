<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>
<?php

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs'),
);
?>
<div id="grid" class="white-block">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'title',
        'jobName',
        'catName',
        'dateCreation',
        'managerInformed',
        'dateFinish',
    ),
    'ajaxType'=>'POST',
    'ajaxUpdate'=>'grid',
));
?>
</div>
