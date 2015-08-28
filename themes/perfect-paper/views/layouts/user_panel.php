<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 06.04.15
 * Time: 0:49
 */
?>
<div class="col-xs-1 col-md-1 lock"></div>
<div class="col-xs-10 col-md-10">
    For our Users</br>
<?php if (Yii::app()->user->isGuest): ?>
<?php
    echo CHtml::link('Sign in<br>',array('/user/login'),array('data-toggle'=>'modal','data-target'=>'#loginModalForm',));
    //echo CHtml::link('Registration<br>',array('/site/page','view'=>'registration'));
	echo CHtml::link('Registration<br>',array('/site/page','view'=>'order'));
    echo CHtml::link('Recover password',array('/user/recovery'),array('data-toggle'=>'modal','data-target'=>'#loginModalForm',));
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
        <h4>Вход на сайт</h4>
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
<?php else: ?>
Привет, <?php echo User::model()->findByPk(Yii::app()->user->id)->username; ?>!</p>
<?php $this->widget('application.extensions.booster.widgets.TbMenu',array(
    'items'=> $this->authMenu,
    'type'=>'list',
    'htmlOptions'=>array('class'=>'login-menu'),
));
?>
<?php endif; ?>
</div>
