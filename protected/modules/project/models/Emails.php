<?php
/*
 * @property integer $id
 * @property integer $from
 * @property integer $to
 * @property string  $body
 * @property integer $type
 * @property integer $dt
 */

class Emails extends CActiveRecord {
    
	
	public static $table_prefix;
	
	public function tableName() {
		if(isset(self::$table_prefix))
			return self::$table_prefix.'Emails';
		else
			return 'Emails';
	}
    
    public function rules() {
        return array(
            array('from,to,body,type,dt', 'required'),
            array('id,from,to,body,type,dt', 'safe'),
        );
    }
    
    public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
        
    public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'from' => Yii:t('site','From'),
			'to' => Yii:t('site','To'),
			'body' => Yii:t('site','Body'),
			'type' => Yii:t('site','Type'),
			'dt' => Yii:t('site','Date'),
		);
	}
        
    public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('from',$this->from);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('dt',$this->dt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
