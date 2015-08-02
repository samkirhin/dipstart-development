<?php
class Campaign extends CActiveRecord {
	public function tableName() {
		return 'campaign';
	}
	public static function search_by_domain($domain) {
		$orgz = Campaign::model()->findAll("domains like '%$domain%'");
		if (count($orgz)==1) {
			return $orgz[0];
		}else
			return false;
	}
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}