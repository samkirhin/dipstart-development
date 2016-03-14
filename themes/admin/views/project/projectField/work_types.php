<div class="form-group col-md-offset-3 col-md-8">
	<a href="/project/projectField/admin">&lt;-- Back to manage project fields</a>
</div>
<?php
$form=$this->beginWidget('UActiveForm', array(
	'id'=>'work-types-form',
	'action' => Yii::app()->createUrl('/project/projectField/update',array('id'=>$model->id)),
	//'enableAjaxValidation'=>true,
	//'disableAjaxValidationAttributes'=>$disAjaxValid,
	//'clientOptions'=>array(
	//	'validateOnSubmit'=>true,
	//),
	//'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'form-horizontal'),
)); ?>
<div class="form-group col-md-offset-3 col-md-8">
<?php
echo '<p>'.UserModule::t('Use Ctrl for multiply').'</p>';
$htmlOptions = array('size' => '10', 'multiple' => 'true','style'=>'width:100%;','size'=>'10', 'empty'=>'('.UserModule::t('All').')');
$data = Catalog::model()->performCatsTree('specials2');
$selected = explode(',',$model->work_types);
echo '<div class="col-md-8">'.CHtml::listBox('ProjectField[work_types]', $selected, $data, $htmlOptions).'</div>';
?>
</div>
<div class="form-group col-md-offset-3 col-md-8">
	<?php echo CHtml::submitButton(UserModule::t('Save'),array('class'=>'btn btn-primary btn-save')); ?>
</div>
<?php
$this->endWidget();
?>