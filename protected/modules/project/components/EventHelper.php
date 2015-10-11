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
	const TYPE_MATERIALS_ADDED = 9; // Пользователь %..% прикрепил файлы в заказ
	const TYPE_MATERIALS_DELETED = 10; // Пользователь %..% удалил файл из заказа
    const STATUS_ACTIVE = 0;
    const STATUS_DONE = 1;

	protected static $moderate_types = array(
		TYPE_CREATE_ORDER,
		TYPE_EDIT_ORDER,
		TYPE_ADD_CHANGES,
		TYPE_UPDATE_PROFILE,
		TYPE_CHEK_UPLOADED,
		TYPE_MATERIALS_ADDED,
		TYPE_MATERIALS_DELETED,
	);
	
    public static function get_moderate_types_string() {
		$moderate_types_string = 
			self::TYPE_CREATE_ORDER.','.
			self::TYPE_EDIT_ORDER.','.
			self::TYPE_ADD_CHANGES.','.
			self::TYPE_UPDATE_PROFILE.','.
			self::TYPE_CHEK_UPLOADED.','.
			self::TYPE_MATERIALS_ADDED.','.
			self::TYPE_MATERIALS_DELETED;
		return	$moderate_types_string;
	}	
    
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
//        $description = "Пользователь ".$userName." создал заказ";
		$description = "Пользователь ".$userName." ".UserModule::t('created order');
        self::sendEvent($id, self::TYPE_CREATE_ORDER, $description);
    }

    public static function editOrder($id) {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
//        $description = "Пользователь ".$userName." отредактировал заказ";
		$description = "Пользователь ".$userName." ".UserModule::t('edited order');
        return self::sendEvent($id, self::TYPE_EDIT_ORDER, $description);
    }
    
    public static function addChanges($id) {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
//        $description = "Пользователь ".$userName." прикрепил замечания";
		$description = "Пользователь ".$userName." ".UserModule::t('attached comments');
        self::sendEvent($id, self::TYPE_ADD_CHANGES, $description);
    }
    public static function chekUploaded($id) {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
//        $description = "Пользователь ".$userName." загрузил чек";
		$description = "Пользователь ".$userName." ".UserModule::t('uploaded check');
        self::sendEvent($id, self::TYPE_CHEK_UPLOADED, $description);
    }
    public static function partDone($id, $title) {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
//        $description = "Пользователь ".$userName." загрузил часть работы '$title'";
		$description = "Пользователь ".$userName." ".UserModule::t('have uploaded part of the job')." $title";
        self::sendEvent($id, self::TYPE_PART_DONE, $description);
    }
    public static function materialsAdded($id) {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
//        $description = "Пользователь ".$userName." прикрепил файлы в заказ";
		$description = "Пользователь ".$userName." ".UserModule::t('attached files in order');
        self::sendEvent($id, self::TYPE_MATERIALS_ADDED, $description);
    }
    public static function materialsDeleted($id) {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
//        $description = "Пользователь ".$userName." удалил файл из заказа";
		$description = 'Пользователь '.$userName.' '.UserModule::t('deleted the file out of order');
        self::sendEvent($id, self::TYPE_MATERIALS_DELETED, $description);
    }

    public static function addMessage($id,$message='') {
        $userName = User::model()->findByPk(Yii::app()->user->id)->username;
//        $description = "Пользователь ".$userName." оставил сообщение: \"".$message."\"";
        $description = UserModule::t('User').' '.$userName.' '.UserModule::t('left a message').": \"$message.\"";
        self::sendEvent($id, self::TYPE_MESSAGE, $description);
    }
    
    public static function notification($text, $creator) {
        self::sendEvent($creator, self::TYPE_NOTIFICATION, $text);
    }

    public static function updateProfile() {
        $creator = Yii::app()->user->id;
        $userName = User::model()->findByPk($creator)->username;
//        $text = 'Пользователь изменил данные в профиле '.$userName;
		$text = UserModule::t('The user changed data in the profile')." $userName"; 
        return self::sendEvent($creator, self::TYPE_UPDATE_PROFILE, $text);
    }
}
