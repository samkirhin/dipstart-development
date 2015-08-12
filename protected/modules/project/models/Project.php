<?php
class Project extends CActiveRecord {
	private $_model;
	public function tableName() {
		$c_id = Campaign::getId();
		if ($c_id)
			return $c_id.'_Projects';
		else
			return 'Projects';
	}
    public function init() {
        parent::init();
    }
	public function getFields() {
		/*if ($this->regMode) {
			if (!$this->_modelReg){
				$criteria = new CDbCriteria();
                                $criteria->order = 'position';
				if ($this->regType == 'Author'){
				   $criteria->addInCondition('visible',array(2,3));
				   $this->_modelReg=ProfileField::model()->findAll($criteria);
				}elseif ($this->regType == 'Customer'){
				   $criteria->addInCondition('visible',array(1,3));
				   $this->_modelReg=ProfileField::model()->findAll($criteria);
				}
		   }
			return $this->_modelReg;
		} else {*/
			if (!$this->_model)
			  $this->_model=ProjectField::model()->forAll()->findAll();
			return $this->_model;
		//}
	}
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}