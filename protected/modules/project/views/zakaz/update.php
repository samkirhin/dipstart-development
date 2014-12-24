<?php
/* @var $this ZakazController */
/* @var $model Zakaz */

$user = User::model();
$this->breadcrumbs = array(
    ProjectModule::t('Zakazs') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    ProjectModule::t('Update'),
);
$this->menu = array(
    array('label' => ProjectModule::t('List Zakaz'), 'url' => array('index')),
    array('label' => ProjectModule::t('Create Zakaz'), 'url' => array('create')),
    array('label' => ProjectModule::t('View Zakaz'), 'url' => array('view', 'id' => $model->id)),
    array('label' => ProjectModule::t('Manage Zakaz'), 'url' => array('admin')),
    array('label' => ProjectModule::t('Add Zakaz Part'), 'url' => array('create', 'id' => $model->id)),
);
?>

    <h1><?= ProjectModule::t('Update Zakaz') ?> <?php echo $model->id; ?></h1>
<?php
    $this->widget('application.modules.project.widgets.payment.PaymentWidget', array(
        'projectId'=>$model->id
    ));
?>
<?php if ($user->isCustomer()) {
    $this->renderPartial('_form', array('model' => $model));
} elseif ($user->isManager() || $user->isAdmin()) {
    $this->renderPartial('_formManager', array('model' => $model));
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