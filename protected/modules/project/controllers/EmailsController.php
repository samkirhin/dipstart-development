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

		print_r($_POST);
		
		if(isset($_POST['Email']))
		{
			$back = $_POST['back'];
			$model->attributes=$_POST['Email'];
			$user = User::model()->findByPk($model->to);
			if($model->validate())
			{	
				$name	='=?UTF-8?B?'.base64_encode($from).'?=';
print_r($model);
				$model->sendTo( $user->email, $model->body);
				
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