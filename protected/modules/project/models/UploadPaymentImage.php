<?php

class UploadPaymentImage extends CFormModel
{
    const PAYMENT_DIR = '/uploads/payments/';
    
    public $file;
    public $orderId;
    
    public function rules()
    {
        return [
            ['file', 'file', 'allowEmpty'=>true, 'types'=>'jpg, jpeg, png, gif'],
        ];
    }
    
    public function save()
    {
        $order = Zakaz::model()->findByPk($this->orderId);
        
        if ($order && $this->file instanceof CUploadedFile && $order->status == 2) {
                
            $dir = Yii::getPathOfAlias('webroot') . self::PAYMENT_DIR;
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true);
            }

            $order->payment_image = md5(uniqid('')) . '.' . $this->file->extensionName;
            $order->status = 3;
            $order->save(false);
            $this->file->saveAs($dir . $order->payment_image);
        }
    }
}