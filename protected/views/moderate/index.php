<?php $this->widget('CGridView', [
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'name' => 'attribute',
            'value' => '(new $data->class_name)->getAttributeLabel($data->attribute)'
        ],
        [
            'name' => 'old_value',
            'type' => 'ntext'
        ],
        [
            'name' => 'new_value',
            'type' => 'ntext'
        ],
        'date_update',
        [
            'class' => 'CButtonColumn',
            'template' => '{approve}{delete}',
            'buttons' => [
                'approve' => [
                    'label' => '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
                    'url' => '["approve", "id"=>"$data->id"]',
                    'options' => [
                        'title'=>'Одобрить',
                        'class'=>'sendData'
                    ]
                ],
                'delete' => [
                    'label' => '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
                    'click' => 'function(){}',
                    'imageUrl' => null,
                    'options' => [
                        'title'=>'Отклонить',
                        'class'=>'sendData'
                    ]
                ],
            ]
        ]
    ]
]) ?>

<?php
Yii::app()->clientScript->registerScript('updateStatus',"
	$('.sendData').on('click', function() {
		$.post($(this).attr('href'));
        $(this).parent().html('Изменен');
		return false;
	});
");?>