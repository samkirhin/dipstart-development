<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
?>
<div class="thanks-for-order-message">
    <?=ProjectModule::t('Thank you for order.')?>
</div>

<h1><?=ProjectModule::t('View Zakaz')?> #<?php echo $model->id; ?></h1>

<?php
$this->renderPartial('/zakaz/_view', array('model' => $model));

/*
    $this->widget('application.modules.project.widgets.zakazParts.ZakazPartWidget', array(
    'projectId'=>$model->id,
    'userType'=>'1',
    'action'=>'show'
));*/?>
