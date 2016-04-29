<div class="row" data-role="<?=User::model()->isCustomer()?>" id="message_send" data-message-send="<?=ProjectModule::t('Message was send')?>">
<?php
//if (!Yii::app()->request->isAjaxRequest){
	echo CHtml::form(); ?>
	
	<div class="chat-text-area">
		<?php echo CHtml::label(ProjectModule::t('Message'),'message', array('id' => 'msgLabel')); ?>
		<?php echo CHtml::textArea('message','', array('rows' => 6, 'class' => 'col-xs-12', 'placeholder' => ProjectModule::t('Enter your message...'))); ?>
	</div>
	<div class="chat-edit-text-area" id="div-edit-message" style="display: none;">
		<?php echo CHtml::label(ProjectModule::t('Message'),'edit-message', array('id' => 'msgLabel1')); ?>
		<?php echo CHtml::textArea('edit-message','', array('rows' => 6, 'class' => 'col-xs-12', 'placeholder' => ProjectModule::t('Enter your message...'), 'id' => 'edit-message')); ?>
	</div>

	<?php if (User::model()->isCustomer() || User::model()->isExecutor($order->id)) { ?>
	<div class="chat-buttons">
		<?php
		if(User::model()->isAuthor()) {
			$middle_button = ProjectModule::t('Send to customer');
		} else if(User::model()->isCustomer()) {
			$middle_button = ProjectModule::t('Send to executor');
		}
		$attr = array('name' => 'customer', 'class' => 'btn btn-primary btn-chat chtpl0-submit1','id'=>'chat-to-customer');
		echo  CHtml::submitButton($middle_button, $attr) ;
		$attr = array('name' => 'manager', 'class' => 'btn btn-primary btn-chat chtpl0-submit2','id'=>'chat-to-manager');
		echo  CHtml::submitButton(ProjectModule::t('Send to administrator'), $attr) ;
		
		//$edit_button = ProjectModule::t('Edit Last Message');
		//echo CHtml::submitButton($edit_button, array('name' => 'edit-message', 'class' => 'btn btn-primary chat-edit','step' => '0','id' => 'chat-edit'));
		?>
	</div>
	<? } ?>
	<?php if ($order->technicalspec) { ?>
	<div class="chat-buttons">
		<?php
			if(User::model()->isCorrector()) {
				echo '<h4>От технического руководителя</h4>';
				$attr = array('name' => 'customer', 'class' => 'btn btn-primary btn-chat chtpl0-submit1','id'=>'chat-corrector-to-customer');
				echo  CHtml::submitButton(ProjectModule::t('Send to customer'), $attr) ;
				$attr = array('name' => 'manager', 'class' => 'btn btn-primary btn-chat chtpl0-submit2','id'=>'chat-corrector-to-manager');
				echo  CHtml::submitButton(ProjectModule::t('Send to administrator'), $attr) ;
				if ($order->executor)
				{
					$attr = array('name' => 'executor', 'class' => 'btn btn-primary btn-chat chtpl0-submit2','id'=>'chat-corrector-to-executor');
					echo  CHtml::submitButton(ProjectModule::t('Send to executor'), $attr) ;
				}
			}
			if(User::model()->isExecutor($order->id)) {
				echo '<h4>Техническому руководителю</h4>';
				$attr = array('name' => 'corrector', 'class' => 'btn btn-primary btn-chat chtpl0-submit1','id'=>'chat-customer-to-corrector');
				echo  CHtml::submitButton(ProjectModule::t('Send to corrector'), $attr) ;
			}
			if(User::model()->isCustomer()) {
				echo '<h4>Техническому руководителю</h4>';
				$attr = array('name' => 'corrector', 'class' => 'btn btn-primary btn-chat chtpl0-submit1','id'=>'chat-customer-to-corrector');
				echo  CHtml::submitButton(ProjectModule::t('Send to corrector'), $attr) ;
			}
		?>
	</div>
	<? } ?>
	<?php echo CHtml::hiddenField('order',$order->id);
	CHtml::endForm();
//}
?>
<!-- form -->
</div>