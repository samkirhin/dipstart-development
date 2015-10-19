<?php

/**
 * This is the model class for table "Catalog".
 *
 * The followings are the available columns in table 'Catalog':
 * @property integer $id
 * @property integer $field_id
 * @property string $cat_name
 * @property integer $parent_id
 */
class Catalog extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
		$id  = Campaign::getId();
/*
		echo 'id='.$id;
		if (strpos(Yii::app()->user->guestName,'Guest')!==false){
			$this->getCampaignNumber();
			$id  = Campaign::getId();
			echo ' id(1)='.$id;
		};
*/
        return $id.'_Сatalog';
	}
	// здесь определяем, из какой компании проект нужно показывать гостю
    
	public function getCampaignNumber() 
	{
		$name = Yii::app()->user->guestName;
		if (strpos($name,'uest')==0) return false;
		// только для гостя
		if (isset($_REQUEST['campaignId'])) {
			$campaignId	= (int)$_REQUEST['campaignId'];
			$campaign	= Campaign::model()->findByPk($campaignId);

			$orderId	= 0;
			if (isset($_REQUEST['orderId'])) $orderId = (int)$_REQUEST['orderId'];
			if (!$orderId) return $campaign_id;
			$order	= Zakaz::model()->find('id=:id', array(':id'=>$orderId));
			
			if ($campaign) {
				$domains = explode( ',', $campaign->domains);
				$domain	 = $domains[0];
				$_SERVER['SERVER_NAME'] = $domain;
				return	true;
			};	
		};	
		$campaigns	= Campaign::model()->findAll();
		foreach($campaigns as $campaign){
			$domains = explode( ',', $campaign->domains);
			$domain	 = $domains[0];
			$_SERVER['SERVER_NAME'] = $domain;
			if ($this->getCampaignNumber())	return	true;
		}	
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
            array('parent_id', 'numerical', 'integerOnly' => true),
            array('cat_name', 'length', 'max' => 255),
			array('field_varname', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, field_varname, cat_name, parent_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
			'field_varname' => 'varname',
            'cat_name' => Yii::t('site', 'Cat Name'),
            'parent_id' => Yii::t('site', 'Parent'),
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
		$criteria->compare('field_varname', $this->field_varname);
        $criteria->compare('cat_name', $this->cat_name, true);
        $criteria->compare('parent_id', $this->parent_id);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function performParent($parent_id) {
        if ($parent_id == 0) {
            $parent = Yii::t('site', 'No');
        } else {
            $criteria = new CDbCriteria();
            $criteria->compare('id', $parent_id);
            $parent = $this->find($criteria)->cat_name;
        }
        return $parent;
    }

    public function performCatsTree($field_varname) {
        $cats = $this->findAllByAttributes(array('field_varname'=>$field_varname), 'parent_id = 0');
        foreach ($cats as $item) {
            $cubats = $this->findAll('parent_id = ' . $item->id);
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
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function getAll($field_varname, $only_second_level = 1)
    {
        $crit = new CDbCriteria;
		if ($only_second_level == 1)
			$arr = self::model()->findAllByAttributes(array('field_varname'=>$field_varname), 'parent_id != 0');
        else
			$arr = self::model()->findAllByAttributes(array('field_varname'=>$field_varname));
		foreach ($arr as $k => $v)
            $res[$v['id']] = $v['cat_name'];
        return $res;
    }

}