<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 26.06.15
 * Time: 13:54
 */

if(User::model()->isAuthor()) {
    $criteria=new CDbCriteria;
    $criteria->addCondition('(moderated=1 OR sender IN (SELECT userid FROM AuthAssignment WHERE itemname IN ("Admin","Manager")) OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient=2 OR recipient=0)');
    $criteria->addCondition('`order` = :oid');
    $criteria->params[':oid'] = (int) $orderId;
    $messages = ProjectMessages::model()->findAll($criteria);
}
else if(User::model()->isCustomer()) {
    $criteria=new CDbCriteria;
    $criteria->addCondition('(moderated=1 OR sender IN (SELECT userid FROM AuthAssignment WHERE itemname IN ("Admin","Manager")) OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient='.Yii::app()->user->id.' OR recipient=0)');
    $criteria->addCondition('`order` = :oid');
    $criteria->params[':oid'] = (int) $orderId;
    $messages = ProjectMessages::model()->findAll($criteria);
}
else {
    $criteria=new CDbCriteria;
    $criteria->addCondition('`order` = :oid');
    $criteria->params[':oid'] = (int) $orderId;
    $messages = ProjectMessages::model()->findAll($criteria);
}
?>
<div class="col-xs-12 chat-view">
    <!-- Вывод чата -->
    <?php
    foreach ($messages as $message):
        echo "$message->date - {$message->senderObject->profile->firstname} {$message->senderObject->profile->lastname}";
        echo " написал {$message->recipientObject->profile->firstname} {$message->recipientObject->profile->lastname}";
        echo " : $message->message";
        if ($message->cost) echo "<div class=\"comment\">Цена за работу: $message->cost</div>";
        if ($message->sender != Yii::app()->user->id): ?>
            (<a href="" class="request" user="<?php echo $message->senderObject->id; ?>"
                username="<?php echo $message->senderObject->username; ?>">Ответить</a>)
        <?php endif; ?>
        <br/>
    <?php endforeach; ?>

    <!-- Конец вывода чата -->
</div>
