<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 04.08.15
 * Time: 12:28
 */

class AuthItem extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'AuthItem';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, type', 'required'),
            array('bizrule, data, description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name, type, bizrule, data', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'name' => UserModule::t("name"),
            'type' => UserModule::t("type"),
            'description' => UserModule::t("description"),
        );
    }
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('name',$this->itemname,true);
        $criteria->compare('type',$this->userid,true);
        $criteria->compare('bizrule',$this->bizrule,true);
        $criteria->compare('data',$this->data,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
