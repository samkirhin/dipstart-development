<?php
if (User::model()->isCustomer()) {
	$to_recive = ProjectPayments::model()->findByAttributes(array('order_id'=>$order->id))->to_receive;
	if ($to_recive>0) {
		if(Campaign::getPaymentCash()==1) {
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
			echo '</div>';
		}
		
		if(Campaign::getPayment2Chekout()!=0) {
		// 2Checkout form
		?>
		<form action='https://sandbox.2checkout.com/checkout/purchase' method='post'>
		  <input type='hidden' name='sid' value='<?php echo Campaign::getPayment2Chekout(); ?>' />
		  <input type='hidden' name='mode' value='2CO' />
		  <input type='hidden' name='li_0_type' value='product' />
		  <input type='hidden' name='li_0_name' value='order<?=$order->id; ?>' />
		  <input type='hidden' name='li_0_price' value='<?=$to_recive; ?>' />
		  <input type='hidden' name='li_0_product_id' value='<?=$order->id; ?>' />
		  <input type='hidden' name='x_receipt_link_url' value=<?='http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?> />

		  <input type='hidden' name='card_holder_name' value='Checkout Shopper' />
		  <input type='hidden' name='street_address' value='123 Test Address' />
		  <input type='hidden' name='street_address2' value='Suite 200' />
		  <input type='hidden' name='city' value='Columbus' />
		  <input type='hidden' name='state' value='OH' />
		  <input type='hidden' name='zip' value='43228' />
		  <input type='hidden' name='country' value='USA' />
		  <input type='hidden' name='email' value='example@2co.com' />
		  <input type='hidden' name='phone' value='614-921-2450' />
		  
		  <input name='submit' type='submit' value='<?=ProjectModule::t('Pay online')?>' />
		</form>
		<?php
		}
		echo '<hr>';
	}
}