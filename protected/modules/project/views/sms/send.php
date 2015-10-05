<div class="form">
    
    <b><?= strip_tags($model->message) ?></b>
    
    <?php $form = $this->beginWidget('CActiveForm') ?>
    
    <div class="row">
		<?php echo $form->label($model,'number'); ?>
		<?php echo $form->textField($model,'number'); ?>
        <?php echo $form->error($model,'number'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'text'); ?>
		<?php echo $form->textArea($model,'text', ['cols'=>30, 'rows'=>3]); ?>
        <?php echo $form->error($model,'text'); ?>
	</div>
    
    <div class="row buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>
    
    
    <?php $this->endWidget() ?>
</div>