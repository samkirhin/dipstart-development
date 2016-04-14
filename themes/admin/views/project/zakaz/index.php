<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>

<div class="row white-bg inside-block">
<div class="col-md-12">
<div class="link-for-executors">
	<?=ProjectModule::t('Link for freelancers') ?>: <a href="/project/zakaz/list"><?='http://'.$_SERVER['SERVER_NAME'].'/project/zakaz/list'?></a>
</div>
<?php
$this->breadcrumbs=array(
	ProjectModule::t('Zakazs'),
);
/*
$projectFields = $model->getFields();
if ($projectFields) {
	foreach($projectFields as $field) {
		if ($field->field_type=="LIST"){
			$varname = $field->varname;
			$columns[] = array(
					'name'=>$varname,
					'filter'=>Catalog::getAll($varname),
					'value'=>'$data->catalog_'.$varname.'->cat_name',
				);
		} elseif ($field->varname != 'soderjanie' && $field->varname != 'description'  && $field->varname !='opisanie') { // !!! Сделать настраиваемым
			$columns[] = $field->varname;
		}
	}
} */
?>
<div id="grid">
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'order_list',
	'dataProvider'=>$model->search(),
    'filter'=>$model,
	'ajaxUpdate' => true,
//    'afterAjaxUpdate' => 'reinstallDatePicker',
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
        $('body').on('dblclick', '#order_list tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#order_list > div.keys > span'),
                rowId = keys.eq(rowNum).text();
   if (rowId.length>0)
            location.href = '/project/zakaz/update/id/' + rowId;
        });
    });
</script>
</div>
    </div>
</div>
<?php


/*
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('[id ^= Zakaz_db]').datepicker(jQuery.extend(jQuery.datepicker.regional['ru']));
}
");
*/