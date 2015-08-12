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
		if (!$this->_model)
		  $this->_model=ProjectField::model()->forAll()->findAll();
		return $this->_model;
	}
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}