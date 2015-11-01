<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration"); 
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/skin2.css');
?>

<?php if(Yii::app()->user->hasFlash('reg_success')): ?>
<div class="reg-success">
<?php echo Yii::app()->user->getFlash('reg_success'); ?>
</div>

	<?php 
		$redirect = Yii::app()->createUrl("/user/profile/edit");
		
		if(Yii::app()->user->checkAccess('Customer')){
			$redirect = Yii::app()->createUrl("/project/zakaz/create");
		} 
	?>
	
	<script language="JavaScript" type="text/javascript">
		function toTarget(){ 
		 location='<?php echo $redirect;?>'; 
		} 
		setTimeout( 'toTarget()', 3000 ); 
	</script>
	
<?php elseif (Yii::app()->user->hasFlash('reg_failed')):?>
<div class="">
<?php echo Yii::app()->user->getFlash('reg_failed'); ?>
</div>
<?php else: ?>
<div class="col-xs-offset-3 col-xs-6 login-form-bg" id="login-form-bg">
<?php
$this->widget('application.components.UloginWidget', array(
    'params'=>array(
        'redirect'=>'http://'.$_SERVER['HTTP_HOST'].'/ulogin/login?role='.$role //Адрес, на который ulogin будет редиректить браузер клиента. Он должен соответствовать контроллеру ulogin и действию login
    )
)); 

$form=$this->beginWidget('UActiveForm', array(
	'id'=>'simple-registration-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	
	<div class="form-group">
        <!--<?php //echo CHtml::activeLabelEx($model,'username'); ?> <br />-->
		<?php echo CHtml::activeTextField($model,'email',array('placeholder' => 'E-mail')); ?>
	</div>
	
	<div class="form-group">
		<?php echo CHtml::activeTextField($model,'phone_number',array('placeholder'=>'Номер телефона')) ?>
	</div>
	<!--
	<?php echo $form->errorSummary(array($model)); ?>
	
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
	-->
	<div class="row user_submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); //,array('onclick'=>'javascript: getElementById("login-form-bg").style.display="none";')?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->



<?php endif; ?>
