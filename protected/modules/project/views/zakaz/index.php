<?php
$this->breadcrumbs=array(ProjectModule::t('Zakazs'));
?>
<div id="grid">
<?php 

	$sort = new CSort();
	$sort->attributes = array(
		'asc' => 'date',
		'desc' => 'date DESC',
	);
	$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
    'filter'=>$model,
    'filterModel'=>$model,
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
    'ajaxUrl'=>'project/zakaz',
));
?>
</div>
