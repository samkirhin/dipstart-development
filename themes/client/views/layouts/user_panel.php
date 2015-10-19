<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 06.04.15
 * Time: 0:49
 */
?>
<p style="margin: 10px 0 0 0"><?= UserModule::t('For our users') ?></p>
<?php if (Yii::app()->user->isGuest): ?>
<?php
    echo CHtml::link(UserModule::t('Registration').'<br>',array('/site/page','view'=>'registration'));
    echo CHtml::link(UserModule::t('Login').'<br>',array('/user/login'),array('data-toggle'=>'modal','data-target'=>'#loginModalForm',));
    echo CHtml::link(UserModule::t('Restore a password'),array('/user/recovery'),array('data-toggle'=>'modal','data-target'=>'#loginModalForm',));
?>
<!-- Login Form -->
<?php
//Подключаем виджет модального окна
$this->beginWidget('application.extensions.booster.widgets.TbModal', array(
    'id'=>'loginModalForm',
));
$model = new UserLogin;
$form = $this->beginWidget('application.extensions.booster.widgets.TbActiveForm', array(
    'id'=>'login-form',
    'action'=>$this->createAbsoluteUrl('/user/login'),
    'enableAjaxValidation' => true,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
    ),
    'htmlOptions'=>array(),
));
?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h4><?= UserModule::t('Login') ?></h4>
    </div>
    <div class="modal-body">
        <?php
        echo $form->textFieldGroup($model, 'username', array('class'=>'span3'));
        echo $form->passwordFieldGroup($model, 'password', array('class'=>'span3'));
        echo $form->checkboxGroup($model, 'rememberMe');
        ?>
    </div>
    <div class="modal-footer">
        <?php
        $this->widget('application.extensions.booster.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>'Вход',
        ));
        ?>
        <?php
        $this->widget('application.extensions.booster.widgets.TbButton', array(
            'label'=>'Закрыть',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        ));
        ?>
    </div>

<?php
$this->endWidget();
$this->endWidget();
?>
<?php else: ?><?=UserModule::t('Hi').', '.User::model()->findByPk(Yii::app()->user->id)->username; ?>!</p>
<?php $this->widget('application.extensions.booster.widgets.TbMenu',array(
    'items'=> $this->authMenu,
    'type'=>'list',
    'htmlOptions'=>array('class'=>'login-menu'),
));
?>
<?php endif; ?>
