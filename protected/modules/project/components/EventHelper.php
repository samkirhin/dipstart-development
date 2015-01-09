<?php

class EventHelper {
    
    const TYPE_CREATE_ORDER = 1;
    const TYPE_EDIT_ORDER = 2;
    const TYPE_ADD_CHANGES = 3;
    const TYPE_NOTIFICATION = 4;
    const TYPE_MESSAGE = 5;
    const STATUS_ACTIVE = 0;
    const STATUS_DONE = 1;
    
    protected static function sendEvent($event, $type, $description) {
        
        $message = new Events;
        if (!$type) {
            $type = 'Не передан тип';
        }
        if (!$description) {
            $description = 'Отсутствует описание';
        }
        $message->type = $type;
        $message->event_id = $event;
        $message->description = $description;
        $message->timestamp = time();
        $message->status = self::STATUS_ACTIVE;
        if ($message->save()) {
            return true;
        } else {
            return false;
        }
        
    }
    
    protected static function eventTemplate($type, $description, $id) {
        
    }

    public static function createOrder($id) {
        
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
        $description = "Пользователь ".$userName." создал заказ";
        self::sendEvent($id, self::TYPE_CREATE_ORDER, $description);
        
    }
    
    public static function editOrder($id) {
        
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
        $description = "Пользователь ".$userName." отредактировал заказ";
        self::sendEvent($id, self::TYPE_EDIT_ORDER, $description);
        
    }
    
    public static function addChanges($id) {
        
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
        $description = "Пользователь ".$userName." оставил дополнение к заказу";
        self::sendEvent($id, self::TYPE_ADD_CHANGES, $description);
        
    }
    
    public static function addMessage($id) {
        
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
        $description = "Пользователь ".$userName." оставил сообщение";
        self::sendEvent($id, self::TYPE_MESSAGE, $description);
        
    }
    
    public static function notification($text, $creator) {
        
        self::sendEvent($creator, self::TYPE_NOTIFICATION, $text);
        
    }
    
}
