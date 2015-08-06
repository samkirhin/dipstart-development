<?php
class Campaign extends CActiveRecord {
	public static $orgz;
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
	public static function getId() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->id;
	}
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}