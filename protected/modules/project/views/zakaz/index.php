<?php
/* @var $this ZakazController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs'),
);

$this->menu=array(
	array('label'=>ProjectModule::t('Create Zakaz'), 'url'=>array('create')),
	array('label'=>ProjectModule::t('Manage Zakaz'), 'url'=>array('admin')),
);
?>

<h1><?=ProjectModule::t('Zakazs')?></h1>
<table class="table table-bordered">
    <thead>
        <th>
            id
        </th>
        <th>
            Заказчик
        </th>
        <th>
            Категория
        </th>
        <th>
            Тип
        </th>
        <th>
            Название
        </th>
        <th>
            Создан
        </th>
        <th>
            Срок до
        </th>
        <th>
            Статус
        </th>
        
    </thead>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</table>