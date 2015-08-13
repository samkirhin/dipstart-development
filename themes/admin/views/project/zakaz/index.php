<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>

<div class="row white-bg inside-block">
<div class="col-md-12">
<?php
$this->breadcrumbs=array(
	ProjectModule::t('Zakazs'),
);

if (Campaign::getId()){
	$columns = array(
		'id',
		'title',
        array(
            'name'=>'date',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'dbdate',
                'language'=>'ru',
                ),true),
            'value'=>'$data->dbdate'
        ),
        array(
            'name'=>'manager_informed',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'dbmanager_informed',
                'language'=>'ru',
                ), true),
            'value'=>'$data->dbmanager_informed',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}{update}',
        ),
	);
} else {
	$columns = array(
        'id',
        array(
            'name'=>'status',
            'filter'=>ProjectStatus::getAll(),
            'value'=>'$data->statusName',
        ),
        'title',
        array(
            'name'=>'jobName',
            'filter'=>Jobs::getAll(),
            'value'=>'$data->jobName'
        ),
        array(
            'name'=>'catName',
            'filter'=>Categories::getAll(),
        ),
        array(
            'name'=>'date',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'dbdate',
                'language'=>'ru',
                ),true),
            'value'=>'$data->dbdate'
        ),
        array(
            'name'=>'manager_informed',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'dbmanager_informed',
                'language'=>'ru',
                ), true),
            'value'=>'$data->dbmanager_informed',
        ),
        array(
            'name'=>'date_finish',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'dbdate_finishstart',
                'language'=>'ru',
                ), true).$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'dbdate_finishend',
                    'language'=>'ru',
                ), true),
            'value'=>'$data->dbdate_finish',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}{update}',
        ),
	);
}
?>
<div id="grid">
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'order_list',
	'dataProvider'=>$model->search(),
    'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'columns'=>$columns,
    'ajaxType'=>'POST',
    'rowHtmlOptionsExpression'=>'array("style" => "cursor:pointer")',
    'selectionChanged'=>"js:function(id){
        document.location.href=$('.selected').find('td').find('a.update').attr('href');
    }",
));
?>
</div>
    </div>
</div>
<?php
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('[id ^= Zakaz_db]').datepicker(jQuery.extend(jQuery.datepicker.regional['ru']));
}
");