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
		
            <!--<div class="form-items">
                <div class="form-item">
                    <h3 class="item-name">Дата и время исполнения заказа</h3>
                    <input type="text">
                </div>

                <div class="form-item">
                    <h3 class="item-name">Название работы</h3>
                    <input type="text">
                </div>

                <div class="form-item" style="">
                    <h3 class="item-name">Специализация проекта</h3>
                    <select>
                        <option value="">Выберите категорию</option>
                        <option value="5">Все</option>
                        <option value="6">Дизайн сайта </option>
                        <option value="7">Верстка сайта </option>
                        <option value="8">Копирайтинг</option>
                        <option value="9">Рерайтинг</option>
                        <option value="10">Оптимизация (СЕО)</option>
                        <option value="11">Видео</option>
                        <option value="12">Программирование</option>
                        <option value="13">Постинг</option>
                        <option value="14">Презентации</option>
                        <option value="15">Диктор</option>
                        <option value="16">Перевод с Рус на Eng</option>
                        <option value="17">Другое</option>
                        <option value="18">Бизнес под ключ</option>
                        <option value="19">Проект под ключ</option>
                        <option value="20">Сайт под ключ</option>
                        <option value="21">Лендинг под ключ</option>
                        <option value="23">Тестирование</option>
                    </select>
                </div>

                <div class="form-item">
                    <h3 class="item-name">План</h3>
                    <textarea rows="4"></textarea>
                </div>

                <div class="form-item">
                    <h3 class="item-name">Описание</h3>
                    <textarea rows="4"></textarea>
                </div>

                <div class="form-item">
                    <h3 class="item-name">Дополнительные требования или рекомендации</h3>
                    <textarea rows="4"></textarea>
                </div>

                <div class="form-item">
                    <h3 class="item-name">Add an Abstract page to my paper</h3>
                    <input type="text">
                </div>
				-->
            </div>
            <!--<input type="submit" class="create-order-button">-->
			<?php echo CHtml::submitButton('Загрузить', array('class' => 'create-order-button') ); ?>
		
		<?php $this->endWidget(); ?>
        <!--</form>-->
    
		

		
    
    
    
    
    
    
    
    
    
    <!--<div class="col-xs-12" style="margin-bottom: 20px;">
    
        <div class="form" style="margin-bottom: 30px;">



            

            <?php echo $form->errorSummary($model);
			// campaign! -------------
			if(Campaign::getId()){ ?>
			<div class="form-group">
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
							echo '<div class="form-group">';
							echo $form->labelEx($model,$field->varname).'<br/>';
							$models = Catalog::model()->findAllByAttributes(array('field_varname'=>$field->varname));
							$list = CHtml::listData($models, 'id', 'cat_name');
							echo $form->dropDownList($model, $field->varname, $list, array('empty' => ProjectModule::t('Select a category'),'class'=>'form-control'));
							echo $form->error($model,$field->varname);
							echo '</div>';
						} elseif ($field->field_type=="TIMESTAMP" || $field->field_type=="DATE") {
							?>
							<div class="form-group" style="position: relative; float: left; width: 100%;">
								<label style="position: relative; float: left; width: 100px;"><?php echo $form->labelEx($model,$field->varname);?></label>
								<?php
								$this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
									'model' => $model,
									'attribute' => $field->varname,
								));?>
							</div><?php
						} elseif ($field->field_type=="TEXT") {
							echo '<div class="form-group">';
							echo $form->labelEx($model,$field->varname).'<br/>';
							echo$form->textArea($model,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control'));
							echo '</div>';
						} else {
							echo '<div class="form-group">';
							echo $form->labelEx($model,$field->varname).'<br/>';
							echo $form->textField($model,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'));
							echo '</div>';
						}
					}
				}
			} else {
			?>

            <div class="form-group">
                <?php echo $form->labelEx($model,'category_id');
                $models = Categories::model()->findAll();
                $list = CHtml::listData($models, 'id', 'cat_name');
                echo $form->dropDownList($model, 'category_id', $list, array('empty' => ProjectModule::t('Select a category'),'class'=>'form-control'));
                echo $form->error($model,'category_id'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'job_id'); ?>
                <?php $models = Jobs::model()->findAll();
                $list = CHtml::listData($models, 'id', 'job_name');
                echo $form->dropDownList($model, 'job_id', $list, array('empty' => ProjectModule::t('Select a job'), 'class'=>'form-control'));?>
                <?php echo $form->error($model,'job_id'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'title'); ?>
                <?php echo $form->textField($model,'title',array('size'=>70,'maxlength'=>255, 'class'=>'form-control')); ?>
                <?php echo $form->error($model,'title'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'text'); ?>
                <?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>70, 'class'=>'form-control')); ?>
                <?php echo $form->error($model,'text'); ?>
            </div>
			
            <div class="form-group" style="position: relative; float: left; width: 100%;">
                <label style="position: relative; float: left; width: 100px;"><?php echo $form->labelEx($model,'max_exec_date');?></label>
                <?php
                $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                    'model' => $model,
                    'attribute' => 'dbmax_exec_date',
                ));?>
            </div>
			
            <div class="form-group" style="position: relative; float: left; width: 100%;">
                <label style="position: relative; float: left; width: 100px;"><?php echo $form->labelEx($model,'date_finish');?></label>
                <?php
                $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                    'model' => $model,
                    'attribute' => 'dbdate_finish',
                ));?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'pages'); ?>
                <?php echo $form->textField($model,'pages', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'pages'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'add_demands'); ?>
                <?php echo $form->textArea($model,'add_demands',array('rows'=>6, 'cols'=>53, 'class'=>'form-control')); ?>
                <?php echo $form->error($model,'add_demands'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'time_for_call'); ?>
                <?php echo $form->textField($model,'time_for_call', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'time_for_call'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'edu_dep'); ?>
                <?php echo $form->textField($model,'edu_dep', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'edu_dep'); ?>
            </div>
			<?php } ?>
            <div class="buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? ProjectModule::t('Create') : ProjectModule::t('Save'), array ('class'=>'btn btn-primary btn-save')); ?>
            </div>

            <?php //$this->endWidget();
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
                    Скан чека
                    <?php echo $form->fileField($upload,'file'); ?>
                </div>

<!-- End form --><?php $this->endWidget(); ?>

            </div>

        <?php endif; ?>
    </div>
</div>


<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/masonry.min.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/common-masonry.js', CClientScript::POS_END);
?>
