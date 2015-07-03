<?php
/* @var $this ProjectMessagesController */
/* @var $model ProjectMessages */
/* @var $form CActiveForm */
$order = Zakaz::model()->findByPk($orderId);
Yii::app()->clientScript->registerScriptFile('/js/chat.js');
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
                    $this->widget('application.modules.project.widgets.zakazParts.ZakazPartWidget', array(
                        'projectId' => $order->id,
                    ));
                    ?>
                </div>
                <hr/>
                <div class="col-xs-12">
                    <?php $this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
                        'project' => $order,
                    )); ?>
                </div>
            </div>
            <?php
            if (1) {
                $upload = new UploadPaymentImage;
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'check-form',
                    'action' => ['zakaz/uploadPayment', 'id' => $model->id],
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array(
                        'enctype' => 'multipart/form-data',
                    )
                )); ?>
                <div class="row">
                    Скан чека <?php echo $form->fileField($upload, 'file'); ?>
                </div>
                <div class="row buttons">
                    <?php echo CHtml::submitButton('Загрузить'); ?>
                </div>
                <?php $this->endWidget();
            }
            ?>
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id' => 'justFileUpload',
                    'postParams' => array(
                        'id' => $order->id,
                    ),
                    'config' => array(
                        'action' => $this->createUrl('/project/chat/upload',array('id'=>$order->id)),
                        'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                        'disAllowedExtensions'=>array('exe'),
                        'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                        'minSizeLimit' => 10,// minimum file size in bytes
                        'onComplete' => "js:function(id, fileName, responseJSON){}"
                    )
                )
            );
            $path=Yii::getPathOfAlias('webroot').'/uploads/'.$order->id.'/';
            if (file_exists($path))
                foreach (array_diff(scandir($path), array('..', '.')) as $k=>$v)
                    if (!strstr($v,'#pre#')) echo '<a href="' . $path.$v . '" id="file" >'.$v.'</a><br />';
            ?>
        </div>
        <div class="col-xs-8">
            <div id="chat" class="col-xs-12 user-chat-block">
                <?php $this->renderPartial('chat',array('orderId'=>$order->id));?>
            </div>
                <?php
                if (!Yii::app()->request->isAjaxRequest){
                    echo CHtml::form(); ?>
                    <div class="col-xs-12">
                        <?php if (User::model()->isAuthor()): ?>

                            <div class="price-for-work-avtor">
                                <?php echo CHtml::label('Цена за работу:','cost',array('class' => 'control-label')); ?>
                                <?php echo CHtml::textField('cost'); ?>
                            </div>
                        <?php endif; ?>
                        <?php echo CHtml::label('Сообщение','message', array('id' => 'msgLabel')); ?>
                        <?php echo CHtml::textArea('message','', array('rows' => 6, 'class' => 'col-xs-12')); ?>
                    </div>


                    <div class="row buttons col-xs-12">
                        <?php
                        if(User::model()->isAuthor()) {
                            $middle_button = 'Отправить заказчику';
                        } else if(User::model()->isCustomer()) {
                            $middle_button = 'Отправить автору';
                        }
                        echo '<div  class="col-xs-6" style="padding: 0px 5px;">' . CHtml::submitButton($middle_button, array('name' => 'customer', 'class' => 'btn btn-chat col-xs-12')) . '</div>';
                        echo '<div class="col-xs-6" style="padding: 0px 5px;">' . CHtml::submitButton('Отправить менеджеру', array('name' => 'manager', 'class' => 'btn btn-chat col-xs-12')) . '</div>';
                        ?>
                    </div>
                    <?php echo CHtml::hiddenField('order',$order->id);
                    CHtml::endForm();
                }
                ?>
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
                                        'attributes' => array(
                                            'id',
                                            array(
                                                'name' => 'category_id',
                                                'type' => 'raw',
                                                'value' => Categories::model()->findByPk($order->category_id)->cat_name,
                                            ),
                                            array(
                                                'name' => 'job_id',
                                                'type' => 'raw',
                                                'value' => $order->job_id > 0 ? Jobs::model()->findByPk($order->job_id)->job_name : null,
                                            ),
                                            'title',
                                            'text',
                                            [
                                                'name' => 'author_informed',
                                                'value' => Yii::app()->dateFormatter->formatDateTime($order->author_informed),
                                            ],
                                            [
                                                'name' => 'date_finish',
                                                'value' => Yii::app()->dateFormatter->formatDateTime($order->date_finish),
                                            ],
                                            'pages',
                                            'add_demands',
                                            array(
                                                'name' => 'status',
                                                'type' => 'raw',
                                                'value' => $order->status > 0 ? ProjectStatus::model()->findByPk($order->status)->status : null,
                                            ),
                                    )));

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