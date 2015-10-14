<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/reset.css');?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/plate-form.css');?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/plate-form-media.css');?>
<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */
?>
    <div class="container form-container">
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
			<div class="form-items">
			
			<?php
			if(Campaign::getId()){ ?>
				<div class="form-item">
                <?php echo $form->labelEx($model,'max_exec_date');?>
                <?php
                $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                    'model' => $model,
                    'attribute' => 'dbmax_exec_date',
                ));?>
				</div><?php
				$projectFields = $model->getFields();
				if ($projectFields) {
					foreach($projectFields as $field) {
						if ($field->field_type=="LIST"){
							echo '<div class="form-item">';
							echo $form->labelEx($model,$field->varname).'<br/>';
							$models = Catalog::model()->findAllByAttributes(array('field_varname'=>$field->varname));
							$list = CHtml::listData($models, 'id', 'cat_name');
							echo $form->dropDownList($model, $field->varname, $list, array('empty' => ProjectModule::t('Select a category'),'class'=>'form-control'));
							echo $form->error($model,$field->varname);
							echo '</div>';
						} elseif ($field->field_type=="TIMESTAMP" || $field->field_type=="DATE") {
							?>
							<div class="form-item" style="position: relative; float: left; width: 100%;">
								<label style="position: relative; float: left; width: 100px;"><?php echo $form->labelEx($model,$field->varname);?></label>
								<?php
								$this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
									'model' => $model,
									'attribute' => $field->varname,
								));?>
							</div><?php
						} elseif ($field->field_type=="TEXT") {
							echo '<div class="form-item">';
							echo $form->labelEx($model,$field->varname).'<br/>';
							echo$form->textArea($model,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control'));
							echo '</div>';
						} else {
							echo '<div class="form-item">';
							echo $form->labelEx($model,$field->varname).'<br/>';
							echo $form->textField($model,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'));
							echo '</div>';
						}
					}
				}
			} ?>
		    </div>
			<?php echo CHtml::submitButton(<?=ProjectModule::t('Upload'), array('class' => 'create-order-button') ); ?>
		
		<?php $this->endWidget(); ?>
    

	</div>


<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/masonry.min.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/common-masonry.js', CClientScript::POS_END);
?>
