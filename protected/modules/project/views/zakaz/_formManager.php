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
)); ?>

	<p class="note"><?=ProjectModule::t('Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>
        <table>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'user_id');
          $list = CHtml::listData(User::model()->findAllCustomers(), 'id', 'username');
          echo $form->dropDownList($model, 'user_id', $list, array('empty' => ProjectModule::t('Select a customer')));?>
        <?php echo $form->error($model,'executor'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'executor');
          $list = CHtml::listData(User::model()->findAllAuthors(), 'id', 'username');
          echo $form->dropDownList($model, 'executor', $list, array('empty' => ProjectModule::t('Select a author')));?>
        <?php //echo $form->textField($model,'executor',array('size'=>53,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'executor'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'category_id'); ?>
        <?php $models = Categories::model()->findAll();
          $list = CHtml::listData($models, 'id', 'cat_name');
          echo $form->dropDownList($model, 'category_id', $list, array('empty' => ProjectModule::t('Select a category')));?>
		<?php echo $form->error($model,'category_id'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'job_id'); ?>
		<?php $models = Jobs::model()->findAll();
          $list = CHtml::listData($models, 'id', 'job_name');
          echo $form->dropDownList($model, 'job_id', $list, array('empty' => ProjectModule::t('Select a job')));?>
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

    <table>
            <tr>
                <td>
        <?php echo $form->labelEx($model,'date'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'Zakaz[date]',
                // additional javascript options for the date picker plugin
                'language' => 'ru',
                'value' => $model->date,
                'options'=>array(
                    'dateFormat'=>'yy-mm-dd',
                    'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                ),
                'htmlOptions'=>array(
                    'style'=>'height:20px;background-white:blue;color:black;',
                ),
            ));
            ?>

    	</td>
        <td>
    		<?php echo $form->labelEx($model,'max_exec_date');
    		 $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'Zakaz[max_exec_date]',
                // additional javascript options for the date picker plugin
                'language' => 'ru',
                'value' => $model->max_exec_date,
                'options'=>array(
                    'dateFormat'=>'yy-mm-dd',
                    'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                ),
                'htmlOptions'=>array(
                    'style'=>'height:20px;background-white:blue;color:black;',
                ),
            ));
            ?>

	</td>
        <td>
		<?php echo $form->labelEx($model,'date_finish');
        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'name'=>'Zakaz[date_finish]',
            // additional javascript options for the date picker plugin
            'language' => 'ru',
            'value' => $model->date_finish,
            'options'=>array(
                'dateFormat'=>'yy-mm-dd',
                'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
            ),
            'htmlOptions'=>array(
                'style'=>'height:20px;background-white:blue;color:black;',
            ),
        ));
        ?>

	</td>
    </tr>    
    <tr>    
        <td>
		<?php echo $form->labelEx($model,'pages'); ?>
		<?php echo $form->textField($model,'pages'); ?>
		<?php echo $form->error($model,'pages'); ?>
	</td>
        <td>
		<?php echo $form->labelEx($model,'budget'); ?>
		<?php echo $form->textField($model,'budget',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'budget'); ?>
	</td>
        <td>
		<?php echo $form->labelEx($model,'with_prepayment');
		  $list = array('0' => ProjectModule::t('No'), '1' => ProjectModule::t('Yes'));
          echo $form->dropDownList($model, 'with_prepayment', $list);?>
		<?php echo $form->error($model,'with_prepayment'); ?>
	</td>
    </tr>
    <tr>
        <td>
		<?php echo $form->labelEx($model,'customer_price'); ?>
		<?php echo $form->textField($model,'customer_price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'customer_price'); ?>
	</td>
        <td>
		<?php echo $form->labelEx($model,'author_price'); ?>
		<?php echo $form->textField($model,'author_price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'author_price'); ?>
	</td>
        <td>
		<?php echo $form->labelEx($model,'author_payed'); ?>
		<?php echo $form->textField($model,'author_payed',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'author_payed'); ?>
        </td>
    </tr>
    </table>

    <div class="row">
		<?php echo $form->labelEx($model,'is_payed');
		  $list = array('0' => ProjectModule::t('No'), '1' => ProjectModule::t('Yes'));
          echo $form->dropDownList($model, 'is_payed', $list);?>
		<?php echo $form->error($model,'is_payed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_demands'); ?>
		<?php echo $form->textArea($model,'add_demands',array('rows'=>6, 'cols'=>53)); ?>
		<?php echo $form->error($model,'add_demands'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'status');
		    $models = ProjectStatus::model()->findAll();
            $list = CHtml::listData($models, 'id', 'status');
            echo $form->dropDownList($model, 'status', $list, array('empty' => ProjectModule::t('Select a status')));?>
		<?php echo $form->error($model,'status'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'informed');
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'name'=>'Zakaz[informed]',
            // additional javascript options for the date picker plugin
            'language' => 'ru',
            'value' => $model->informed,
            'options'=>array(
                'dateFormat'=>'yy-mm-dd',
                'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
            ),
            'htmlOptions'=>array(
                'style'=>'height:20px;background-white:blue;color:black;',
            ),
        ));
        ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'add_demands',array('rows'=>6, 'cols'=>53)); ?>
		<?php echo $form->error($model,'add_demands'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? ProjectModule::t('Create') : ProjectModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->