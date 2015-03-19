<?php
/* @var $this ProjectMessagesController */
/* @var $model ProjectMessages */
/* @var $form CActiveForm */
?>

<?php 
    if (User::model()->isAuthor()) {
        
        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$order,
            'attributes'=>$attributes,
        )); 
        
    } else {

        if (!ModerationHelper::isOrderChanged($order->id)) {
            $this->renderPartial('/zakaz/_form', array('model' => $order, 'times' => $times));
        } else {
            $this->renderPartial('/zakaz/orderInModerate');
        }
    }
?>

<h3 ><?php echo ProjectModule::t('Changes'); ?></h3>

<?php $this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
        'project' => $order,
    )); ?>
<div><a href='#' id='file-picker'><?php echo Yii::t('site','File manager');?></a>
</div>

<!-- required div layout begins -->
<div id='file-picker-viewer'>
    <div class='body'></div>
    <hr/>
    <div id='myuploader'>
        <label rel='pin'><b>Upload Files
                <img src='images/pin.png'></b></label>
        <br/>
        <div class='files'></div>
        <div class='progressbar'>
            <div>Uploading your file(s), please wait...</div>
            <img src='images/progressbar.gif' />
            <div class='progress'>
            </div>
            <img class='canceljob' src='images/delete.png' title='cancel the upload'/>
        </div>
    </div>
    <hr/>
    <button id='select_file' class='ok_button'>Select File(s)</button>
    <button id='delete_file' class='delete_button'>Delete Selected File(s)</button>
    <button id='close_window' class='cancel_button'>Close Window</button>
</div>
<!-- required div layout ends -->

<hr/>Logger:<br/><div id='logger'></div>

<?php
// the widget
//
$this->widget('application.components.MyYiiFileManViewer'
    ,array(
        // layout selectors:
        'launch_selector'=>'#file-picker',
        'list_selector'=>'#file-picker-viewer',
        'uploader_selector' => '#myuploader',
        // messages:
        'delete_confirm_message' => 'Confirm deletion ?',
        'select_confirm_message' => 'Confirm selected items ?',
        'no_selection_message' => 'You are required to select some file',
        // events:
        'onBeforeAction'=>
            "function(viewer,action,file_ids) { return true; }",
        'onAfterAction'=>
            "function(viewer,action,file_ids, ok, response) {
				if(action == 'select'){
				  // actions: select | delete
				  $.each(file_ids, function(i, item){
				  $('#logger').append('file_id='+item.file_id
				  + ', <img src=\''+item.url+'&size=full\'><br/>');
				});
			}
		}",
        // 'onBeforeLaunch'=>"function(_viewer){ }",
        'onClientSideUploaderError'=>
            "function(messages){
				$(messages).each(function(i,m){  alert(m); });
			}
		",
        'onClientUploaderProgress'=>"function(status, progress){
			$('#logger').append(
				'progress: '+status+' '+progress+'%<br/>');
			}",
    ));
?>
<?php if (User::model()->isAuthor()) echo 'Заметки для автора: '.$order->getAttribute('author_notes'); ?>
<table>
    <tr>
        <?php
        foreach (ZakazParts::model()->attributeLabels() as $k=>$v) {
            if (User::model()->isAuthor() || $k=='file')echo '<th>'.CHtml::encode($v).'</th>';
        }
        ?>
    </tr>
    <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$parts,
            'itemView'=>'_part',
        ));
    ?>
</table>
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
            <?php if (User::model()->getUserRole($message->sender) == 'Author'): ?>
            <?php if($executor != $message->sender): ?>
                | <a href="<?php echo Yii::app()->createUrl("project/chat/setexecutor",array("orderId"=>$orderId, 'executorId' => $message->sender)); ?>" class="setexecutor">Назначить исполнителем</a>
            <?php else: ?>
            	   | <a href="<?php echo Yii::app()->createUrl("project/chat/delexecutor",array("orderId"=>$orderId)); ?>" class="delexecutor">Снять с проекта</a>
            	<?php endif; ?>
            <?php  endif; ?>
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
        <?php
        echo CHtml::submitButton('Отправить');
        echo CHtml::submitButton($middle_button, array('name'=>'customer'));
        echo CHtml::submitButton('Отправить менеджеру', array('name'=>'manager'));
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
