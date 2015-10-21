<?php

class Sms extends CFormModel
{
    const SMSC_LOGIN = 'sms-yslugi';
    const SMSC_PASSWORD = '63cdd4ebec19bdb6ec7aee688e4acfcb';
    const SMSC_URL = 'http://smsc.ru/sys/soap.php?wsdl';
    
    
    public $number;
    public $text;
    public $message;
    private $errors;
    
    public function init()
    {
        parent::init();
        $this->errors = [
            1 => Yii::t('site','Invalid parameters'),
            2 => Yii::t('site','Invalid login or password'),
            3 => Yii::t('site','Insufficient funds in the account'),
            4 => Yii::t('site','IP-address temporarily blocked due to frequent errors in querie'),
            5 => Yii::t('site','Invalid date'),
            6 => Yii::t('site','Message is prohibited (by text or by the name of the sender)'),
            7 => Yii::t('site','Invalid phone number format'),
            8 => Yii::t('site','Message to the specified number can not be delivered'),
            9 => Yii::t('site','Sending more than one of the same request to send SMS-messages within minutes'),
        ];
    }
    
    public function rules()
    {
        return [
            ['number, text', 'required'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'number' => 'Номер',
            'text'   => 'Текст'
        ];
    }
    
    public function send()
    {
        $client = new SoapClient(self::SMSC_URL);
        $ret = $client->send_sms(["login"=>self::SMSC_LOGIN, "psw"=>self::SMSC_PASSWORD, "phones"=>$this->number, "mes"=>$this->text]);
        
        if (isset($ret->sendresult->error)) {
            $this->message = 'Ошибка. ' . $this->errors[$ret->sendresult->error];
            return false;
        }
        else {
            $this->message = 'Смс отправлено';
            return true;
        }
    }
}