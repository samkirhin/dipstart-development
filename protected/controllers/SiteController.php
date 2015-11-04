<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
            'yiichat'=>array('class'=>'YiiChatAction'),
			/*'yiifilemanagerfilepicker'=>array(
				'class'=>
					'ext.yiifilemanagerfilepicker.YiiFileManagerFilePickerAction'
			),*/
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        if (Yii::app()->user->isGuest) {
//			Yii::app()->theme='client';
            $this->render('index', array(
//          $this->render('main', array(
                'role' => 'stranger'
            ));
		} elseif (User::model()->isAuthor()){
			$this->redirect('/project/zakaz/ownList');
		} elseif (User::model()->isCustomer()){
			$this->redirect('/project/zakaz/customerOrderList');
        } else {
            $this->render('main');
        }
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['supportEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact',UserModule::t('Thank you for contacting us. We will respond to you as soon as possible.'));
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionPage()
	{
		if (isset($_POST['User']))           {
			$model = new User();
			$attributes = $_POST['User'];
			$attributes['full_name'] =  $_POST['User']['first_name'].' '.$_POST['User']['last_name'];
			$pos = strpos( $attributes['email'], '@');
			$attributes['username'] =  substr( $attributes['email'], 0, $pos);
			$attributes['full_name'] =  $_POST['User']['first_name'].' '.$_POST['User']['last_name'];
			$model->attributes	= $attributes;
			
			if($model->validate()) {
				$soucePassword = UserModule::generate_password(8);
				$model->password = UserModule::encrypting($soucePassword);
				$model->superuser=0;
				$model->status=1;
				if ($model->save()) {
					$AuthAssignment = new AuthAssignment;
					$AuthAssignment->attributes=array('itemname'=>$role,'userid'=>$model->id);
					$AuthAssignment->save();
					$login_url = '<a href="'.$this->createAbsoluteUrl('/user/login').'">'.Yii::app()->name.'</a>';
					
					$type_id = Emails::TYPE_11;
					$email = new Emails;
						
					$criteria = new CDbCriteria();
					$criteria->order = 'id DESC';
					$criteria->limit = 1;
					$model = User::model()->findAll($criteria)[0];

					$email->from_id = 1;
					$email->to_id   = $model->id;
						
					$rec   = Templates::model()->findAll("`type_id`='$type_id'");
					$id = Campaign::getId();
					$email->campaign = Campaign::getName();
					$email->name = $model->full_name;
					$email->login= $model->username;
					$email->password= $soucePassword;
				
					$email->page_cabinet = 'http://'.$_SERVER['SERVER_NAME'].'/user/profile/edit';
					$email->sendTo( $model->email, $rec[0]->title, $rec[0]->text, $type_id);
						
					$identity=new UserIdentity($model->username,$soucePassword);
					$identity->authenticate();
					Yii::app()->user->login($identity,0);
					$this->redirect(Yii::app()->controller->module->returnUrl[0]);
				
					// регистрация прошла, формируем запрос

					Yii::app()->end();
				};	
			};	
			
			$model = new ProjectFields();
			$model->attributes	= $_POST['ProjectFields'];
			
			if ($model->validate()) {
				$model->save();
			}		
		}
		Yii::app()->theme='perfect-paper';
		$this->render('page/order', array(
			'role' => 'stranger'
		));
		Yii::app()->end();
	}	
}
