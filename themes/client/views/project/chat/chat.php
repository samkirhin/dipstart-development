<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 26.06.15
 * Time: 13:54
 */
$criteria=new CDbCriteria;
if(!Yii::app()->user->isGuest)
 $criteria->addCondition('(moderated=1 OR sender IN (SELECT userid FROM AuthAssignment WHERE itemname IN ("Admin","Manager")) OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient IN ('.Yii::app()->user->id.',0'.((User::model()->isAuthor())?',-1':'').'))');
$criteria->addCondition('`order` = :oid');
$criteria->params[':oid'] = (int) $orderId;
$messages = ProjectMessages::model()->findAll($criteria);
?>
<div id="chatWindow" class="col-xs-12 chat-view chtpl0-chatblock">
<?php Yii::app()->clientScript->registerCss('cs1','
div.chat-window::before {
     content: "'.ProjectModule::t('Please, write that you are ready to take this order or ask a question.').'";
}
div.chat-window::after {
    content: "'.ProjectModule::t('Here is your correspondence').'";
}'); ?>
    <?php foreach ($messages as $message): ?>
    <div class="post chtpl0-msg">
        
        <div class="chtpl0-avatar">
            
            <?php if ((User::model()->getUserRole($message->senderObject->id) == 'Author') && (User::model()->isAuthor())) : ?>
                <button class="toggleexecutor executor-unset"></button>
                <div><?= (int)$message->senderObject->profile->rating ?></div>
            <?php elseif (User::model()->getUserRole($message->senderObject->id) == 'Customer'): ?>
                <button class="chtpl0-user-icon-4 usual-cursor"></button>
            <?php else: ?>
                <button class="chtpl0-user-icon-3 usual-cursor"></button>
            <?php endif; ?>
            
        </div>
        
        <div class="chtpl0-content">
            
            <div class="owner chtpl0-nickname" data-ownerid="<?php echo $message->senderObject->id ?>">
                <!--<a data-toggle="tooltip" title="<?php echo $message->senderObject->full_name ?>" class="ownerref" href="/user/user/view?id=<?= $message->senderObject->id ?>"><?= $message->senderObject->full_name ?></a>  |-->
				<?php echo $message->senderObject->AuthAssignment->AuthItem->description; ?> |
			</div>
            <div class="chtpl0-date"><?= date_format(date_create($message->date), 'd.m.Y H:i:s'); ?></div>
            
            <?php if ($message->cost): ?>
                <div class="cost"><?=ProjectModule::t('Price for a job:')?> <?php echo $message->cost ?></div>
            <?php endif; ?>
                
            <div class="text"><?php echo $message->message; ?></div>
			
        </div>
    </div>
    <?php endforeach; ?>
	
    <?php //if(!Yii::app()->user->isGuest): ?>
	<div class="col-xs-20" id="div-edit-message" style="display: none;">
		<?php echo CHtml::textArea('edit-message','', array('rows' => 6, 'class' => 'col-xs-12', 'placeholder' => ProjectModule::t('Enter your message...'), 'id' => 'edit-message')); ?>
	</div>
    <?php //endif; ?>

</div>
