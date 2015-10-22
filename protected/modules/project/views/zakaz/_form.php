<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */

	$isGuest = Yii::app()->user->guestName;
	$disabled='';
//	if ($isGuest)$disabled  = " disabled='disabled'";
	die('!!!!!!!!!!!');
?>
	<script>
		var content="<? UserModule::t('Write what is ready to take this order or ask a question') ?>";
		alert(content);
		$('div#chatWindow').css('content',content);
	</script>
	<input id="empty-chat-message" type="hidden" value="">

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'zakaz-form',
    'action'=>isset ($model->id) ? $this->createUrl('zakaz/update', ['id'=>$model->id]) : '',
    //'type' => 'horizontal',
    //'htmlOptions' => array('class' => 'well'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=ProjectModule::t('Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>70,'maxlength'=>255,$disabled)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>-->


	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php $models = Categories::model()->findAll();
		  $list = CHtml::listData($models, 'id', 'cat_name');
		  echo $form->dropDownList($model, 'category_id', $list, array('empty' => ProjectModule::t('Select a category')));?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_id'); ?>
		<?php $models = Jobs::model()->findAll();
		  $list = CHtml::listData($models, 'id', 'job_name');
		  echo $form->dropDownList($model, 'job_id', $list, array('empty' => ProjectModule::t('Select a job')));?>
		<?php echo $form->error($model,'job_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>70,'maxlength'=>255, $disabled)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>70, $disabled)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<table class="table table-striped" style="font-size: 12px">
	<tr>
			<td>
				<?php echo $form->labelEx($model,'max_exec_date'); ?>
			</td>
			<td>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'name'=>'Zakaz[max_exec_date][date]',
						// additional javascript options for the date picker plugin
						'language' => 'ru',
						'value' => isset($times) ? $times['max_exec_date']['date'] : null,
						'options'=>array(
							'dateFormat'=>'dd.mm.yy',
							'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
						),
					'htmlOptions'=>array(
						'style'=>'height:20px;background-white:blue;color:black;',
					),
				));
			?>
			</td>
			<td>
				<select class="search_type_select" name="Zakaz[max_exec_date][hours]">
					<?php
						for ($i=0; $i<24; $i++) {
							if (isset($times) && $times['max_exec_date']['hours'] == $i) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
					?>
				</select>
				<select class="search_type_select" name="Zakaz[max_exec_date][minutes]">
					<?php
						for ($i=0; $i<60; $i++) {
							if (isset($times) && $times['max_exec_date']['minutes'] == $i) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $form->labelEx($model,'date_finish');?>
			</td>
			<td>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'name'=>'Zakaz[date_finish][date]',
						// additional javascript options for the date picker plugin
						'language' => 'ru',
						'value' => isset($times) ? $times['date_finish']['date'] : null,
						'options'=>array(
						'dateFormat'=>'dd.mm.yy',
						'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
						),
					'htmlOptions'=>array(
						'style'=>'height:t:20px;background-white:blue;color:black;',
					),
				));
			?>
	</td>
		<td>
				<select class="search_type_select" name="Zakaz[date_finish][hours]" >
					<?php
						for ($i=0; $i<24; $i++) {
							if (isset($times) && $times['date_finish']['hours'] == $i) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
					?>
				</select>
				<select class="search_type_select" name="Zakaz[date_finish][minutes]">
					<?php
						for ($i=0; $i<60; $i++) {
							if (isset($times) && $times['date_finish']['minutes'] == $i) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
					?>
				</select>
			</td>
		</tr>
</table>

	<div class="row">
		<?php echo $form->labelEx($model,'pages'); ?>
		<?php echo $form->textField($model,'pages',array($disabled)); ?>
		<?php echo $form->error($model,'pages'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_demands'); ?>
		<?php echo $form->textArea($model,'add_demands',array('rows'=>6, 'cols'=>53, $disabled)); ?>
		<?php echo $form->error($model,'add_demands'); ?>
	</div>
	<h3><?= ProjectModule::t('Notes') ?></h3>

	<div class="row">
		<?php echo $form->labelEx($model,'time_for_call'); ?>
		<?php echo $form->textField($model,'time_for_call',array($disabled)); ?>
		<?php echo $form->error($model,'time_for_call'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edu_dep'); ?>
		<?php echo $form->textField($model,'edu_dep',array($disabled)); ?>
		<?php echo $form->error($model,'edu_dep'); ?>
	</div>

	<div class="row buttons">
		
		<?php 
			if ($isGuest) echo CHtml::submitButton($model->isNewRecord ? ProjectModule::t('Create') : ProjectModule::t('Save'),array('disable'=>'disable')); 
			else echo CHtml::submitButton($model->isNewRecord ? ProjectModule::t('Create') : ProjectModule::t('Save')); 
		?>
	</div>

<?php $this->endWidget();
?>

</div><!-- form -->

<?php 

    if (!$model->isNewRecord && $model->status == 2):
        $upload = new UploadPaymentImage;
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'check-form',
    'action'=>['zakaz/uploadPayment', 'id'=>$model->id],
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
		'enctype'=>'multipart/form-data',
	)
)); ?>
    
    <div class="row">
		<?= ProjectModule::t('Check scan') ?>
		<?php echo $form->fileField($upload,'file',array($disabled)); ?>
	</div>
    
    <div class="row buttons">
		<?php
			if ($isGuest) echo CHtml::submitButton(ProjectModule::t('Upload'),array('disable'=>'disable')); 
			else	echo CHtml::submitButton(ProjectModule::t('Upload')); 
		?>
	</div>
    
<?php $this->endWidget(); ?>
    
</div>

<?php endif; ?>