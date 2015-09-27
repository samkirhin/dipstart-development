<?php
/* @var $this ProjectMessagesController */
/* @var $model ProjectMessages */
/* @var $form CActiveForm */
$order = Zakaz::model()->resetScope()->findByPk($orderId);
Yii::app()->clientScript->registerScriptFile('/js/chat.js');
?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/custom.css'); ?>
<div class="container">
    <div class="row r">
        <div class="col-xs-4">
            <div class="row">
				<?php
				if (User::model()->isCustomer()) {
					$to_recive = ProjectPayments::model()->findByAttributes(array('order_id'=>$order->id))->to_receive;
					if ($to_recive>0) {
						echo '<div class="col-xs-12 block-for-upload-chek">';
						$upload = new UploadPaymentImage;
						$form = $this->beginWidget('CActiveForm', array(
							'id' => 'check-form',
							'action' => ['zakaz/uploadPayment', 'id' => $order->id],
							'enableAjaxValidation' => false,
							'htmlOptions' => array(
								'enctype' => 'multipart/form-data',
							)
						)); ?>
						<div class="to-pay">
							<span class="text-to-pay"><?=ProjectModule::t('To pay')?><span> <span class="value-to-pay"><? echo $to_recive; ?></span> <span class="rub">&#8381;</span>
						</div>
						<div class="row chek">
							<span class="text_scan"><?=ProjectModule::t('Scan check')?></span> <?php echo $form->fileField($upload, 'file'); ?>
						</div>
						<div class="row buttons check-button-upload">
							<?php echo CHtml::submitButton(ProjectModule::t('Upload')); ?>
						</div>
						<?php $this->endWidget();
						if (count($images) > 0) {
							echo '<div class="chek-is-approving">'.ProjectModule::t('Your payment at checkout ...').'</div>';
							//$img = UploadPaymentImage::$folder . $chek_image;
                            $i = 1;
                            echo '<div class="chek-image-link">';
                            
                            foreach ($images as $item) {
                                echo CHtml::link('Чек ' . $i++, UploadPaymentImage::$folder . $item->image, array ('target' => '_blank' )) . ' ';
                            }
                            echo '</div>';
						}
						echo '</div><hr>';
					}
				}
				?>
                <?php if (User::model()->isAuthor()) : ?>
				<div class="col-xs-12"><?php
					if($order->executor != 0) { // Если назначен исполнитель
						echo '<div class="my-rating">'.ProjectModule::t('My rating:').' <span class="value">'.Profile::model()->findByPk($order->executor)->rating.'</span></div>';
						$payment = ProjectPayments::model()->findByAttributes(array('order_id'=>$order->id));
						echo '<div class="my-rating">'.ProjectModule::t('Work price:').' <span class="value">'.$payment->work_price.'</span></div>'; //Стоимость проекта для автора
						echo '<div class="my-rating">'.ProjectModule::t('To pay:').' <span class="value">'.$payment->to_pay.'</span></div>';
						echo '<div class="my-rating">'.ProjectModule::t('Payed:').' <span class="value">'.$payment->payed.'</span></div>';
					}
				?></div>
                <?php endif;?>
				<?php
				$this->widget('application.modules.project.widgets.zakazParts.ZakazPartWidget', array(
					'projectId' => $order->id,
				));
				?>
                <div class="col-xs-12">
                    <?php $this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
                        'project' => $order,
                    )); ?>
                </div>
            </div>
            <?php
			// --- campaign
			if(isset(Zakaz::$files_folder)){
				$url = Zakaz::$files_folder.$order->id.'/';
			} else {
				$url = '/uploads/'.$order->id.'/';
			}
			// ---
			//$url = '/uploads/' . $order->id . '/';
            $path = Yii::getPathOfAlias('webroot') . $url;
			$html_string = '';
            if (file_exists($path)){
                foreach (array_diff(scandir($path), array('..', '.')) as $k => $v)
                    if (!strstr($v, '#pre#') || User::model()->isCustomer()) {
						$tmp = '';
						if(strstr($v, '#pre#')) {
							$tmp = ' class="gray-file"';
							$v0 = substr($v,5);
						} else {
							$v0 = $v;
						}
						$html_string .= '<li'.$tmp.'><a target="_blank" href="' . $url . $v . '" class="file" >' . $v0 . '</a></li><br />'."\n";
					}
			} else mkdir($path);
            if (User::model()->isCustomer()) {
                $this->widget('ext.EAjaxUpload.EAjaxUpload',
                    array(
                        'id' => 'justFileUpload',
                        'postParams' => array(
                            'id' => $order->id,
                        ),
                        'config' => array(
                            'action' => $this->createUrl('/project/chat/upload', array('id' => $order->id)),
                            'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Перетащите файлы сюда</span><div class="qq-upload-button">Прикрепить материалы к заказу</div><ul class="qq-upload-list">'.$html_string.'</ul></div></div>',
                            'disAllowedExtensions' => array('exe'),
                            'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                            'minSizeLimit' => 10,// minimum file size in bytes
                            'onComplete' => "js:function(id, fileName, responseJSON){}"
                        )
                    )
                );
            }
            ?>
        </div>
        <div class="col-xs-8">
            
            <div id="chat" class="col-xs-12 user-chat-block">
                <?php $this->renderPartial('chat',array('orderId'=>$order->id));?>
            </div>
            
            <div class="row">
            <?php
            if (!Yii::app()->request->isAjaxRequest){
                echo CHtml::form(); ?>
                
                <!--
                <?php if (User::model()->isAuthor()): ?>
                <div class="col-xs-12 price-for-work-avtor">
                    <?php echo CHtml::label('Цена за работу:','cost',array('class' => 'control-label')); ?>
                    <?php echo CHtml::textField('cost'); ?>
                </div>
                <?php endif; ?> 
                -->
                
                <div class="col-xs-9">
                    <?php echo CHtml::label('Сообщение','message', array('id' => 'msgLabel')); ?>
                    <?php echo CHtml::textArea('message','', array('rows' => 6, 'class' => 'col-xs-12', 'placeholder' => 'Введите сообщение...')); ?>
                </div>


                <div class="col-xs-3 chtpl0-form">
                    <h5>Отправить сообщение</h5>
                    <?php
                    if(User::model()->isAuthor()) {
                        $middle_button = 'Отправить заказчику';
                    } else if(User::model()->isCustomer()) {
                        $middle_button = 'Отправить автору';
                    }
                    echo  CHtml::submitButton($middle_button, array('name' => 'customer', 'class' => 'btn btn-primary btn-chat btn-block')) ;
                    echo  CHtml::submitButton('Отправить менеджеру', array('name' => 'manager', 'class' => 'btn btn-primary btn-chat btn-block chtpl0-submit2')) ;
                    ?>
                    
                <?php if (User::model()->isAuthor()): ?>
                    <?php echo CHtml::label('Цена за работу:','cost',array('class' => 'control-label')); ?>
                    <?php echo CHtml::textField('cost'); ?>
                <?php endif; ?>
                    
                </div>
                <?php echo CHtml::hiddenField('order',$order->id);
                CHtml::endForm();
            }
            ?>
            <!-- form -->
            </div>
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
                    <div id="infoZakaz" class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="col-xs-12 aboutZakaz">
                                <?php
                                if (User::model()->isAuthor()) {
									if (Campaign::getId()){
										$columns = array('id', [
                                                //'name' => 'author_informed',
												'name' => 'deadline',
                                                'value' => Yii::app()->dateFormatter->formatDateTime($order->author_informed),
                                            ]);
										$projectFields = $order->getFields();
										if ($projectFields) {
											foreach($projectFields as $field) {
												if ($field->field_type == 'LIST'){
													$tmp = $field->varname;
													$columns[] = [
														'name' => $field->title,
														'type' => 'raw',
														'value' => Catalog::model()->findByPk($order->$tmp)->cat_name,
														];
												} else {
													$tmp = $field->varname;
													$columns[] = [
														'name' => $field->title,
														'value' => $order->$tmp
														];
												}
											}
										}
									} else {
										$columns = array(
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
										);
									}
                                    $this->widget('zii.widgets.CDetailView', array(
                                        'data' => $order,
                                        'attributes' => $columns));
									echo '<div class="notes-author">';
									echo 'Заметки для автора:<br /> '.$order->getAttribute('author_notes');
									echo '</div>';
									echo '<div class="materials"><h5>Прикреплённые материалы</h5><ul class="materials-files">'.$html_string.'</ul></div>';
                                } else {

                                    if ($order->is_active) {
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

<?php if (User::model()->isAuthor() && $order->executor == 0) : ?>
    
<script>
    var e = $(".info-block");
    e.detach().prependTo('.r');
    e.find('.panel-title > a').click();
</script>
    
    
<?php endif; ?>
