<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>

    <div class="col-md-12">
        <h3><?=ProjectModule::t('Zakazs')?></h3>
    </div>


<?php 
if (Campaign::getId()){
	$columns = array(
		'id',
		'title',
	);
} else {
	$columns = array(
        'id',
        [
            'name' => 'category_id',
            'value' => 'isset($data->category) ? $data->category->cat_name : ""'
        ],
        [
            'name' => 'job_id',
            'value' => 'isset($data->job) ? $data->job->job_name : ""'
        ],
        'title',
        [
            'name' => 'date',
            'value' => 'Yii::app()->dateFormatter->formatDateTime($data->date)'
        ],
        [
            'name' => 'max_exec_date',
            'value' => 'Yii::app()->dateFormatter->formatDateTime($data->max_exec_date)'
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("чат", ["/project/chat", "orderId"=>$data->id])'
        ],
	);
}
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'zakaz-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>$columns,
    'htmlOptions'=>array('class'=>'col-md-12 table table-striped'),
    'rowHtmlOptionsExpression'=>'array("style" => "cursor:pointer")',
    'selectionChanged'=>"js:function(sel_id){
        document.location.href='".Yii::app()->createUrl('/project/chat',array('orderId'=>''))."'+$('#'+sel_id).find('.selected').children().first().text();
    }",
)); ?>