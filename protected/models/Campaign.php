<?php
class Campaign extends CActiveRecord {
	private static $orgz;
	public $fileupload;
	
	public function tableName() {
		return 'Companies';
	}
	
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, domains, language, supportEmail', 'required'),
			array('name, domains, FrontPage, logo', 'length', 'max'=>255),
			array('supportEmail', 'email'),
			array('supportEmail', 'length', 'min' => 6, 'max'=>64,'message' => UserModule::t("Incorrect password (minimal length 6 symbols, maximum 30).")),
			array('Payment2ChekoutHash', 'length', 'max'=>64),
			array('organization, Payment2Chekout', 'numerical', 'integerOnly' => true),
			array('language','in','range'=>array('en','ru'),'allowEmpty'=>false),
			array('frozen, PaymentCash', 'in', 'range' => array(0, 1),'allowEmpty'=>false),
			array('fileupload', 'file', 'types'=>'jpg,jpeg,gif,png', 'maxSize'=>'204800', 'allowEmpty'=>true),
			array('header, text4guests, text4customers', 'length', 'max'=>65535),
			array('WebmasterFirstOrderRate, WebmasterSecondOrderRate', 'type', 'type'=>'float'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, frozen, organization, name, domains, language, supportEmail, PaymentCash, Payment2Chekout, Payment2ChekoutHash, FrontPage, logo, header, text4guests, text4customers, WebmasterFirstOrderRate, WebmasterSecondOrderRate', 'safe', 'on'=>'search'),
		);
	}
	public function attributeLabels() {
		return array(
			'id'                       => Yii::t('site','ID'),
			'frozen'                   => Yii::t('site','frozen'),
			//'organization'           => Yii::t('site','organization'), 
			'name'                     => Yii::t('site','company name'),
			'domains'                  => Yii::t('site','domains'),
			'language'                 => Yii::t('site','language'),
			'supportEmail'             => Yii::t('site','support email'),
			'PaymentCash'              => Yii::t('site','cash'),
			'Payment2Chekout'          => Yii::t('site','2Checkout id'),
			'Payment2ChekoutHash'      => Yii::t('site','2checkout hash'),
			'FrontPage'                => Yii::t('site','front page url'),
			'logo'                     => Yii::t('site','logo'),
			'header'                   => Yii::t('site','header text'),
			'text4guests'              => Yii::t('site','text for guests'),
			'text4customers'           => Yii::t('site','text for customers'),
			'WebmasterFirstOrderRate'  => Yii::t('site','webmaster first order rate'),
			'WebmasterSecondOrderRate' => Yii::t('site','webmaster second order rate'),
		);
	}
	public static function search_by_domain($domain) {
		$orgz = Campaign::model()->findAll("domains like '%$domain%'");
		if (count($orgz)==1) {
			return $orgz[0];
		}else
			return false;
	}
	public static function getCompany() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz;
	}
	public static function getId() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->id;
	}
	public static function getName() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->name;
	}
	public static function getLanguage() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->language;
	}
	public static function getSupportEmail() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->supportEmail;
	}
	public static function getPaymentCash() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->PaymentCash;
	}
	public static function getPayment2Chekout() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->Payment2Chekout;
	}
	public static function getPayment2ChekoutHash() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->Payment2ChekoutHash;
	}
	public static function getFrontPage() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->FrontPage;
	}
	public static function getWebmasterFirstOrderRate() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->WebmasterFirstOrderRate;
	}
	public static function getWebmasterSecondOrderRate() {
		if(!self::$orgz) self::$orgz = self::search_by_domain($_SERVER['SERVER_NAME']);
		return self::$orgz->WebmasterSecondOrderRate;
	}
	public static function filesPath() {
		return 'uploads/c'.self::getId().'/company';
	}
	public function getFilesPath() {
		return self::filesPath();
	}
	public static function getList() {
		$companies = self::model()->findAll();
		foreach ($companies as $item) {
			$list[$item->id] = $item->id . ' : ' . $item->name;
		}
		return $list;
	}
    public function beforeSave() {
		$this->logo = Tools::saveUploadedFile($this->fileupload, Yii::getPathOfAlias('webroot') . '/' . $this->getFilesPath(), $this->logo);
        return parent::beforeSave();
    }
	public function search() {
        $criteria = new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('frozen', $this->frozen);
		$criteria->addSearchCondition('name', $this->name);
		$criteria->addSearchCondition('domains', $this->domains);
		$sort = new CSort();
		$sort->defaultOrder = 't.id ASC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>$sort,
            'pagination'=>false,
        ));
	}
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}