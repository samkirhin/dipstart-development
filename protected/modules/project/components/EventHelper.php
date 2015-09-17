<?php

class EventHelper {
    
    const TYPE_CREATE_ORDER = 1;    // Пользователь %..% оформил заказ
    const TYPE_EDIT_ORDER = 2;      // Пользователь %..% изменил информацию о заказе
    const TYPE_ADD_CHANGES = 3;     // Пользователь %..% прикрепил замечания
    const TYPE_NOTIFICATION = 4;    //
    const TYPE_MESSAGE = 5;         //
    const TYPE_UPDATE_PROFILE = 6;  // Пользователь %..% изменил информацию профиля
	const TYPE_CHEK_UPLOADED = 7;   // Пользователь %..% загрузил чек
	const TYPE_PART_DONE = 8;       // Пользователь %..% загрузил часть работы
	const TYPE_MATERIALS_ADDED = 5; // Пользователь %..% прикрепил файлы в заказ
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
        $message->save();

        return $message->id;
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
        return self::sendEvent($id, self::TYPE_EDIT_ORDER, $description);
    }
    
    public static function addChanges($id) {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
        $description = "Пользователь ".$userName." прикрепил замечания";
        self::sendEvent($id, self::TYPE_ADD_CHANGES, $description);
    }
    public static function chekUploaded($id) {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
        $description = "Пользователь ".$userName." загрузил чек";
        self::sendEvent($id, self::TYPE_CHEK_UPLOADED, $description);
    }
    public static function partDone($id, $title) {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
        $description = "Пользователь ".$userName." загрузил часть работы '$title'";
        self::sendEvent($id, self::TYPE_PART_DONE, $description);
    }
    public static function materialsAdded($id) {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
        $description = "Пользователь ".$userName." прикрепил файлы в заказ";
        self::sendEvent($id, self::TYPE_MATERIALS_ADDED, $description);
    }
    
    public static function addMessage($id,$message='') {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
        $description = "Пользователь ".$userName." оставил сообщение: \"".$message."\"";
        self::sendEvent($id, self::TYPE_MESSAGE, $description);
    }
    
    public static function notification($text, $creator) {
        self::sendEvent($creator, self::TYPE_NOTIFICATION, $text);
    }

    public static function updateProfile() {
        $creator = Yii::app()->user->id;
        $userName = User::model()->findByPk($creator)->username;
        $text = 'Пользователь изменил данные в профиле '.$userName;
        return self::sendEvent($creator, self::TYPE_UPDATE_PROFILE, $text);
    }
}
