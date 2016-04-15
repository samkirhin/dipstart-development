<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 26.06.15
 * Time: 13:54
 */
$criteria=new CDbCriteria;
if(!Yii::app()->user->isGuest)
$criteria->addCondition('(moderated=1 OR sender IN (SELECT userid FROM '.Campaign::getId().'_AuthAssignment WHERE itemname IN ("Admin","Manager")) OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient IN ('.Yii::app()->user->id.',0'.((User::model()->isAuthor())?',-1':'').'))');
//$criteria->addCondition('(moderated=1 OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient IN ('.Yii::app()->user->id.',0'.((User::model()->isAuthor())?',-1':'').'))');
$criteria->addCondition('`order` = :oid');
$criteria->params[':oid'] = (int) $orderId;
$messages = ProjectMessages::model()->findAll($criteria);
?>

<div id="chatWindow" class="chat-view chtpl0-chatblock">
<?php
if (empty($messages)) {
	Yii::app()->clientScript->registerCss('cs1','
	div#chatWindow::after {
		content: "'.ProjectModule::t('Here is your correspondence').'";
	}');
	if(User::model()->isAuthor() && (!$order->executor || $order->executor==0) /*&& $order->status<=2*/) Yii::app()->clientScript->registerCss('cs2','
	div#chatWindow::before {
		 content: "'.ProjectModule::t('Please, write that you are ready to take this order or ask a question.').'";
	}');
} ?>
    <?php foreach ($messages as $message): 
//		$message->message = str_replace('<br>',"\x0D\x0A",$message->message);
		$msg_role = 'manager-message';
		$role = User::model()->getUserRole($message->senderObject->id);
		$isAuthor = ($role == 'Author');
		$isCustomer = ($role == 'Customer');
		if($isAuthor) {
			$msg_role = 'author-message';
			if ($message->senderObject->id == $order->executor) $role = 'Executor';
			$roles = User::model()->getUserRoleArr($message->senderObject->id);
			if (in_array('Corrector', $roles) && $order->technicalspec) $role = 'Corrector';
		}
		if($isCustomer) $msg_role = 'customer-message';
		$recipientRole = User::model()->getUserRole($message->recipientObject->id);
		if ($recipientRole == 'Admin') $toRecipient = ProjectModule::t('to admin');
		if ($recipientRole == 'Manager') $toRecipient = ProjectModule::t('to manager');
		if ($recipientRole == 'Customer') $toRecipient = ProjectModule::t('to customer');
		if ($recipientRole == 'Author' || !($message->recipientObject->id)) $toRecipient = ProjectModule::t('to executor');
		if ($recipientRole == 'Author' && $order->technicalspec) {
			$roles = User::model()->getUserRoleArr($message->recipientObject->id);
			if (in_array('Corrector', $roles) && $order->technicalspec) $toRecipient = ProjectModule::t('to corrector');
		}
	?>
    <div class="post chtpl0-msg <?=$msg_role ?>">
        
        <div class="chtpl0-avatar">
            
            <?php if ($isAuthor && (User::model()->isAuthor())) : ?>
                <button class="toggleexecutor executor-unset"></button>
                <div><?= (int)$message->senderObject->profile->rating ?></div>
            <?php elseif ($isCustomer): ?>
                <button class="chtpl0-user-icon-4 usual-cursor"></button>
            <?php else: ?>
                <button class="chtpl0-user-icon-3 usual-cursor"></button>
            <?php endif; ?>
            
        </div>
        
        <div class="chtpl0-content">
            
            <div class="owner chtpl0-nickname" data-ownerid="<?php echo $message->senderObject->id ?>">
				<?php echo ProjectModule::t($role).' '.$toRecipient; ?> |
			</div>
            <div class="chtpl0-date"><?= date_format(date_create($message->date), 'd.m.Y H:i:s'); ?></div>
            
            <?php if ($message->cost): ?>
                <div class="cost"><?=ProjectModule::t('Salery for a job:')?> <?php echo $message->cost ?></div>
            <?php endif; ?>
                
            <div class="text" id="<?php echo $message->id ?>"><?php echo $message->message; ?></div>
			
        </div>
    </div>
    <?php endforeach; ?>
</div>
