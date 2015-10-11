<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>
<?php
/* @var $this ZakazController */
/* @var $model Zakaz */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs')=>array('index'),
	ProjectModule::t('List'),
);
//echo '<br>$model=';print_r($model);
/*
echo '<br>$dataProvider->data=';
print_r($dataProvider->data);
echo '<br>$dataProvider=';
print_r($dataProvider);
echo '<br>$dataProvider_done=';
print_r($dataProvider_done);
die();
*/
//echo '<br>$only_new='.$only_new;
?>
<h1><?=ProjectModule::t('Zakazs')?></h1>
<h1 class='projects-title'>Выбрать заказ</h1>
<?php
if (Campaign::getId()){
	$columns = array(
		'id',
		'title',
		'closestDate',
	);
} else {
	$columns = array(
        'id',
		'title',
		array(
           'name' => 'category_id',
           'type' => 'raw',
           'value' => 'isset($data->category) ? $data->category->cat_name : null'
        ),
		array(
           'name' => 'job_id',
           'type' => 'raw',
           'value' => 'isset($data->job) ? $data->job->job_name : null'
        ),
		[
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("чат", ["/project/chat", "orderId"=>$data->id])'
        ],
	);
}
if (!isset($only_new)) {

?>
<section>
	<div id="control-menu">
		<ul class="userMenu nav nav-tabs" id="yw0">
			<li class="active" id="first-tab-li">
				<a href="#" onclick="clickOnTab(0); return false;"><?= UserModule::t('CurrentProjects') ?></a>
			</li>
			<li id="second-tab-li">
				<a href="#" onclick="clickOnTab(1); return false;"><?= UserModule::t('DoneProjects') ?></a>
			</li>
		</ul>
	</div>
</section>
<script>
	function clickOnTab(num){
		if (num == 0){
			document.getElementById('first-tab').style.display = 'block';
			document.getElementById('second-tab').style.display = 'none';

			document.getElementById('first-tab').style.backgroundColor = '#FFFFFF';
			document.getElementById('second-tab').style.backgroundColor = '#EBF4FF';
			$('#first-tab-li').addClass('active');
			$('#second-tab-li').removeClass('active');
		} else {
			document.getElementById('first-tab').style.display = 'none';
			document.getElementById('second-tab').style.display = 'block';

			document.getElementById('first-tab').style.backgroundColor = '#FFFFFF';
			document.getElementById('second-tab').style.backgroundColor = '#EBF4FF';
			$('#first-tab-li').removeClass('active');
			$('#second-tab-li').addClass('active');
		};	
	};	
</script>


<style>
.first-tab{
	float:	left;
	width:	100%;
}
.second-tab{
	float:	left;
	width:	100%;
	display:	none;
}
</style>

<div class="twin-tab">
<div class="first-tab" id="first-tab">



<?php
	}; //if (!isset($only_new)) {


	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'zakaz-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,

		'columns'=>$columns,
		'rowHtmlOptionsExpression'=>'array("style" => "cursor:pointer")',
		'selectionChanged'=>"js:function(sel_id){
			document.location.href='".Yii::app()->createUrl('/project/chat',array('orderId'=>''))."'+$('#'+sel_id).find('.selected').children().first().text();
		}",
	)); 
if (!isset($only_new)) {
?>
</div>
<div class="second-tab" id="second-tab">
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'zakaz-grid-done',
		'dataProvider'=>$model_done->search(),
		'filter'=>$model_done,
		'columns'=>$columns,
		'rowHtmlOptionsExpression'=>'array("style" => "cursor:pointer")',
		'selectionChanged'=>"js:function(sel_id){
			document.location.href='".Yii::app()->createUrl('/project/chat',array('orderId'=>''))."'+$('#'+sel_id).find('.selected').children().first().text();
		}",
	)); 

	echo '</div>';
	}; //if (!isset($only_new)) 
?>
<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#zakaz-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#zakaz-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '/project/chat?orderId=' + rowId;
        });
    });
    $(document).ready(function()
    {
        $('body').on('dblclick', '#zakaz-grid-done tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#zakaz-grid-done > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '/project/chat?orderId=' + rowId;
        });
    });
	
</script>