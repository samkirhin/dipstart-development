<div class="col-md-12">
<?php
$columns = array('date','uid','user.email',
					array(	'name'=>'action',
							'type'=>'raw',
							'value'=>'$data->action.": ".ManagerLog::getLabel("action_".$data->action)'
					),
					array(	'name'=>'order_id',
							'type'=>'raw',
							'value'=>'"<a href=\"/project/zakaz/update/id/".$data->order_id."\">".$data->order_id."</a>"'
					),
				);
?>
<div id="grid">
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'manager_logs_list',
	'dataProvider'=>$model->with('user')->search(),
    'filter'=>$model,
	'ajaxUpdate' => true,
    'columns'=>$columns,
    'ajaxType'=>'POST',
    'rowHtmlOptionsExpression'=>'array("style" => "cursor:pointer")',
    /*'selectionChanged'=>"js:function(id){
        document.location.href=$('.selected').find('td').find('a.update').attr('href');
    }",*/
));
?>
</div>
</div>