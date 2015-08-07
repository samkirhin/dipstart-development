<?php

/**
 * This is the model class for table "ZakazPartsFiles".
 *
 * The followings are the available columns in table 'ZakazPartsFiles':
 * @property integer $id
 * @property integer $part_id
 * @property string $orig_name
 * @property string $file_name
 * @property string $comment
 */
class ZakazPartsFiles extends CActiveRecord
{
	public static $table_prefix;
	
	public function tableName() {
		if(isset(self::$table_prefix))
			return self::$table_prefix.'ZakazPartsFiles';
		else
			return 'ZakazPartsFiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('part_id', 'numerical', 'integerOnly'=>true),
			array('orig_name, file_name', 'length', 'max'=>100),
			array('comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, part_id, orig_name, file_name, comment', 'safe', 'on'=>'search'),
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
        
        public function changeComment($id, $comment) {
            $file = self::model()->findByPk($id);
            $file->comment = $comment;
            if ($file->save()) {
                return $file->part_id;
            } else {
                return false;
            }
            
        }
        
        public function deleteFile($id) {
            $file = self::model()->findByPk($id);
            $result = array(
                'part' => $file->part_id,
                'file' => $file->file_name
            );
            if ($file->delete()) {
                return $result;
            } else {
                return false;
            }
        }
        
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'part_id' => '№ части',
			'orig_name' => 'Оригинальное имя',
			'file_name' => 'Имя файла',
			'comment' => 'Комментарий'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('part_id',$this->part_id);
		$criteria->compare('orig_name',$this->orig_name,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ZakazPartsFiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
