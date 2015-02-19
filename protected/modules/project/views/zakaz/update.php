<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $profile Profile */
/* @var $author User */
/* @var $customer User */

$user = User::model();
$author = $model->author;
$customer = $model->user;

$this->breadcrumbs = array(
    ProjectModule::t('Zakazs') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    ProjectModule::t('Update'),
);
?>

    <h1><?= ProjectModule::t('Update Zakaz') ?> <?php echo $model->id; ?></h1>
    <?php if ($isModified) echo '<span class="label label-warning" style="font-size:16px;"><b>Заказ на модерации</b></span>';?>
    
    <span class="label label-warning" style="font-size:16px;"><b><?= $message; ?></b></span>

    <?php if ($author): ?>
    <div>
        Автор <br>
        <?= $author->profile->firstname ?> <?= $author->profile->lastname ?> <br>
        <?= $author->email ?> <br>
        <?= $author->profile->mob_tel ?>
    </div>
    <?php endif; ?>

    <div>
        Заказчик<br>
        <?= $customer->profile->firstname ?> <?= $customer->profile->lastname ?> <br>
        <?= $customer->email ?> <br>
        <?= $customer->profile->mob_tel ?>
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
