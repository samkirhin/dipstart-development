<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>
<?php
/*<script src="/js/bookkeeper.js"></script>
<script src="/js/jquery.tmpl.min.js"></script>
<div id="bookkeeperView">
<script class="bookkeeperTableTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td>
                <a href="index.php?r=project/zakaz/update&id=${id}">${id}</a>
            </td>
            <td>
                ${title}
            </td>
            <td>
                ${job_name}
            </td>
            <td>
                ${cat_name}
            </td>
            <td>
                ${date}
            </td>
            <td>
                ${manager_informed}
            </td>
            <td>
                ${date_finish}
            </td>
        </tr>
    </script>
<?php
/* @var $this ZakazController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs'),
);
?>
<div id="grid" class="white-block">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'title',
        'jobName',
        'catName',
        'dateCreation',
        'managerInformed',
        'dateFinish',
    ),
    'ajaxType'=>'POST',
    'ajaxUpdate'=>'grid',
));
?>
</div>
