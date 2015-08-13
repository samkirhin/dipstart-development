<?php

class UploadPaymentImage extends CFormModel
{
    //const PAYMENT_DIR = '/uploads/payments/';
	public static $folder;
    
    public $file;
    public $orderId;
    
    public function rules()
    {
        return [
            ['file', 'file', 'allowEmpty'=>true, 'types'=>'jpg, jpeg, png, gif'],
        ];
    }
    
	public function init() {
		$c_id = Campaign::getId();
		if ($c_id) {
			self::$folder='/uploads/c'.$c_id.'/payments/';
		} else {
			self::$folder='/uploads/payments/';
		}
	}
	
    public function save()
    {
        $order = Zakaz::model()->findByPk($this->orderId);
        
        if ($order && $this->file instanceof CUploadedFile && ($order->status == 2 || $order->status == 3 || $order->status == 4)) {

            $dir = Yii::getPathOfAlias('webroot') . self::$folder;
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true);
            }

            $paymentImage = new PaymentImage;
            $paymentImage->project_id = $order->id;
            $paymentImage->image = md5(uniqid('')) . '.' . $this->file->extensionName;
            $paymentImage->save(false);
            
            //$order->status = 3;
            //$order->save(false);
            $this->file->saveAs($dir . $paymentImage->image);
        }
    }
}