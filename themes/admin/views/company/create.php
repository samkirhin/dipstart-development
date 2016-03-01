<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'create-company-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
	<?php if(Yii::app()->user->hasFlash('companySuccessMessage'))
		echo '<p class="success">'.Yii::app()->user->getFlash('companySuccessMessage').'</p>';
	if(Yii::app()->user->hasFlash('companyErrorMessage'))
		echo '<p class="error">'.Yii::app()->user->getFlash('companyErrorMessage').'</p>';
	?>
	<div class="row">
		<?php echo CHtml::dropDownList('company_to_copy', null, $companies, array('empty' => '(Select a company to copy)'));
		?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton(ProjectModule::t('Create')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->