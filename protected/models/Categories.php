<?php

/**
 * This is the model class for table "Categories".
 *
 * The followings are the available columns in table 'Categories':
 * @property integer $id
 * @property string $cat_name
 * @property integer $parent_id
 */
class Categories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_name', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('cat_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cat_name, parent_id', 'safe', 'on'=>'search'),
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
			'cat_name' => Yii::t('site','Cat Name'),
			'parent_id' => Yii::t('site','Parent'),
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
		$criteria->compare('cat_name',$this->cat_name,true);
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function performParent($parent_id){
        if($parent_id == 0){
            $parent = Yii::t('site','No');
        }else{
            $criteria = new CDbCriteria();
            $criteria->compare('id', $parent_id);
            $parent = $this->find($criteria)->cat_name;
        }
        return $parent;
    }
    public function performCatsTree() {
       $cats = $this->findAll('parent_id = 0');
       foreach ($cats as $item) {
            $cubats = $this->findAll('parent_id = '. $item->id);
            foreach ($cubats as $cat) {
                $tree[$item->cat_name][$cat->id] = $cat->cat_name;
            }
       }
       return $tree;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Categories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
