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
		return "`ProjectMessages`";
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
	public function yiichat_dapprove($messageId) {
		$model = ProjectMessages::model()->findByPk($messageId);
		$model->moderated = 1;
		$model->save();
	}
	public function yiichat_dpost($post){
		$model = ProjectMessages::model()->findByPk($post['id']);
		$model->delete();
	}
	public function yiichat_dtoggle($post){
		if (!($model = Moderation::model()->find('`order_id` = :ID', array('ID'=>$post['chat_id']))))
			$model = Zakaz::model()->findByPk($post['chat_id']);
		if ($_GET['data']=='minus') {
			$model->executor = User::model()->find('username=:executor',array(':executor'=>$post['ex']))->id;
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
					$obj['recipient']=2;
				} else if ($postdata['recipient']=='Customer')
					$obj['recipient']=3;
				else $obj['recipient']=0;
				$this->getDb()->createCommand()->insert($this->getTableName(),$obj);
			}
			else {
				if ($postdata['recipient']=='no') {
					$obj['recipient']=0;
					$this->getDb()->createCommand()->update($this->getTableName(), $obj, 'id=:id', array('id' => $postdata['index']));
				}
				else {
					$obj['recipient']=$postdata['recipient'];
					$this->getDb()->createCommand()->insert($this->getTableName(),$obj);
				}
			}
			// now retrieve the post
			$obj['sender']=User::model()->findByPk($obj['sender']);
			$obj['sender']->superuser=$obj['sender']->getRelated('AuthAssignment');
			$obj['time']=$this->getDateFormatted($obj['date']);
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

	public function runTestTimer(){
		$tests = array(
			array(
			'testid'=>'1',
			'last_id'=>'aa',
			'limit'=>3,
			'rows'=>array(
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				array('id'=>'99', 'created'=>1007, 'post_identity'=>'200'),
				array('id'=>'kk', 'created'=>1006, 'post_identity'=>'200'),
				array('id'=>'rr', 'created'=>1004, 'post_identity'=>'200'),
				array('id'=>'aa', 'created'=>1002, 'post_identity'=>'200'),
				array('id'=>'zz', 'created'=>1001, 'post_identity'=>'200'),
				),
			'results'=>array(
				array('id'=>'kk', 'created'=>1006, 'post_identity'=>'200'),
				array('id'=>'99', 'created'=>1007, 'post_identity'=>'200'),
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				),
			),//test n

			array(
			'testid'=>'2',
			'last_id'=>'pp',
			'limit'=>3,
			'rows'=>array(
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				array('id'=>'99', 'created'=>1007, 'post_identity'=>'200'),
				array('id'=>'kk', 'created'=>1006, 'post_identity'=>'200'),
				array('id'=>'rr', 'created'=>1004, 'post_identity'=>'200'),
				array('id'=>'aa', 'created'=>1002, 'post_identity'=>'200'),
				array('id'=>'zz', 'created'=>1001, 'post_identity'=>'200'),
				),
			'results'=>array(),
			),//test n

			array(
			'testid'=>'3',
			'last_id'=>'qq',
			'limit'=>3,
			'rows'=>array(
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				array('id'=>'99', 'created'=>1007, 'post_identity'=>'200'),
				array('id'=>'kk', 'created'=>1006, 'post_identity'=>'200'),
				array('id'=>'rr', 'created'=>1004, 'post_identity'=>'200'),
				array('id'=>'aa', 'created'=>1002, 'post_identity'=>'200'),
				array('id'=>'zz', 'created'=>1001, 'post_identity'=>'200'),
				),
			'results'=>array(),
			),//test n

			array(
			'testid'=>'4',
			'last_id'=>'99',
			'limit'=>3,
			'rows'=>array(
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				array('id'=>'99', 'created'=>1007, 'post_identity'=>'200'),
				array('id'=>'kk', 'created'=>1006, 'post_identity'=>'200'),
				array('id'=>'rr', 'created'=>1004, 'post_identity'=>'200'),
				array('id'=>'aa', 'created'=>1002, 'post_identity'=>'200'),
				array('id'=>'zz', 'created'=>1001, 'post_identity'=>'200'),
				),
			'results'=>array(
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				),
			),//test n

			array(
			'testid'=>'5',
			'last_id'=>'bb',
			'limit'=>3,
			'rows'=>array(
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				array('id'=>'99', 'created'=>1007, 'post_identity'=>'200'),
				array('id'=>'kk', 'created'=>1006, 'post_identity'=>'200'),
				array('id'=>'rr', 'created'=>1004, 'post_identity'=>'200'),
				array('id'=>'aa', 'created'=>1002, 'post_identity'=>'200'),
				array('id'=>'zz', 'created'=>1001, 'post_identity'=>'200'),
				),
			'results'=>array(),
			),//test n

			array(
			'testid'=>'6',
			'last_id'=>'',
			'limit'=>3,
			'rows'=>array(
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				array('id'=>'99', 'created'=>1007, 'post_identity'=>'200'),
				array('id'=>'kk', 'created'=>1006, 'post_identity'=>'200'),
				array('id'=>'rr', 'created'=>1004, 'post_identity'=>'200'),
				array('id'=>'aa', 'created'=>1002, 'post_identity'=>'200'),
				array('id'=>'zz', 'created'=>1001, 'post_identity'=>'200'),
				),
			'results'=>array(
				array('id'=>'kk', 'created'=>1006, 'post_identity'=>'200'),
				array('id'=>'99', 'created'=>1007, 'post_identity'=>'200'),
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				),
			),//test n

			array(
			'testid'=>'7',
			'last_id'=>'',
			'limit'=>3,
			'rows'=>array(
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				),
			'results'=>array(
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				),
			),//test n

			array(
			'testid'=>'8',
			'last_id'=>'',
			'limit'=>3,
			'rows'=>array(
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				array('id'=>'99', 'created'=>1007, 'post_identity'=>'200'),
				),
			'results'=>array(
				array('id'=>'99', 'created'=>1007, 'post_identity'=>'200'),
				array('id'=>'qq', 'created'=>1009, 'post_identity'=>'200'),
				),
			),//test n

			array(
			'testid'=>'9',
			'last_id'=>'',
			'limit'=>3,
			'rows'=>array(
				),
			'results'=>array(
				),
			),//test n
		);
		foreach($tests as $test){
			echo "TEST#".$test['testid'].", last_id[".$test['last_id']."]: ";
			$r = $this->getLastPosts($test['rows'],$test['limit'],$test['last_id']);
			$r2 = $test['results'];
			if(count($r) == count($r2)){
				$ok=true;$n=-1;
				for($i=0;$i<count($r);$i++)
					if(!(($r[$i]['id'] == $r2[$i]['id']) &&
						($r[$i]['created'] == $r2[$i]['created'])))
							 { $ok=false; $n=$i; break; }
				if($ok==true){
					echo "OK<br/>";
				}else
				echo "<br/>ERR_".$n."<br/>".json_encode($r)."<br/>, MUSTBE:<br/>".json_encode($r2);
			}
			else {
				echo "<br/>ERR_SIZE<br/>".json_encode($r)."<br/>, MUSTBE:<br/>".json_encode($r2);
			}
			echo "<br/>";
		}
	}

}
?>
