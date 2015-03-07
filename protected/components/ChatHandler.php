<?php
class ChatHandler extends YiiChatDbHandlerBase {
	//
	// IMPORTANT:
	// in any time here you can use this available methods:
	//  getData(), getIdentity(), getChatId()
	//
	protected function getTableName(){
		return "ProjectMessages";
	}
	protected function getDb(){
		// the application database
		return Yii::app()->db;
	}
	protected function createPostUniqueId(){
		// generates a unique id. 40 char.
		return hash('sha1',$this->getChatId().time().rand(1000,9999));
	}
	protected function getIdentityName(){
		// find the identity name here
		// example:
		//  $model = MyPeople::model()->findByPk($this->getIdentity());
		//  return $model->userFullName();
		return User::model()->findByPk($this->getIdentity())->username;
	}
	protected function getDateFormatted($value){
		// format the date numeric $value
		return Yii::app()->format->formatDateTime($value);
	}
	protected function acceptMessage($message){
		// return false to reject it, elsewere return $message
		return $message;
	}
	public function yiichat_list_posts($chat_id, $identity, $last_id, $data){
		$res=parent::yiichat_list_posts($chat_id, $identity, $last_id, $data);
		foreach ($res as $k=>$v) {
			$res[$k]->sender=$res[$k]->getRelated('senderObject');
			$res[$k]->sender->superuser=$res[$k]->sender->getRelated('AuthAssignment');
			if ($res[$k]->recipient > 0) {
                $res[$k]->recipient = $res[$k]->getRelated('recipientObject');
                $res[$k]->recipient->superuser=$res[$k]->recipient->getRelated('AuthAssignment');
            }
		}
		return $res;
	}
}
