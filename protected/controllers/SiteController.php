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
		if ($_POST) {
			print_r($_POST);
			die('!!!!!!!!!!!!!!!!!!!');
/*			
type_of_paper
subject
sources
topic
paper_details
additional_materials
tos
Academic_Level
spaced
hours
customer-service
pages_number
slides_number
options
email
first_name
last_name
pass
country
cellphone
have_email                                                     
have_password                                                  
*/
		};	
		Yii::app()->theme='perfect-paper';
		$this->render('page', array(
			'role' => 'stranger'
		));
		die();
		if (User::model()->isAuthor()){
			$this->redirect('/project/zakaz/ownList');
		} elseif (User::model()->isCustomer()){
			$this->redirect('/project/zakaz/customerOrderList');
        } else {
            $this->render('main');
        }
	}
}
