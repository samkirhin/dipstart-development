<?php

class SmsController extends Controller
{
    public function filters()
	{
		return array(
			'accessControl'
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
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
    
    public function actionSend()
    {
        $model = new Sms;
        
        if (isset($_POST['Sms'])) {
            $model->attributes = $_POST['Sms'];
            if ($model->validate() && $model->send()) {
                $this->refresh();
            }
        }
        
        $this->render('/sms/send', [
            'model'=>$model
        ]);
    }
}