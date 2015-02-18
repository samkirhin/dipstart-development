<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */
?>
<div><a href='#' id='file-picker'><?php echo Yii::t('site','File manager');?></a>
</div>

<!-- required div layout begins -->
<div id='file-picker-viewer'>
	<div class='body'></div>
	<hr/>
	<div id='myuploader'>
		<label rel='pin'><b>Upload Files
			<img style='float: left;' src='images/pin.png'></b></label>
		<br/>
		<div class='files'></div>
		<div class='progressbar'>
			<div style='float: left;'>
				Uploading your file(s), please wait...</div>
			<img style='float: left;' src='images/progressbar.gif' />
			<div style=
				'float: left; margin-right:10px;'class='progress'>
			</div>
			<img style='float: left;' class='canceljob'
				src='images/delete.png' title='cancel the upload'/>
		</div>
	</div>
	<hr/>
	<button id='select_file' class='ok_button'>Select File(s)</button>
	<button id='delete_file' class='delete_button'>Delete Selected File(s)</button>
	<button id='close_window' class='cancel_button'>Close Window</button>
</div>
<!-- required div layout ends -->

<hr/>Logger:<br/><div id='logger'></div>

<?php
	// the widget
	//
	$this->widget('application.components.MyYiiFileManViewer'
	,array(
		// layout selectors:
		'launch_selector'=>'#file-picker',
		'list_selector'=>'#file-picker-viewer',
		'uploader_selector' => '#myuploader',
		// messages:
		'delete_confirm_message' => 'Confirm deletion ?',
		'select_confirm_message' => 'Confirm selected items ?',
		'no_selection_message' => 'You are required to select some file',
		// events:
		'onBeforeAction'=>
			"function(viewer,action,file_ids) { return true; }",
		'onAfterAction'=>
			"function(viewer,action,file_ids, ok, response) {
				if(action == 'select'){
				  // actions: select | delete
				  $.each(file_ids, function(i, item){
				  $('#logger').append('file_id='+item.file_id
				  + ', <img src=\''+item.url+'&size=full\'><br/>');
				});
			}
		}",
		// 'onBeforeLaunch'=>"function(_viewer){ }",
		'onClientSideUploaderError'=>
			"function(messages){
				$(messages).each(function(i,m){  alert(m); });
			}
		",
		'onClientUploaderProgress'=>"function(status, progress){
			$('#logger').append(
				'progress: '+status+' '+progress+'%<br/>');
			}",
		));
?>
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
		<?php echo $form->textField($model,'user_id',array('size'=>70,'maxlength'=>255)); ?>
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
		<?php echo $form->textField($model,'title',array('size'=>70,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>70)); ?>
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
						'style'=>'height:20px;background-white:blue;color:black;',
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
		<?php echo $form->textField($model,'pages'); ?>
		<?php echo $form->error($model,'pages'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_demands'); ?>
		<?php echo $form->textArea($model,'add_demands',array('rows'=>6, 'cols'=>53)); ?>
		<?php echo $form->error($model,'add_demands'); ?>
	</div>
	<h3>Заметки</h3>
	<div class="row">
			<?php echo $form->labelEx($model,'user_notes'); ?>
			<?php echo $form->textArea($model,'user_notes',array('rows'=>6, 'cols'=>53)); ?>
			<?php echo $form->error($model,'user_notes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_for_call'); ?>
		<?php echo $form->textField($model,'time_for_call'); ?>
		<?php echo $form->error($model,'time_for_call'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edu_dep'); ?>
		<?php echo $form->textField($model,'edu_dep'); ?>
		<?php echo $form->error($model,'edu_dep'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? ProjectModule::t('Create') : ProjectModule::t('Save')); ?>
	</div>

<?php $this->endWidget();
?>

</div><!-- form -->
