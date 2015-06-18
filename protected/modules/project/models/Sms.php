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
            1 => 'Ошибка в параметрах',
            2 => 'Неверный логин или пароль',
            3 => 'Недостаточно средств на счету Клиента',
            4 => 'IP-адрес временно заблокирован из-за частых ошибок в запросах',
            5 => 'Неверный формат даты',
            6 => 'Сообщение запрещено (по тексту или по имени отправителя)',
            7 => 'Неверный формат номера телефона',
            8 => 'Сообщение на указанный номер не может быть доставлено',
            9 => 'Отправка более одного одинакового запроса на передачу SMS-сообщения в течение минуты'
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