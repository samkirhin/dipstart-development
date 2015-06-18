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
        if (count($res)>0) $order=Zakaz::model()->findByPk($chat_id);
		foreach ($res as $k=>$v) {
            $res1[$k]=$v->attributes;
            $res1[$k]['sender']=array();
			$res1[$k]['sender']['username']=$res[$k]->senderObject->profile->firstname.' '.$res[$k]->senderObject->profile->lastname;
			$res1[$k]['sender']['superuser']=$res[$k]->senderObject->getRelated('AuthAssignment')->attributes;
			if ($res[$k]->recipient > 0) {
                $res1[$k]['recipient'] = array();
                switch ($res[$k]->recipient){
                    case 1:
                        $res1[$k]['recipient']['username']='менеджеру';
                        $res1[$k]['recipient']['superuser']='Manager';
                        break;
                    case 2:
                        if (Zakaz::model()->findByPk($res[$k]->order)->executor==0){
                            $res1[$k]['recipient']['username']='автору';
                            $res1[$k]['recipient']['superuser']='Author';
                        } else {
                            $res1[$k]['recipient']['username'] = $order->author->profile->firstname.' '.$order->author->profile->lastname;
                            $res1[$k]['recipient']['superuser'] = $order->author->profile->AuthAssignment->attributes;
                        }
                        break;
                    case 3:
                        $res1[$k]['recipient']['username'] = $order->user->profile->firstname.' '.$order->user->profile->lastname;
                        $res1[$k]['recipient']['superuser'] = $order->user->profile->AuthAssignment->attributes;
                        break;
                }
                //$res1[$k]['recipient']['username'] = Zakaz::model()->findByPk($res[$k]->order)->author->profile->firstname.' '.Zakaz::model()->findByPk($res[$k]->recipient)->author->profile->lastname;
                //$res1[$k]['recipient']['superuser'] = Zakaz::model()->findByPk($res[$k]->order)->author->profile->AuthAssignment->attributes;
                //if (!isset($res1[$k]['recipient']['superuser']['itemname'])) $res1[$k]['recipient']['superuser']['itemname']=$res1[$k]['sender']['superuser']['itemname'];
            }
		}
        //print_r($res1);
		return $res1;
	}
}
