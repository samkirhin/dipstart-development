<div class="col-md-12">
<?php
$columns = array('id','frozen','name','domains');
$columns[] = array(
		'class'=>'CButtonColumn',
		'template'=>'{update}',
		'buttons'=>array(
			'update'=>array(
				'url'=>'Yii::app()->createUrl("company/edit", array("id"=>$data->id))',
			),
		),
	);
?>
<div id="grid">
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'companies_list',
	'dataProvider'=>$model->search(),
    'filter'=>$model,
	'ajaxUpdate' => true,
    'columns'=>$columns,
    'ajaxType'=>'POST',
    'rowHtmlOptionsExpression'=>'array("style" => "cursor:pointer")',
    'selectionChanged'=>"js:function(id){
        document.location.href=$('.selected').find('td').find('a.update').attr('href');
    }",
));
?>
<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#companies_list tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#companies_list > div.keys > span'),
                rowId = keys.eq(rowNum).text();
   if (rowId.length>0)
            location.href = '/company/edit/id/' + rowId;
        });
    });
</script>
</div>
</div>