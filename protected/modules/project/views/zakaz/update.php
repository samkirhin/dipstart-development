<?php
/* @var $this ZakazController */
/* @var $model Zakaz */

$user = User::model();
$this->breadcrumbs = array(
    ProjectModule::t('Zakazs') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    ProjectModule::t('Update'),
);
?>

    <h1><?= ProjectModule::t('Update Zakaz') ?> <?php echo $model->id; ?></h1>

<?php
    $this->widget('application.modules.project.widgets.payment.PaymentWidget', array(
        'projectId'=>$model->id
    ));
?>
<?php if ($user->isCustomer()) {
    $this->renderPartial('_form', array('model' => $model, 'times' => $times));
} elseif ($user->isManager() || $user->isAdmin()) {
    $this->renderPartial('_formManager', array('model' => $model, 'times' => $times));
}
?>

    <h3><?php echo ProjectModule::t('Changes'); ?></h3>

<?php
    $this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
        'project' => $model,
    ))
?>
<?php
    $this->widget('application.modules.project.widgets.zakazParts.ZakazPartWidget', array(
        'projectId'=>$model->id,
        'userType'=>'1',
        'action'=>'edit'
    ));
?>
