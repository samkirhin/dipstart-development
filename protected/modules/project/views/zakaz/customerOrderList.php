<h1><?=ProjectModule::t('Zakazs')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'zakaz-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
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
	),
)); ?>