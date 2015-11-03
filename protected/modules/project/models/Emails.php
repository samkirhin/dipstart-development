<?php
/*
 * @property integer $id
 * @property integer $from
 * @property integer $to
 * @property string  $body
 * @property integer $type
 * @property integer $dt
 */

class Emails extends CActiveRecord {

	// типы уведомлений (системных сообщений)

	const TYPE_10=10; // Восстановление пароля
	const TYPE_11=11; // +Заказчику после регистрации.
	const TYPE_12=12; // +Заказчику проект принят
	const TYPE_13=13; // +Заказчику об оплате когда выставлен счет
	const TYPE_14=14; // +Заказчику когда готова часть
	const TYPE_15=15; // +Заказчику когда готова вся работа.
	const TYPE_16=16; // +Заказчику о сообщении в чате
	const TYPE_17=17; // +Заказчику о завершении заказа
	const TYPE_18=18; // +Исполнителю сообщение рассылки
	const TYPE_19=19; // +Исполнителю о назначении
	const TYPE_20=20; // +Исполнителю о сообщении в чате
	const TYPE_21=21; // +Исполнителю о съеме с заказа
	const TYPE_22=22; // Исполнителю о том что срок сдачи части наступил
	const TYPE_23=23; // +Исполнителю о новой доработке
	const TYPE_24=24; // +Исполнителю об оплате заказа
	
	public static $names_of_email = array(
	TYPE_10 =>'Восстановление пароля',
	TYPE_11 =>'Заказчику после регистрации',
	TYPE_12 =>'Заказчику проект принят',
	TYPE_13 =>'Заказчику об оплате когда выставлен счет',
	TYPE_14 =>'Заказчику когда готова часть',
	TYPE_15 =>'Заказчику когда готова вся работа',
	TYPE_16 =>'Заказчику о сообщении в чате',
	TYPE_17 =>'Заказчику о завершении заказа',
	TYPE_18 =>'Исполнителю сообщение рассылки',
	TYPE_19 =>'Исполнителю о назначении',
	TYPE_20 =>'Исполнителю о сообщении в чате',
	TYPE_21 =>'Исполнителю о съеме с заказа',
	TYPE_22 =>'Исполнителю о том что срок сдачи части наступил',
	TYPE_23 =>'Исполнителю о новой доработке',
	TYPE_24 =>'Исполнителю об оплате заказа',
	);

	
	public static $table_prefix;
	
	// эти переменные будут использоваться для подстановок в
	// телах писем с системными сообщениями.
	public 	$site;
	public 	$page_psw;
	public 	$support;
	public 	$campaign;
	public 	$name;
	public 	$login;
	public 	$password;
	public 	$page_cabinet;
	public 	$page_order;
	public 	$name_order;
	public 	$num_order;
	public 	$subject_order;
	public 	$price_order;
	public 	$price_order_part;
	public 	$sum_order;
	public 	$message;
	public 	$page_payment;
	public 	$specialization;
	public 	$name_part;
//	public 	$neworder;
	
	public 	$from_id;
	public 	$to_id;
	
	public function tableName() {
		if(isset(self::$table_prefix))
			return self::$table_prefix.'Emails';
		else
			return 'Emails';
	}
    
    public function rules() {
        return array(
            array('from,to,body,type,dt', 'required'),
            array('id,from,to,body,type,dt', 'safe'),
        );
    }
    
    public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
        
    public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'from' => Yii::t('site','From'),
			'to' => Yii::t('site','To'),
			'body' => Yii::t('site','Body'),
			'type' => Yii::t('site','Type'),
			'dt' => Yii::t('site','Date'),
		);
	}
    public function init(){
        parent::init();
		$this->site				= 'http://'.$_SERVER['SERVER_NAME'].'/';
		$this->page_psw			= '';
		$this->support			= Yii::app()->params['support'];
		$this->campaign			= '';
		$this->name				= '';
		$this->login			= '';
		$this->password			= '';
		$this->page_cabinet		= '';
		$this->page_order		= '';
		$this->name_order		= '';
		$this->num_order		= '';
		$this->subject_order	= '';
		$this->price_order		= '';
		$this->price_order_part =  '';
		$this->sum_order		= '';
		$this->message			= '';
		$this->page_payment		= '';
		$this->specialization	= '';
		$this->name_part		= '';
    }
		
    public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('from',$this->from);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('dt',$this->dt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
    public function sendTo($to, $subject, $body, $type_id = 0)
	{
		$dictionary = array(
	'%site%',
	'%the link to the password change page%',
	'%support%',
	'%campaign%',
	'%name%',
	'%Name%',
	'%login%',
	'%password%',
	'%the link to the personal account page%',
	'%Order link%',
	'%order link%',
	'%Job title%',
	'%order no%',
	'%the order number%',
	'%Job title%',
	'%job title%',
	'%Title%',
	'%title%',
	'%from the cost field%',
	'%the amount of charged%',
	'%the amount to be paid%',
	'%message body%',
	'%the link to the payment page%',
	'%specialization%',
	'%the name of the stage%',
	'%new order%',
/*		
			'%сайт%',
			'%ссылка на страницу изменения пароля%',
			'%support%',
			'%компания%',
			'%имя%',
			'%Имя%',
			'%login%',
			'%password%',
			'%ссылка на страницу личного кабинета%',
			'%Ссылка на заказ%',
			'%ссылка на заказ%',
			'%название работы%',
			'%№ заказа%',
			'%номер заказа%',
			'%тема работы%',
			'%тема заказа%',
			'%Наименование%',
			'%наименование%',
			'%из поля стоимость%',
			'%сумма из выставлено к оплате%',
			'%сумма к оплате%',
			'%текст сообщения%',
			'%ссылка на страницу оплаты%',
			'%специальность%',
			'%название части%',
			'%новый заказ%',
*/			
		);
		
		$subst = array(
			$this->site,
			$this->page_psw,
			$this->support,
			$this->campaign,
			$this->name,
			$this->name,
			$this->login,
			$this->password,
			$this->page_cabinet,
			$this->page_order,
			$this->page_order,
			$this->name_order,
			$this->num_order,
			$this->num_order,
			$this->subject_order,
			$this->subject_order,
			$this->subject_order,
			$this->subject_order,
			$this->price_order,
			$this->price_order_part,
			$this->sum_order,
			$this->message,
			$this->page_payment,
			$this->specialization,
			$this->name_part,
//			$this->neworder,
		);
//echo '<br>$subject(0)='.$subject; 
//echo '<br>$body(0)='.$body; 
		// собственно, замены
		foreach($dictionary as $key=>$fraze) {
			$translate = Yii::t('site',$fraze);
//echo '<br>$fraze(0)='.$fraze.' $translate(0)='.$translate; 
			if (strpos( $subject, $translate)) {
				$subject = str_replace( $translate, $subst[$key], $subject);
//echo '<br>subject: '.$fraze.'-->'.$translate; 
			};	
			if (strpos( $body, $translate)) {
				$body = str_replace( $translate, $subst[$key], $body);
//echo '<br>body: '.$fraze.'-->'.$translate; 
			};	
		}	
echo '<br>$subject(1)='.$subject; 
echo '<br>$body(1)='.$body; 

		$subject='=?UTF-8?B?'.base64_encode(Yii::t('site', $subject)).'?=';
//		$subject.= ' Тестовая рассылка. Тип сообщения '.$type_id.'. ('.$names_of_email[$type_id].')';
	
		$from	= Yii::app()->params['supportEmail'];
		$headers="From: $from<$from>\r\n".
			"To: $to\r\n".
//			"Cc: gregory.pelipenko@gmail.com,ako40ff@gmail.com,ekomixds@mail.ru\r\n".
			"MIME-Version: 1.0\r\n".
			"Content-Type: text/plain; charset=UTF-8";

		mail($from,$subject,$body,$headers);

		$this->from		= $this->from_id;;
		$this->to		= $this->to_id;
		$this->body		= $body;		
		$this->type		= $type_id;
		$this->dt		= time();
	}			
	
}
