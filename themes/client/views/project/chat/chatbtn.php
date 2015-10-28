    <?php if(!Yii::app()->user->isGuest): ?>
	<?php $edit_button = ProjectModule::t('Edit Last Message');  ?>
	<?=   CHtml::submitButton($edit_button, array('name' => 'edit-message', 'class' => 'btn btn-primary btn-block chat-edit','step' => '0','id' => 'chat-edit')); ?>
    <?php endif; ?>
	

