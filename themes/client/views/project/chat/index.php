<?php
Yii::app()->clientScript->registerScriptFile('/js/chat.js');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/custom.css');
// --- campaign      генерируем список загруженных материалов
if(isset(Zakaz::$files_folder)){
	$url = Zakaz::$files_folder.$order->id.'/';
} else {
	$url = '/uploads/'.$order->id.'/';
}
$html_string = $order->generateMaterialsList($url);
// ---
?>
<div class="container container-chat">
	<?php
		if ((User::model()->isCustomer() || User::model()->isCorrector()) && (!$order->is_active || !$moderated)) {
			echo '<div class="zakaz-info-header" ><font color="green">'.YII::t('site','AfterModerate').'.</font></div>';
		}
		if(User::model()->isExecutor($order->id)) { // Если назначен исполнитель, и именнно он смотрит
			echo '<div class="zakaz-info-header" ><font color="green">'.YII::t('site','YouAreExecutor').'</font></div>';
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

				<div id="infoZakaz" class="panel-collapse <?=(User::model()->isCorrector() ? '' : 'collapse')?>">
					<div class="panel-body">

						<div class="col-xs-12 aboutZakaz">
						<!--<div class="row">-->
							<?php
							if (User::model()->isAuthor() && !User::model()->isCorrector()) {
								$this->renderPartial('/zakaz/_view', array('model' => $order));
							} elseif(User::model()->isCustomer() || User::model()->isCorrector()) {
								if ($order->is_active) {
									$this->renderPartial('/zakaz/_form', array('model' => $order));
								} else {
									$this->renderPartial('/zakaz/_orderInModerate', array('model' => $order));
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
		
		<div id="chat" class="user-chat-block">
			<?php $this->renderPartial('chat',array('order'=>$order, 'orderId'=>$orderId));?>
			<? 	// кнопку выносим из блока, который передаётся 
				// ajax'а, чтобы избежать манипуляций с 
				// обработчиками событий
			?>
		</div>
		<?php 
		$this->renderPartial('_accessories',array('order'=>$order, 'orderId'=>$orderId));
		?>
	</div>
</div>

<?php if (User::model()->isAuthor() && !User::model()->isCorrector() && $order->executor == 0) : ?>
    
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
