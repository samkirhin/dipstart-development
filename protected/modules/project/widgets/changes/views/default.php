<?php
/* @var $this CWidget */
/* @var $user User */
/* @var $changes ProjectChanges */
?>
    <div id = "list-changes-block" class = ""></div>
<?php
if ($user->isCustomer() || $user->isManager() || $user->isAdmin()) { ?>
    <div class = "form">
        <div id = "errors-block"></div>
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'project-changes-form',
            'htmlOptions' => array(
                'class' => 'changes-form-container',
                'method' => 'post',
                'enctype' => 'multipart/form-data'),
            'enableAjaxValidation' => false,
        ));
        ?>

        <?php echo $form->errorSummary($changes); ?>

        <div class = "row">
            <?php echo $form->labelEx($changes, 'fileupload'); ?>
            <?php echo $form->fileField($changes, 'fileupload'); ?>
        </div>

        <div class = "row">
            <?php echo $form->labelEx($changes, 'comment'); ?>
            <?php echo $form->textArea($changes, 'comment', array('rows' => 6, 'cols' => 70)); ?>
        </div>

        <?php if (User::model()->isManager() | User::model()->isAdmin()) { ?>
            <div class = "row">
                <?php echo $form->labelEx($changes, 'moderate'); ?>
                <?php echo $form->dropDownList($changes,
                    'moderate',
                    array('1' => ProjectModule::t('Approved'), '0' => ProjectModule::t('Not approved')));
                ?>
            </div>
        <?php } ?>
        <div class = "row buttons">
            <?php echo CHtml::submitButton($changes->isNewRecord ? ProjectModule::t('Add changes') : ProjectModule::t('Edit changes'),
                array());
            ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
<?php
}
?>