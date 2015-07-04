<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 21.06.15
 * Time: 17:19
 */
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => Zakaz::model()->search_upd(),
    'id' => 'order_list_update',
    'columns' => array('id', 'title', 'jobName', 'catName',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}',
        ),
    ),
    'ajaxType' => 'POST',
    'rowHtmlOptionsExpression' => 'array("style" => "cursor:pointer")',
    'selectionChanged' => "js:function(id){
                document.location.href=$('.selected').find('td').find('a.update').attr('href');
            }",
));
