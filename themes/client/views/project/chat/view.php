<?php
Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/chat-view.css');
if(!$isGuest) Yii::app()->clientScript->registerScriptFile('/js/chat.js');
?>
<div class="container container-view">
	<div class="heading">
		<h4 class="title">
			<?=ProjectModule::t('Title').': '.$order->title ?>
		</h4>
	</div>
	<?php
	if (!$order->executor) {
		if ($order->is_active) {
		?>
			<div class="col-xs-6">
				<h5 class="title"><?=ProjectModule::t('Ordering Information').' №'.$order->id ?>:</h5>
				<?php
				$this->renderPartial('/zakaz/_view', array('model' => $order));
				?>
			</div>
			<div class="col-xs-6">
				<h5 class="title"><?=ProjectModule::t('Work stages') ?>:</h5>
				<?php
				$this->widget('application.modules.project.widgets.zakazParts.ZakazPartWidget', array(
					'projectId' => $order->id,
				));
				?>
			</div>
			<div class="col-xs-6"><?php
				$this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
					'project' => $order,
				));
			?></div>
		<?php	
		} else {
			$this->renderPartial('/zakaz/_orderInModerate', array('model' => $order));
		}

		if($isGuest){
			$href = 'http://'.$_SERVER['SERVER_NAME'].'/user/login?role=Author';
			$attr = array('onclick'=>"document.location.href = '$href'", 'class'=>"btn btn-primary btn-block btn-green btn-30");
			echo  '<div class="col-xs-12 get-it">'.CHtml::htmlButton(UserModule::t('Get It!'), $attr).'</div>';
			$company = Campaign::getCompany();
			if ($company->text4guests) echo '<div class="col-xs-12 text4guests">'.$company->text4guests.'</div>';
		}else{
			?>
			<div class="col-xs-8 take-block" data-message="<?="<div class='post'>".ProjectModule::t('Thank you! Your proposal is on the process...').'</div>';?>"><?php
				echo CHtml::form();
				echo CHtml::label(ProjectModule::t('Offer your cost'),'cost',array('class' => 'control-label'));
				echo CHtml::textField('cost');
				$attr = array('name' => 'salary', 'class' => 'btn btn-primary','id'=>'salary-to-chat');
				echo  CHtml::submitButton(ProjectModule::t('Take order'), $attr);
				CHtml::endForm();
			?></div>
			<div id="chat" class="col-xs-8 user-chat-block">
				<?php $this->renderPartial('chat',array('order'=>$order, 'orderId'=>$orderId));?>
			</div>
			<div class="col-xs-8 chat-accessories-block">
				<?php
				$this->renderPartial('_accessories',array('order'=>$order, 'orderId'=>$orderId));
				?>
			</div><?
		}
	} else {
		?>
		<div class="col-xs-8 text-block">
			<p><?=ProjectModule::t('Hello');?>!</p>
			<p><?=ProjectModule::t('Unfortunately, this order has already been taken by the other Performer!');?></p>
			<?php if($isGuest){ ?>
				<p><?=ProjectModule::t('We also have other orders in this specialty. To see...');?></p>
				<p class="small"><?=ProjectModule::t('Registration takes less than 1 minute!');?></p>
				<p><a href="http://<?=$_SERVER['SERVER_NAME'];?>/user/login?role=Author"><?=ProjectModule::t('Sign up');?></a></p>
			<?php } ?>
		</div>
		<?php
	}
	?>
</div>