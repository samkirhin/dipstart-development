<?php

class EmailsController extends Controller
{
	private	$subject = 'Notification';
    protected $_request;
    protected $_response;
	
    public function filters()
	{
		return array(
			'accessControl'
		);
	}
	public function accessRules()
	{
        return array(
            array('allow',
                'actions'=>array('index','send'),
                'users'=>array('admin','manager'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
	}

    /*Вызов методов для работы с json*/
    protected function _prepairJson() {
        $this->_request = Yii::app()->jsonRequest;
        $this->_response = new JsonHttpResponse();
echo '<br>$this->_request='; print_r($this->_request);
    }
	
	public function actionIndex()
	{
	}
    
    public function actionSend()
    {
		$model = new Emails;
		
		$this->_prepairJson();

		$orderId = $this->_request->getParam('orderId');
		$typeId = $this->_request->getParam('typeId');
		$back = $this->_request->getParam('back');
		$cost = $this->_request->getParam('cost');
	echo '<br>$type_id='.$typeId.' $orderId='.$orderId;

		$order	 = Zakaz::model()->findByPk($orderId);
//print_r($order);
		
		$arr_type = array(
				Emails::TYPE_18,
				Emails::TYPE_19,
				Emails::TYPE_20,
				Emails::TYPE_21,
				Emails::TYPE_22,
				Emails::TYPE_23,
				Emails::TYPE_24,
		);
		if (in_array($typeId,$arr_type)) {
			$user = User::model()->findByPk($order->executor);
		} else {
			$user = User::model()->findByPk($order->user_id);
		};
echo '$order->executor='.$order->executor.' $order->user_id='.$order->user_id;

echo '<br>$user=';print_r($user);
		$model->to_id = $user-id;
		$profile = Profile::model()->findAll("`user_id`='$user->id'");
//print_r($profile);
		
		$rec   = Templates::model()->findAll("`type_id`='$typeId'");
		echo '<br>$rec=';print_r($rec);
		
		$title = $rec[0]->title;

		$model->name = $profle->firstname;
		if (strlen($model->name) < 2) $model->name = $user->username;
		$model->login= $user->username;
		
		$model->num_order = $orderId;
		$model->page_order = 'http://'.$_SERVER['SERVER_NAME'].'/project/chat?orderId='.$orderId;
		$model->message = $rec[0]->text;
		$model->price_order = $cost;
	echo '<br>$user->email='.$user->email;
		$model->sendTo( $user->email, $rec[0]->text, $typeId);
				
		$model->save();
/*		
		if (!isset($back)) $back = 'index';
        $this->render($back, [
            'model'=>$model
        ]);
*/		
    }
}