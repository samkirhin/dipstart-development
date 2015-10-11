<?php 
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>
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
?>

<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'zakaz-grid-current',
//		'dataProvider'=>$model->search(),
//		'filter'=>$model,
		'dataProvider'=>$dataProvider,
//		'filter'=>$model,
		'columns'=>$columns,
		//'enablePagination' => false,
		'htmlOptions'=>array('class'=>'col-md-12 table table-striped'),
		'rowHtmlOptionsExpression'=>'array("style" => "cursor:pointer")',
		'selectionChanged'=>"js:function(sel_id){
			document.location.href='".Yii::app()->createUrl('/project/chat',array('orderId'=>''))."'+$('#'+sel_id).find('.selected').children().first().text();
		}",
	)); 
?>
<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#zakaz-grid-current tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#zakaz-grid-current > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '/project/chat?orderId=' + rowId;
        });
    });
	
</script>