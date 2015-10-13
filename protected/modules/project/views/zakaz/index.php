<?php
$this->breadcrumbs=array(ProjectModule::t('Zakazs'));
?>
<div id="grid">
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
