<?php
/* @var $this ProjectMessagesController */
/* @var $model ProjectMessages */
/* @var $form CActiveForm */
?>
<script src="/js/chat.js"></script>
<?php foreach($messages as $message): ?>
        <?php echo $message->date; ?> - 
        <?php
            $this->beginWidget('ProfileLinkWidget',array(
                	'params'=>array(
                     	'userId' => $message->senderObject->id,
                     	'id' => "user-".$message->senderObject->id,
                     	'name' => $message->senderObject->username,
                     	'isLink' => (User::model()->isAdmin() || User::model()->isManager())? true:false
                	))
            );
            $this->endWidget();
        ?> написал
        <?php if($message->recipient): ?>
        	<?php
	    $this->beginWidget('ProfileLinkWidget',array(
	        	'params'=>array(
	             	'userId' => $message->recipientObject->id,
	             	'id' => "recipient-".$message->recipientObject->id,
	             	'name' => $message->recipientObject->username,
	             	'isLink' => (User::model()->isAdmin() || User::model()->isManager())? true:false
	        	))
	    );
	    $this->endWidget();
	?>
        <?php endif; ?>
            :
        <?php echo $message->message; ?>
        <?php if($message->cost): ?>
        Цена за работу: <?php echo $message->cost; ?>
        <?php endif; ?>
        <?php if($message->sender != Yii::app()->user->id): ?>
        	(<a href="" class="request" user="<?php echo $message->senderObject->id; ?>" username="<?php echo $message->senderObject->username; ?>">Ответить</a>)
        <?php endif; ?>
        <br/>
        <?php if (User::model()->isAdmin() || User::model()->isManager()): ?>
            (<a href="<?php echo Yii::app()->createUrl("project/chat/edit",array("messageId"=>$message->id)); ?>" class="edit">Редактировать</a> | 
            <a href="<?php echo Yii::app()->createUrl("project/chat/remove",array("messageId"=>$message->id)); ?>" class="del">Удалить</a>
            <?php if($message->moderated == 0): ?>
                | <a href="<?php echo Yii::app()->createUrl("project/chat/approve",array("messageId"=>$message->id)); ?>" class="approve">Одобрить</a>
            <?php endif; ?>
            <?php if($executor != $message->sender): ?>
                | <a href="<?php echo Yii::app()->createUrl("project/chat/setexecutor",array("orderId"=>$orderId, 'executorId' => $message->sender)); ?>" class="setexecutor">Назначить исполнителем</a>
            <?php else: ?>
            	   | <a href="<?php echo Yii::app()->createUrl("project/chat/delexecutor",array("orderId"=>$orderId)); ?>" class="delexecutor">Снять с проекта</a>
            	<?php endif; ?>
            	<?php if(User::model()->getUserRole($message->recipient) == 'Manager'): ?>
                | <a href="<?php echo Yii::app()->createUrl("project/chat/readdress",array("messageId"=>$message->id, 'ordererId' => $ordererId)); ?>" class="readdress">Переадресовать заказчику</a>
            <?php endif; ?>
            )<br/>
        <?php endif; ?>
        
<?php endforeach; ?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'project-messages-sendmessage-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'message', array('id' => 'msgLabel')); ?>
        <?php echo $form->textArea($model,'message', array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'message'); ?>
    </div>
    <?php echo $form->hiddenField($model,'order'); ?>
    <?php echo $form->hiddenField($model,'recipient', array('id' => 'recipient')); ?>
    <?php if(User::model()->isAuthor()): ?>
    	<div class="row">
    	     <p>Цена за работу:</p>
    	    <?php echo $form->textField($model, 'cost'); ?>
    	    <?php echo $form->error($model,'cost'); ?>
    	</div>
    <?php endif; ?>
    <div class="row buttons">
        <p>Дополнительно отправить:</p>
        <p><input type="checkbox"> SMS</p>
        <p><input type="checkbox"> Email</p>
        <?php echo CHtml::submitButton('Отправить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->