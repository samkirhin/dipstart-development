<?php
Yii::app()->clientScript->registerScriptFile('/js/chat.js');
// --- campaign      генерируем список загруженных материалов
if(isset(Zakaz::$files_folder)){
	$url = Zakaz::$files_folder.$order->id.'/';
} else {
	$url = '/uploads/'.$order->id.'/';
}
// ---
$path = Yii::getPathOfAlias('webroot') . $url;
$html_string = '';
if (file_exists($path)){
	foreach (array_diff(scandir($path), array('..', '.')) as $k => $v)
		if ((!strstr($v, '#pre#') || User::model()->isCustomer()) && !strstr($v, '#trash#')) {
			$tmp = '';
			if(strstr($v, '#pre#')) {
				$tmp = ' class="gray-file"';
				$v0 = substr($v,5);
			} else {
				$v0 = $v;
			}
			$html_string .= '<li'.$tmp.'><a id="j-file-'.$k.'" target="_blank" href="' . $url . $v . '" class="file" >' . $v0 . '</a>'
											. ' <a href="#" data-link="j-file-'.$k.'" data-dir="' . $url . '"  data-name="' . $v . '" onclick="removeFile(this); return false"><i class="glyphicon glyphicon-remove" title="'. Yii::t('site', 'Delete') .'"></i></a></li><br />'."\n"; #remove file btn
		}
} else mkdir($path,0755,true);

?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/custom.css'); ?>
<?php if (User::model()->isCustomer() && (!$order->is_active || !$moderated)) {
		// для гостя немодерированный заказ НЕ показываем, редиректим на главную
		if ($isGuest) $this->redirect('http://'.$_SERVER['SERVER_NAME'].'/');
		echo '<div class="zakaz-info-header-customer" ><font color="green">'.YII::t('site','AfterModerate').'.</font></div>';
		echo '<div class="zakaz-info-header-customer-empty" >&nbsp;</div>';
	}
?>
	<div class="container">
    <div class="row r">
		<?php 
			if(User::model()->isExecutor($order->id)) { // Если назначен исполнитель, и именнно он смотрит
				echo '<div class="zakaz-info-header" ><font color="green">'.YII::t('site','YouAreExecutor').'</font></div>';
				echo '<div class="zakaz-info-header-customer-empty">&nbsp;</div>';
			};	
		?>
        <div class="col-xs-12 info-block" style="margin-bottom: 15px;">
            <div class="panel-group" id="info-block">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-white">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#info-block" href="#infoZakaz">
                                <?=ProjectModule::t('Ordering Information').' №'.$order->id ?>
                            </a>
                        </h4>
                    </div>
                    <div id="infoZakaz" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="col-xs-12 aboutZakaz">
                            <!--<div class="row">-->
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
									}
                                    $this->widget('zii.widgets.CDetailView', array(
                                        'data' => $order,
                                        'attributes' => $columns));
									echo '<div class="materials"><h5>'.ProjectModule::t('Attached materials').'</h5><ul class="materials-files">'.$html_string.'</ul></div>';
 									echo '<div class="notes-author">';
									echo ProjectModule::t('author_notes').':<br /> '.$order->getAttribute('author_notes');
									echo '</div>';
                                } else {
									if ($isGuest) Yii::app()->theme='client';
									if ($order->is_active) {
										$this->renderPartial('/zakaz/_form', array('model' => $order, 'isGuest' => $isGuest));
									} else {
										$this->renderPartial('/zakaz/orderInModerate', array('model' => $order, 'isGuest' => $isGuest));
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
		<?php if (User::model()->isAuthor()) : ?>

		<div class="col-xs-12 rating-line"><?php

			if(User::model()->isExecutor($order->id)) { // Если назначен исполнитель, и именнно он смотрит
				echo '<div class="my-rating author-raiting">'.ProjectModule::t('My rating:').' <span class="value">'.Profile::model()->findByPk($order->executor)->rating.'</span></div>';
				$payment = ProjectPayments::model()->findByAttributes(array('order_id'=>$order->id));
				echo '<div class="my-rating">'.ProjectModule::t('Work price:').' <span class="value">'.$payment->work_price.'</span></div>'; //Стоимость проекта для автора
				echo '<div class="my-rating">'.ProjectModule::t('To pay:').' <span class="value">'.$payment->to_pay.'</span></div>';
				echo '<div class="my-rating">'.ProjectModule::t('Payed:').' <span class="value">'.$payment->payed.'</span></div>';
			}

		?>
		   <div class="my-rating"><?= ProjectModule::t('Deadline').':' ?> <span class="value"><?=Yii::app()->dateFormatter->formatDateTime($order->author_informed);?></span></div>
		</div>
		<?php endif;?>
		
        <div class="col-xs-4">
            <div class="row">
				<?php
				$this->renderPartial('payment',array('order'=>$order));
				?>
				
				<?php
				$this->widget('application.modules.project.widgets.zakazParts.ZakazPartWidget', array(
					'projectId' => $order->id,
				));
				?>
                <div class="col-xs-12 project-changes">
                    <?php $this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
                        'project' => $order,
                    )); ?>
                </div>
            </div>
            <?php
            if (User::model()->isCustomer()) {
				
                $this->widget('ext.EAjaxUpload.EAjaxUpload',
                    array(
                        'id' => 'justFileUpload',
                        'postParams' => array(
                            'id' => $order->id,
                        ),
                        'config' => array(
                            'action' => $this->createUrl('/project/chat/upload', array('id' => $order->id)),
                            'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>'. ProjectModule::t('Drag and drop files here') .'</span><div class="qq-upload-button">'. ProjectModule::t('Attach materials to the order') .'</div><ul class="qq-upload-list">'.$html_string.'</ul></div></div>',
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
                <?php $this->renderPartial('chat',array('order'=>$order, 'orderId'=>$order->id));?>
				<? 	// кнопку выносим из блока, который передаётся 
					// ajax'а, чтобы избежать манипуляций с 
					// обработчиками событий
				?>
                <?php $this->renderPartial('chatbtn');?>
            </div>
            
            <div class="row">
            <?php
            if (!Yii::app()->request->isAjaxRequest){
                echo CHtml::form(); ?>
                
                <!--
                <?php if (User::model()->isAuthor()): ?>
                <div class="col-xs-12 price-for-work-avtor">
                    <?php echo CHtml::label(ProjectModule::t('Цена за работу:'),'cost',array('class' => 'control-label')); ?>
                    <?php echo CHtml::textField('cost'); ?>
                </div>
                <?php endif; ?> 
                -->
				<?php if (!$isGuest) : ?>
                
                <div class="col-xs-9">
                    <?php echo CHtml::label(ProjectModule::t('Message'),'message', array('id' => 'msgLabel')); ?>
                    <?php echo CHtml::textArea('message','', array('rows' => 6, 'class' => 'col-xs-12', 'placeholder' => ProjectModule::t('Enter your message...'))); ?>
                </div>


                <div class="col-xs-3 chtpl0-form">
                    <h5><?=ProjectModule::t('Send message')?></h5>
                    <?php
                    if(User::model()->isAuthor()) {
                        $middle_button = ProjectModule::t('Send the customer');
                    } else if(User::model()->isCustomer()) {
                        $middle_button = ProjectModule::t('Send the author');
                    }
                    $attr = array('name' => 'customer', 'class' => 'btn btn-primary btn-chat btn-block');
					if(Yii::app()->user->isGuest) $attr['disabled'] = 'disabled';
					echo  CHtml::submitButton($middle_button, $attr) ;
                    $attr = array('name' => 'manager', 'class' => 'btn btn-primary btn-chat btn-block chtpl0-submit2');
					if(Yii::app()->user->isGuest) $attr['disabled'] = 'disabled';
                    echo  CHtml::submitButton(ProjectModule::t('Send manager'), $attr) ;
                    ?>
				<?php endif; ?>
                    
                <?php if (User::model()->isAuthor()): ?>
                    <?php echo CHtml::label(ProjectModule::t('Цена за работу:'),'cost',array('class' => 'control-label')); ?>
                    <?php echo CHtml::textField('cost'); ?>
                <?php endif; ?>
                    
                </div>
                <?php echo CHtml::hiddenField('order',$order->id);
                CHtml::endForm();
            }
            ?>
            <!-- form -->
		<?php
				if ($isGuest) {
					
					$href = 'http://'.$_SERVER['SERVER_NAME'].'/user/registration?role=Author';
					$attr = array('onclick'=>"document.location.href = '$href'", 'class'=>"btn btn-primary btn-chat btn-block");
                    echo  CHtml::submitButton(UserModule::t('Get It!'), $attr) ;
				};	
		?>
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
<script>
    /*Remove attachment file*/
    function removeFile(obj){
        if (confirm("<?php echo Yii::t('site', 'Are you sure you want to delete this item?');?>")) {
            var data=$(obj).data();
            $.post('/project/chat/apiRenameFile?orderId=<?php echo $order->id; ?>', JSON.stringify({
                'data': data
            }), function (response) {
                if (response.data){
                    obj.remove();
                    $('#'+data.link).remove();
                }
            }, 'json');
    }}/*END Remove attachment file*/
</script>
