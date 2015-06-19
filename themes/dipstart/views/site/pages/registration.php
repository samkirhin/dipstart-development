<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 28.05.15
 * Time: 14:55
 */
$this->pageTitle = Yii::app()->name . ' - Регистрация';
$this->breadcrumbs = array(
    'Регистрация',
);
?>
<div class="row">
    <div class="col-xs-6"><a class="btn btn-default btn-block btn-adminka" href="<?= $this->createUrl('/user/registration',array('role'=>'Author')) ?>">Автор</a></div>
    <div class="col-xs-6"><a class="btn btn-default btn-block btn-adminka" href="<?= $this->createUrl('/user/registration',array('role'=>'Customer')) ?>">Заказчик</a></div>
</div>