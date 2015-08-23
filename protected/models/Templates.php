<?php

/**
 * This is the model class for table "Templates".
 *
 * The followings are the available columns in table 'Templates':
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $text
 * @property string $type
 */
class Templates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return Campaign::getId().'_Templates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, title, text, type_id', 'required'),
			array('name, title', 'length', 'max'=>255),
			array('type_id', 'length', 'max'=>18),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, title, text, type_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t('site','Name'),
			'title' => Yii::t('site','Title'),
			'text' => Yii::t('site','Text'),
			'type_id' => Yii::t('site','Type'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('type_id',$this->type_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function performType($type_id) {
        switch ($type_id) {
         case 1:
          $type = Yii::t('site','Customer');
          break;
         case 2:
          $type = Yii::t('site','Author');
          break;
         case 3:
          $type = Yii::t('site','Service');
          break;
        }
        return $type;
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Templates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
