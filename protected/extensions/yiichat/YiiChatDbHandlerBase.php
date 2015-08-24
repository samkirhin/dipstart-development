<?php
/**
 * YiiChatDbHandlerBase (YiiChat A Software Interface for YiiChat Source Providers)
 *	serve this widget using a database.
 *	required: post.sql
 *
 *	this class is invoked because you specify it in your YiiChatWidget
 *	arguments passed to the widget.
 *
 *	this is the object fields required: (as an indexed array)
 *
 *		'id'				the post unique id
 *		'text'				the post text
 *		'time'				the time stamp
 *		'owner'				the name of the person who make this post
 *		'post_identity'		the ID of the person who make this post
 *
 *	the both methods in this handler receive:
 *
 *		$chat_id			the id provided in the widget, to discrimine
 *							between various chats.
 *
 *		$identity			the identity (ID) of the person who is in chat
 *							(the post_identity field is the same as $identity
 *							only when we are creating a post: yiichat_post
 *
 *		$data				a user-defined value passed from the widget
 *
 * @uses CWidget
 * @version 1.0
 * @author Christian Salazar <christiansalazarh@gmail.com>
 * @license FREE BSD
 */
abstract class YiiChatDbHandlerBase extends CComponent implements IYiiChat {

	protected $_identity;
	protected $_chat_id;
	protected $_data;

	protected function getIdentity(){ return $this->_identity; }
	protected function getChatId(){ return $this->_chat_id; }
	protected function getData(){ return $this->_data; }

	// abstract optional
	protected function getTableName(){
		$campaign = Campaign::search_by_domain($_SERVER['SERVER_NAME']);
		if ($campaign->id) {
			return '`'.$campaign->id.'_ProjectMessages`';
		} else {
			return "`ProjectMessages`";
		}
	}

	// abstract strict
	protected function getDb(){}
	protected function getIdentityName(){}
	protected function getDateFormatted($value){}
	protected function createPostUniqueId(){}
	protected function acceptMessage($message){}

	/**
	 	post a message into your database.
	 */
	public function yiichat_dapprove($post) {
		$model = ProjectMessages::model()->findByPk($post['id']);
		$model->moderated = 1;
		return $model->save();
	}
	public function yiichat_dpost($post){
		$model = ProjectMessages::model()->findByPk($post['id']);
		$model->delete();
	}
	public function yiichat_dtoggle($post){
		
		$model = Zakaz::model()->findByPk($post['chat_id']);
        
		if ($_GET['data']=='unset') {
			$model->executor = $post['ex'];
			$model->status = 4;
		}
		else {
			$model->executor = 0;
			$model->status = 3;
		}
		return $model->save();
	}
	public function yiichat_post($chat_id, $identity, $message, $postdata, $data){
		$this->_chat_id = $chat_id;
		$this->_identity = $identity;
		$this->_data = $data;
		$message_filtered = trim($this->acceptMessage($message));
		if($message_filtered != ""){
			$obj = array(
				"order"=>$chat_id,
				"sender"=>$identity,
				"date"=>date('Y-m-d H:i:s'),
				"message"=>$message_filtered,
			);
			if ($postdata['index']==0){
				if ($postdata['recipient']=='Author'){
					$obj['recipient'] = Zakaz::model()->findByPk($chat_id)->attributes['executor'];
                    if ($obj['recipient']==0) $obj['recipient']=-1;
				} elseif ($postdata['recipient']=='Customer') {
					$obj['recipient'] = Zakaz::model()->findByPk($chat_id)->attributes['user_id'];
				/*} elseif (isset($postdata['recipient'])){
					$obj['recipient'] = $postdata['recipient'];*/
				} else $obj['recipient']=0;
				$newid=$this->getDb()->createCommand()->insert($this->getTableName(),$obj);
			}
			else {
				if ($postdata['recipient']=='no') {
					$obj['recipient']=0;
                    $newid=$this->getDb()->createCommand()->update($this->getTableName(), $obj, 'id=:id', array('id' => $postdata['index']));
				}
				else if($postdata['recipient']=='redir'){
                    $sender = ProjectMessages::model()->findByPk($postdata['index'])->senderObject->AuthAssignment['itemname'];
                    $obj['sender'] = ProjectMessages::model()->findByPk($postdata['index'])->attributes['sender'];
                    $obj['moderated']=1;
                    if ($sender=='Customer') $obj['recipient']=Zakaz::model()->findByPk($chat_id)->attributes['executor'];
                    if ($sender=='Author') $obj['recipient']=Zakaz::model()->findByPk($chat_id)->attributes['user'];
                    $newid=$this->getDb()->createCommand()->insert($this->getTableName(),$obj);
                }
				else {
                    if ($postdata['recipient']=='Customer') $obj['recipient']=Zakaz::model()->findByPk($chat_id)->attributes['user_id'];
                    if ($postdata['recipient']=='Author') $obj['recipient']=Zakaz::model()->findByPk($chat_id)->attributes['executor'];
                    if (is_numeric($postdata['recipient'])) $obj['recipient']=$postdata['recipient'];
					$newid=$this->getDb()->createCommand()->insert($this->getTableName(),$obj);
				}
			}
			// now retrieve the post
            $obj['sender']=User::model()->findByPk($obj['sender']);
            $obj['sender']->superuser=$obj['sender']->getRelated('AuthAssignment');
            //$obj['recipient']=User::model()->findByPk($obj['recipient']);
            //$obj['recipient']->superuser=$obj['recipient']->getRelated('AuthAssignment');
            if ($postdata['flags'])
                foreach($postdata['flags'] as $v)
                    switch($v){
                        case 'send_sms':
                            include_once "smsc_api.php";
                            list($sms_id, $sms_cnt, $cost, $balance) = send_sms(str_replace(['+','-'],'',$obj['recipient']->profile->attributes['mob_tel']), $obj['message']);
                            break;
                        case 'send_email':
                            mail($obj['recipient']->attributes['email'],'You receive new message in chat',$obj['message']);
                            break;
                    }
			$obj['time'] = date_format(date_create($obj['date']), 'd.m.Y H:i:s');
			$obj['owner']=substr($this->getIdentityName(),0,20);
			return $obj;
		}
		else
			return array();
	}
	public function yiichat_list_posts($chat_id, $identity, $last_id, $data){
		$this->_chat_id = $chat_id;
		$this->_identity = $identity;
		$this->_data = $data;
		$messages=ProjectMessages::model()->findAll('`t`.`order` = :chat_id AND `t`.`id` > :last_id',array(':chat_id'=>$chat_id,':last_id'=>$last_id));
		foreach ($messages as $m) {
			$m->date = date_format(date_create($m->date), 'd.m.Y H:i:s');
		}
		return $messages;
	}

	/**
	 	retrieve the last posts since the last_id, must be used
		only when the records has been filtered (case timer).
	 */
	private function getLastPosts($rows, $limit, $last_id){
		if(count($rows)==0)
			return array();
		$n=-1;
		for($i=0;$i<count($rows);$i++)
			if($rows[$i]['id']==$last_id){
				$n=$i;
				break;
			}
		if($last_id=='' || $last_id==null){
			if($n==-1)
				$n = $i-1;
			if($n==0){
				// TEST CASE: 7
				return $rows;
			}else{
				// TEST CASES: 6 and 8
				$cnk2 = array_chunk($rows, $limit);
				return array_reverse($cnk2[0]);
			}
		}
		if($n > 0){
			$cnk = array_chunk($rows,$n);
			$cnk2 = array_chunk($cnk[0], $limit);
			return array_reverse($cnk2[0]);
		}else
		{
			return array();
		}
	}
}
?>
