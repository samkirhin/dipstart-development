<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

/*$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);*/
?>

<h1><?= Yii::t('site', 'Login') ?></h1>

<p><?= Yii::t('site', 'Please fill out the following form with your login credentials:') ?></p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
        'afterValidate'=>'js:function(form, data, hasError) {
            if (!hasError){
                str = $("#login-form").serialize() + "&ajax=login-form";

                $.ajax({
                    type: "POST",
                    url: "' . Yii::app()->createUrl('user/login') . '",
                    data: str,
                    dataType: "json",
                    beforeSend : function() {
                        $("#login").attr("disabled",true);
                    },
                    success: function(data, status) {
                        if(data.authenticated)
                        {
                            $("#login-form").hide;
                            window.location = data.redirectUrl;
                        }
                        else
                        {
                            $.each(data, function(key, value) {
                                var div = "#"+key+"_em_";
                                $(div).text(value);
                                $(div).show();
                            });
                            $("#login").attr("disabled",false);
                        }
                    },
                });
                return false;
            }
        }',
	),
)); ?>

	<p class="note"><?=Yii::t('site', 'Fields with <span class="required">*</span> are required.')?></p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
            <?=Yii::t('site', 'Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.')?>

		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('site', 'Login')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
