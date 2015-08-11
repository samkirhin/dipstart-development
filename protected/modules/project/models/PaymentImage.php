<?php

/**
 * @property integer $id
 * @property integer $project_id
 * @property string $image
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
}