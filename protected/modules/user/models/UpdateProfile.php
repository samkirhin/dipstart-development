<?php

/**
 * This is the model class for table "UpdateProfile".
 */
class UpdateProfile extends CActiveRecord
{
	public function tableName()
	{
		return 'UpdateProfile';
	}

	public function rules()
	{
		return array(
			array('attribute', 'required'),
			array('user, status, date_update', 'numerical', 'integerOnly'=>true),
			array('attribute', 'length', 'max'=>255),
			array('from_data, to_data', 'safe'),
			array('id, user, attribute, from_data, to_data, status, date_update', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'user_data'=>array(self::HAS_ONE, 'User', array('id'=>'user')),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'Пользователь',
			'attribute' => 'Атрибут',
			'from_data' => 'Сейчас',
			'to_data' => 'Хочу',
			'status' => 'Статус',
			'date_update' => 'Дата изменения',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user',$this->user);
		$criteria->compare('attribute',$this->attribute,true);
		$criteria->compare('from_data',$this->from_data,true);
		$criteria->compare('to_data',$this->to_data,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_update',$this->date_update);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave(){
		if ($this->isNewRecord) {
			$this->user = Yii::app()->user->id;
			$this->status = NULL;
		}
		$this->date_update = time();
		return parent::beforeSave();
	}

	public static function addRecord($attribute,$from,$to) {
		$model = new self;
		$model->attribute = $attribute;
		$model->from_data = $from;
		$model->to_data = $to;
		return $model->save();
	}
}
