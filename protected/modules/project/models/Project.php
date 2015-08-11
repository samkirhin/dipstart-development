<?php
class Project extends CActiveRecord {
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
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}