<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $profile Profile */

$user = User::model();
$author = $model->author->profile;
$customer = $model->user->profile;

$this->breadcrumbs = array(
    ProjectModule::t('Zakazs') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    ProjectModule::t('Update'),
);
?>

    <h1><?= ProjectModule::t('Update Zakaz') ?> <?php echo $model->id; ?></h1>
    <?php if ($isModified) echo '<span class="label label-warning" style="font-size:16px;"><b>Заказ на модерации</b></span>';?>

    <div>
        Автор <br>
        <?= $author->firstname ?> <?= $author->lastname ?> <br>
        <?= $model->author->email ?> <br>
        <?= $author->mob_tel ?>
    </div>

    <div>
        Заказчик<br>
        <?= $customer->firstname ?> <?= $customer->lastname ?> <br>
        <?= $model->user->email ?> <br>
        <?= $customer->mob_tel ?>
    </div>

<?php
    $this->widget('application.modules.project.widgets.payment.PaymentWidget', array(
        'projectId'=>$model->id
    ));
?>
<?php if ($user->isCustomer()) {
    $this->renderPartial('_form', array('model' => $model, 'times' => $times));
} elseif ($user->isManager() || $user->isAdmin()) {
    $this->renderPartial('_formUpdateManager', array('model' => $model, 'times' => $times));
}
?>

    <h3 ><?php echo ProjectModule::t('Changes'); ?></h3>

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
