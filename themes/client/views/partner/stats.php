<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>
<div id="partner-stats-grid" class="white-block">
<?php echo CHtml::dropDownList('month', $chosen_month, $months, array('onchange'=>'js:window.location.search="chosen_month="+this.value;')); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => WebmasterLog::getLabel('date'),
			'type' => 'raw',
			'value' => 'CHtml::encode($data["date"])'
		),
		array(
			'name' => WebmasterLog::getLabel('unique'),
			'type' => 'raw',
			'value' => 'CHtml::encode($data["unique"])'
		),
		array(
			'name' => WebmasterLog::getLabel('sales_first'),
			'type' => 'raw',
			'value' => 'CHtml::encode($data["sales_first"])'
		),
		array(
			'name' => WebmasterLog::getLabel('sales_repeat'),
			'type' => 'raw',
			'value' => 'CHtml::encode($data["sales_repeat"])'
		),
		array(
			'name' => WebmasterLog::getLabel('completed_first'),
			'type' => 'raw',
			'value' => 'CHtml::encode($data["completed_first"])'
		),
		array(
			'name' => WebmasterLog::getLabel('completed_repeat'),
			'type' => 'raw',
			'value' => 'CHtml::encode($data["completed_repeat"])'
		),
		array(
			'name' => WebmasterLog::getLabel('profit'),
			'type' => 'raw',
			'value' => 'CHtml::encode($data["profit"])'
		),
	),
));
?>
</div>