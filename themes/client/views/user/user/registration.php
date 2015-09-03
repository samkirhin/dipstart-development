<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration"); ?>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form">
<?php
$form=$this->beginWidget('UActiveForm', array(
	'id'=>'simple-registration-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo $form->errorSummary(array($model,$profile)); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model,'email'); ?><br/>
	<?php echo $form->textField($model,'email'); ?><br/>
	<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="row">
	<?php echo $form->labelEx($model,'phone_number'); ?><br/>
	<?php echo $form->textField($model,'phone_number'); ?><br/>
	<?php echo $form->error($model,'phone_number'); ?>
	</div>	
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->


<?php  $this->widget('application.components.UloginWidget', array(
    'params'=>array(
        'redirect'=>'http://'.$_SERVER['HTTP_HOST'].'/ulogin/login' //Адрес, на который ulogin будет редиректить браузер клиента. Он должен соответствовать контроллеру ulogin и действию login
    )
)); ?>

<?php endif; ?>
