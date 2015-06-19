<?php
/* @var $this ProjectMessagesController */
/* @var $model ProjectMessages */
/* @var $form CActiveForm */
?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/custom.css'); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-4">
            <div class="row">
                <?php if (User::model()->isAuthor()) : ?>
                <div class="col-xs-12">
                    <div class="notes-author">
                        Заметки для автора:<br /> <?php echo $order->getAttribute('author_notes'); ?>
                    </div>
                </div>
                <?php endif;?>
                <div class="col-xs-12">
                    <?php
                    $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $parts,
                        'itemView' => '_part',
                        'summaryCssClass' => 'hidden',
                        'emptyText' => '',
                        'enablePagination' => false,
                    ));
                    ?>
                </div>
                <hr/>
                <div class="col-xs-12">
                    <h4 style="margin-top: 0px;"><?php echo ProjectModule::t('Changes'); ?></h4>
                    <?php $this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
                        'project' => $order,
                    )); ?>
                </div>
            </div>
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id' => 'justFileUpload',
                    'postParams' => array(
                        'id' => $order->id,
                    ),
                    'config' => array(
                        'action' => $this->createUrl('/project/chat/upload?id='.$order->id),
                        'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                        'disAllowedExtensions'=>array('exe'),
                        'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                        'minSizeLimit' => 10,// minimum file size in bytes
                        'onComplete' => "js:function(id, fileName, responseJSON){}"
                    )
                )
            );
            ?>
        </div>
        <div class="col-xs-8">
            <div class="form">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'project-messages-sendmessage-form',
                    'enableAjaxValidation' => false,
                )); ?>
                <?php echo $form->errorSummary($model); ?>
                <div class="col-xs-12 user-chat-block">
                    <div class="col-xs-12 chat-view">
                        <!-- Вывод чата -->
                        <?php foreach ($messages as $message):
                            echo "$message->date - {$message->senderObject->profile->firstname} {$message->senderObject->profile->lastname}";
                            switch ($message->recipient){
                                case '1':
                                    echo " написал менеджеру";
                                    break;
                                case '2':
                                    if ($order->executor>0)
                                        echo " написал {$order->author->profile->firstname} {$order->author->profile->lastname}";
                                    else echo " написал автору";
                                    break;
                                case '3':
                                    echo " написал {$order->user->profile->firstname} {$order->user->profile->lastname}";
                                    break;
                            }
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
                    <div class="col-xs-12" style="padding-left: 0;">
                        <?php if (User::model()->isAuthor()): ?>

                            <div class="price-for-work-avtor">
                                <label for="ProjectMessages_cost" class="control-label">Цена за работу:</label>
                                <?php echo $form->textField($model, 'cost'); ?>
                                <?php echo $form->error($model, 'cost'); ?>
                            </div>
                        <?php endif; ?>
                        <?php echo $form->labelEx($model, 'message', array('id' => 'msgLabel')); ?>
                        <?php echo $form->textArea($model, 'message', array('rows' => 6, 'class' => 'col-xs-12')); ?>
                        <?php echo $form->error($model, 'message'); ?>
                    </div>


                    <div class="row buttons col-xs-12">
                        <?php
                        echo '<div  class="col-xs-6" style="padding: 0px 5px;">' . CHtml::submitButton($middle_button, array('name' => 'customer', 'class' => 'btn btn-chat col-xs-12')) . '</div>';
                        echo '<div class="col-xs-6" style="padding: 0px 5px;">' . CHtml::submitButton('Отправить менеджеру', array('name' => 'manager', 'class' => 'btn btn-chat col-xs-12')) . '</div>';
                        ?>
                    </div>
                    <?php echo $form->hiddenField($model, 'order'); ?>
                    <?php echo $form->hiddenField($model, 'recipient', array('id' => 'recipient')); ?>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
            <!-- form -->
        </div>
        <div class="col-xs-12 info-block" style="margin-bottom: 15px;">
            <div class="panel-group" id="info-block">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-white">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#info-block" href="#infoZakaz">
                                Информация о заказе
                            </a>
                        </h4>
                    </div>
                    <div id="infoZakaz" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="col-xs-12 aboutZakaz">
                                <?php
                                if (User::model()->isAuthor()) {

                                    $this->widget('zii.widgets.CDetailView', array(
                                        'data' => $order,
                                        'attributes' => $attributes,
                                    ));

                                } else {

                                    if (!ModerationHelper::isOrderChanged($order->id)) {
                                        $this->renderPartial('/zakaz/_form', array('model' => $order, 'times' => $times));
                                    } else {
                                        $this->renderPartial('/zakaz/orderInModerate');
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>