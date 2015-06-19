<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>

<div class="row white-bg inside-block">
<div class="col-md-12">
<?php
$this->breadcrumbs=array(
	ProjectModule::t('Zakazs'),
);
?>
<div id="grid">
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'order_list',
	'dataProvider'=>$model->search(),
    'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'columns'=>array(
        'id',
        //'status',
        'title',
        'jobName',
        'catName',
        array(
            'name'=>'date',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'dbdate',
                'language'=>'ru',
                'defaultOptions'=>array(
                    'dateFormat'=>'dd.mm.yy',
                    'regional'=>'ru',
                ),
            ),
            true),
            'value'=>'$data->dbdate'
        ),
        array(
            'name'=>'manager_informed',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'dbmanager_informed',
                'language'=>'ru',
                'defaultOptions'=>array(
                    'dateFormat'=>'dd.mm.yy',
                    'regional'=>'ru',
                ),
            ),
                true),
            'value'=>'$data->dbmanager_informed',
        ),
        array(
            'name'=>'date_finish',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'dbdate_finish',
                'language'=>'ru',
                'defaultOptions'=>array(
                    'dateFormat'=>'dd.mm.yy',
                    'regional'=>'ru',
                ),
            ),
                true),
            'value'=>'$data->dbdate_finish',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}{update}',
        ),
    ),
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
    $('#Zakaz_dbdate').datepicker(jQuery.extend(jQuery.datepicker.regional['ru']));
}
");