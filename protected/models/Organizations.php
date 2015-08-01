<?php
class Organizations extends CActiveRecord {
	public function tableName() {
		return 'organization';
	}
	public static function search_by_domain($domain) {
		$orgz = Organizations::model()->findAll("domains like '%$domain%'");
		if (count($orgz)==1) {
			return $orgz[0];
		}else
			return false;
	}
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}