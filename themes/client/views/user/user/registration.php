<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration"); 
    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/skin2.css');
?>

<?php if(Yii::app()->user->hasFlash('reg_success')): ?>
<div class="col-xs-offset-3 col-xs-6 login-form-bg">
  <?php echo Yii::app()->user->getFlash('reg_success'); ?>
</div>

	<?php 
		$redirect = Yii::app()->createUrl("/project/zakaz/list");
		
		if(Yii::app()->user->checkAccess('Customer')){
			$redirect = Yii::app()->createUrl("/project/zakaz/create");
		} 
	?>
	
	<script language="JavaScript" type="text/javascript">
		function toTarget(){ 
		 location='<?php echo $redirect;?>'; 
		} 
		setTimeout( 'toTarget()', 4000 ); 
	</script>
	
<?php else: ?>
<div class="col-xs-offset-3 col-xs-6 login-form-bg">
<?php
if (Yii::app()->user->hasFlash('reg_failed')) echo '<p class="error">'.Yii::app()->user->getFlash('reg_failed').'</p>';

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

  <div class="form-group" style="text-align: center; font-weight: bold;">
      <?=ProjectModule::t('This is registration')?>
  </div>
  
	<div class="form-group">
        <!--<?php //echo CHtml::activeLabelEx($model,'username'); ?> <br />-->
		<?php echo $form->textField($model,'email',array('placeholder' => 'E-mail')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->textField($model,'phone_number',array('placeholder'=>UserModule::t('Cell number'))); ?>
		<?php echo $form->error($model,'phone_number'); ?>
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
		<?php echo CHtml::submitButton(UserModule::t("Register"));?>
	</div>

<?php $this->endWidget(); ?>

	<p class="hint2">
		<a href="/user/login<?php if($_GET['role']) echo '?role='.$_GET['role']; ?>"><?=UserModule::t('Login') ?></a>
		<?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
	</p>
</div><!-- form -->

<?php endif; ?>
