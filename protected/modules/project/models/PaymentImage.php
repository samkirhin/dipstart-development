<?php

/**
 * @property integer $id
 * @property integer $project_id
 * @property string $image
 * @property integer $approved
 */

class PaymentImage extends CActiveRecord
{
    public static $table_prefix;
	
	public function tableName()
    {
		if(isset(self::$table_prefix))
			return self::$table_prefix.'PaymentImage';
		else
			return 'PaymentImage';
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Payment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function defaultScope()
    {
        return [
            'alias' => 'img',
            'order' => 'img.id ASC'
        ];
    }
    
    public function approve($id)
    {
        $this->updateAll(['approved'=>1], 'project_id=:project_id AND approved=0', [':project_id'=>$id]);
    }


    public function remove($id)
    {
        new UploadPaymentImage;
        $dir = Yii::getPathOfAlias('webroot') . UploadPaymentImage::$folder;
        
        foreach ($this->findAll('project_id=:project_id AND approved=0', [':project_id'=>$id]) as $item) {
            
            if (file_exists($dir.$item->image))
                unlink($dir.$item->image);
            
            $item->delete();
        }
    }
    
}