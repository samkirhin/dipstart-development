<?php

class EmailsController extends Controller
{
	private	$subject = 'Notification';
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
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
	}
    
    public function actionSend($back)
    {
        $model = new Emails;
		
		if(isset($_POST['Email']))
		{
			$back = $_POST['back']
			$model->attributes=$_POST['Email'];
			$user = User::model()->findByPk($model->to);
			if($model->validate())
			{	
				$from	= Yii::app()->params['adminEmail'];
				$name	='=?UTF-8?B?'.base64_encode($from).'?=';
				$subject='=?UTF-8?B?'.base64_encode(Yii:t('site','Notification')).'?=';
				$headers="From: $from<{$from}>\r\n".
					"Reply-To: {$user->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail($from,$subject,$model->body,$headers);
				$this->refresh();
				$model->save();
			}
		}
		if (!isset($back)) $back = 'index';
        $this->render($back, [
            'model'=>$model
        ]);
    }
}