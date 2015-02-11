<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'zakaz-form',
	//'type' => 'horizontal',
	//'htmlOptions' => array('class' => 'well'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
));
if ($model->status<3) $findAuthor=''; else $findAuthor=' hide';
?>
<div class="row findauthor<?php echo $findAuthor;?>">
		<?php echo $form->labelEx($model,'status',array('style' => 'float: left;'));
			echo $form->checkBox($model, 'status',array( 'style' => 'margin-left: 1em;',
				'checked' => ($model->status==2?'1':'0'),'data-id'=>$model->id));
			echo $form->error($model,'status'); ?>
</div>
	<?php
		echo $form->errorSummary($model); ?>
		<table>
			<tr>
				<td>
					<?php echo $form->labelEx($model,'category_id'); ?>
					<?php $models = Categories::model()->findAll();
						$list = CHtml::listData($models, 'id', 'cat_name');
						echo $form->dropDownList($model, 'category_id', $list, array('empty' => ProjectModule::t('Select a category')));
					?>
					<?php echo $form->error($model,'category_id'); ?>
				</td>
				<td>
					<?php echo $form->labelEx($model,'job_id'); ?>
					<?php $models = Jobs::model()->findAll();
						$list = CHtml::listData($models, 'id', 'job_name');
						echo $form->dropDownList($model, 'job_id', $list, array('empty' => ProjectModule::t('Select a job')));
					?>
					<?php echo $form->error($model,'job_id'); ?>
				</td>
			</tr>
		</table>


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
		<h3>  Сроки выполнения </h3>
	<table class="table table-striped" style="font-size: 12px">
		<thead>
			<th>Наименование</th>
			<th>Дата</th>
			<th>Время</th>
		</thead>
		<tr>
			<td>
				<?php echo $form->labelEx($model,'date'); ?>
			</td>
			<td>
				<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'name'=>'ZakazUpdate[date][date]',
						// additional javascript options for the date picker plugin
						'language' => 'ru',
						'value' => Yii::app()->dateFormatter->formatDateTime($times['date']['date'], 'medium', ''),
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
				<select class="search_type_select" name="ZakazUpdate[date][hours]">
					<?php
						for ($i=0; $i<24; $i++) {
							if ($times['date']['hours'] == $i) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
					?>
				</select>
				<select class="search_type_select" name="ZakazUpdate[date][minutes]">
					<?php
						for ($i=0; $i<60; $i++) {
							if ($times['date']['minutes'] == $i) {
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
				<?php echo $form->labelEx($model,'max_exec_date'); ?>
			</td>
			<td>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'name'=>'ZakazUpdate[max_exec_date][date]',
						// additional javascript options for the date picker plugin
						'language' => 'ru',
						'value' => Yii::app()->dateFormatter->formatDateTime($times['max_exec_date']['date'], 'medium', ''),
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
				<select class="search_type_select" name="ZakazUpdate[max_exec_date][hours]">
					<?php
						for ($i=0; $i<24; $i++) {
							if ($times['max_exec_date']['hours'] == $i) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
					?>
				</select>
				<select class="search_type_select" name="ZakazUpdate[max_exec_date][minutes]">
					<?php
						for ($i=0; $i<60; $i++) {
							if ($times['max_exec_date']['minutes'] == $i) {
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
						'name'=>'ZakazUpdate[date_finish][date]',
						// additional javascript options for the date picker plugin
						'language' => 'ru',
						'value' => Yii::app()->dateFormatter->formatDateTime($times['date_finish']['date'], 'medium', ''),
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
				<select class="search_type_select" name="ZakazUpdate[date_finish][hours]" >
					<?php
						for ($i=0; $i<24; $i++) {
							if ($times['date_finish']['hours'] == $i) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
					?>
				</select>
				<select class="search_type_select" name="ZakazUpdate[date_finish][minutes]">
					<?php
						for ($i=0; $i<60; $i++) {
							if ($times['date_finish']['minutes'] == $i) {
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
				<?php echo $form->labelEx($model,'term_for_author');?>
			</td>
			<td>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'name'=>'ZakazUpdate[term_for_author][date]',
						// additional javascript options for the date picker plugin
						'language' => 'ru',
						'value' => Yii::app()->dateFormatter->formatDateTime($times['term_for_author']['date'], 'medium', ''),
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
				<select class="search_type_select" name="ZakazUpdate[term_for_author][hours]" >
					<?php
						for ($i=0; $i<24; $i++) {
							if ($times['term_for_author']['hours'] == $i) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
					?>
				</select>
				<select class="search_type_select" name="ZakazUpdate[term_for_author][minutes]">
					<?php
						for ($i=0; $i<60; $i++) {
							if ($times['term_for_author']['minutes'] == $i) {
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
				<?php echo $form->labelEx($model,'manager_informed'); ?>
			</td>
			<td>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'name'=>'ZakazUpdate[manager_informed][date]',
						// additional javascript options for the date picker plugin
						'language' => 'ru',
						'value' => Yii::app()->dateFormatter->formatDateTime($times['manager_informed']['date'], 'medium', ''),
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
				<select class="search_type_select" name="ZakazUpdate[manager_informed][hours]">
					<?php
						for ($i=0; $i<24; $i++) {
							if ($times['manager_informed']['hours'] == $i) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
					?>
				</select>
				<select class="search_type_select" name="ZakazUpdate[manager_informed][minutes]">
					<?php
						for ($i=0; $i<60; $i++) {
							if ($times['manager_informed']['minutes'] == $i) {
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
				<?php echo $form->labelEx($model,'author_informed'); ?>
			</td>
			<td>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'name'=>'ZakazUpdate[author_informed][date]',
						// additional javascript options for the date picker plugin
						'language' => 'ru',
						'value' => Yii::app()->dateFormatter->formatDateTime($times['author_informed']['date'], 'medium', ''),
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
				<select class="search_type_select" name="ZakazUpdate[author_informed][date]">
					<?php
						for ($i=0; $i<24; $i++) {
							if ($times['author_informed']['hours'] == $i) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
					?>
				</select>
				<select class="search_type_select" name="ZakazUpdate[author_informed][date]">
					<?php
						for ($i=0; $i<60; $i++) {
							if ($times['author_informed']['minutes'] == $i) {
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
			<?php echo $form->labelEx($model,'pages'); ?>
			<?php echo $form->textField($model,'pages'); ?>
			<?php echo $form->error($model,'pages'); ?>
	</td>
		<td>

		</td>
		<td>

		</td>
	</tr>

	</table>
	<div class="row">
			<?php echo $form->labelEx($model,'add_demands'); ?>
			<?php echo $form->textArea($model,'add_demands',array('rows'=>6, 'cols'=>53)); ?>
			<?php echo $form->error($model,'add_demands'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>53)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'author_notes'); ?>
		<?php echo $form->textArea($model,'author_notes',array('rows'=>6, 'cols'=>53)); ?>
		<?php echo $form->error($model,'author_notes'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'user_notes'); ?>
		<?php echo $form->textArea($model,'user_notes',array('rows'=>6, 'cols'=>53)); ?>
		<?php echo $form->labelEx($model, 'user_notes_show');?>
		<?php echo $form->checkBox($model, 'user_notes_show'); ?>
		<?php echo $form->error($model,'user_notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(ProjectModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<div id="chatWindow"></div>
<?php
	$this->widget('YiiChatWidget',array(
		'chat_id'=>$model->id,
		'executor'=>$model->executor,
		'identity'=>Yii::app()->user->id,
		'selector'=>'#chatWindow',
		'minPostLen'=>1,
		'maxPostLen'=>5000,
		'model'=>new ChatHandler(),
		'data'=>'any data',
		'onSuccess'=>new CJavaScriptExpression(
			"function(code, text, post_id){   }"),
		'onError'=>new CJavaScriptExpression(
			"function(errorcode, info){  }"),
	));
?>
