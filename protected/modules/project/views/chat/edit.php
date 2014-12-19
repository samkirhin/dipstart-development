<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'project-messages-sendmessage-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // See class documentation of CActiveForm for details on this,
    // you need to use the performAjaxValidation()-method described there.
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'message', array('id' => 'msgLabel')); ?>
        <?php echo $form->textArea($model,'message', array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'message'); ?>
    </div>
    <?php echo $form->hiddenField($model,'order'); ?>
    <?php echo $form->hiddenField($model,'moderated'); ?>
    <?php echo $form->hiddenField($model,'date'); ?>
    <?php echo $form->hiddenField($model,'sender'); ?>
    <?php echo $form->hiddenField($model,'recipient'); ?>
    <div class="row">
         <p>Цена за работу:</p>
        <?php echo $form->textField($model, 'cost'); ?>
        <?php echo $form->error($model,'cost'); ?>
    </div>
    <div class="row buttons">
        <p>Дополнительно отправить:</p>
        <p><input type="checkbox"> SMS</p>
        <p><input type="checkbox"> Email</p>
        <?php echo CHtml::submitButton('Отправить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->