<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 20.08.15
 * Time: 2:19
 */
Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl.'/js/manager.js');

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'buh_transaction',
    'dataProvider' => $dataProvider->search(),
    'filter'=>$dataProvider,
    'columns'=>array(
        'id',
        'order_id',
        'receive_date',
        'pay_date',
        'theme',
        'manager',
        'user',
        'summ',
        'details_ya',
        'details_wm',
        'details_bank',
        'payment_type',
        array(
            'class' => 'CButtonColumn',
            'template'=> '{approved} {for_approve} ',
            'buttons' => array(
                'for_approve' => array(
                    'label' => Yii::t('site','Confirm'),
                    'options' => array("class"=>"btn btn-primary btn-xs approve_payment"),
                    'visible' => '$data->approve == 0',
                    'click' => 'function(){setApprove($(this).attr("href"));return false;}',
                    'url'=>'$data->id',
                ),
                'approved' => array(
                    'label' => Yii::t('site','Confirmed'),
                    'visible' => '$data->approve == 1',
                ),
            ),
        ),
        'method',
    ),
));
?>
