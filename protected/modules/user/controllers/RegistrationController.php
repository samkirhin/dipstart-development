<?php

class RegistrationController extends Controller
{
	public $defaultAction = 'registration';
	
	/**
	 * Declares class-based actions.
	 */
	/*public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}*/
	/**
	 * Registration user
	 */
	public function actionRegistration() {
		$model = new RegistrationForm;
		if(isset($_GET['role']) && $_GET['role']=='Customer') {
			$role = 'Customer';
		} elseif(isset($_GET['role']) && $_GET['role']=='Author') {
			$role = 'Author';
		} elseif(isset($_GET['role']) && $_GET['role']=='Manager') {
			$role = 'Manager';
		} else {
			$role = 'Customer';
		}
		if(isset($_POST['ajax']) && $_POST['ajax']==='simple-registration-form') {
			echo UActiveForm::validate($model);
			Yii::app()->end();
		}
		if (Yii::app()->user->id && (!Yii::app()->user->hasFlash('reg_success') && !Yii::app()->user->hasFlash('reg_failed'))) {
			$this->redirect(Yii::app()->controller->module->profileUrl);
		} else {
			if(isset($_POST['RegistrationForm'])) {
				$model->attributes=$_POST['RegistrationForm'];
				if($model->validate()) {
					$soucePassword = $this->generate_password(8);
					$model->password=UserModule::encrypting($soucePassword);
					$model->superuser=0;
					$model->status=1;
					$model->username = $model->email;
					
					if ($model->save()) {
						$AuthAssignment = new AuthAssignment;
						$AuthAssignment->attributes=array('itemname'=>$role,'userid'=>$model->id);
						$AuthAssignment->save();

						$login_url = '<a href="'.$this->createAbsoluteUrl('/user/login').'">'.Yii::app()->name.'</a>';
						UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("You have registred from {login_url}<br /><br />Your password: {pass}",array('{login_url}'=>$login_url, '{pass}'=>$soucePassword)));
						
						// новая служба системных сообщений

						$type_id = Emails::TYPE_11;
						$email = new Emails;
						
						$criteria = new CDbCriteria();
						$criteria->order = 'id DESC';
						$criteria->limit = 1;
						$user = User::model()->findAll($criteria);
						$user = $user[0];
echo '$user='; print_r($user);

						$email->from_id = 1;
						$email->to_id   = $user->id;
						
						$rec   = Templates::model()->findAll("`type_id`='$type_id'");
						$title = $rec[0]->title;
						$body  = $rec[0]->text;
						
						$campaign = Campaign::search_by_domain($_SERVER['SERVER_NAME']);
						$email->campaign = $campaign->name;
						$email->name = $profle->firstname;
						$email->login= $model->username;
						$email->password= $soucePassword;
						
						$email->page_cabinet = 'http://'.$_SERVER['SERVER_NAME'].'/user/profile/edit';
						$email->sendTo( $user->email, $body, $type_id);
						
						$identity=new UserIdentity($model->username,$soucePassword);
						$identity->authenticate();
						Yii::app()->user->login($identity,0);
						//$this->redirect(Yii::app()->controller->module->returnUrl);

						Yii::app()->user->setFlash('reg_success',UserModule::t("Thank you for your registration. Password has been sent to your e-mail. Please check your e-mail ({{login}}) before start.", ['{{login}}'=>$model->email]));

						$this->refresh();
					} else {
						Yii::app()->user->setFlash('reg_failed',UserModule::t("Sorry, something wrong... :("));
						$this->refresh();
					}
				}
			}
			Yii::app()->theme='client';
			$this->render('/user/registration',array('model'=>$model, 'role'=>$role));
		}
	}
	
	public function generate_password($number) {
		$arr = array('a','b','c','d','e','f',
					 'g','h','i','j','k','l',
					 'm','n','o','p','r','s',
					 't','u','v','x','y','z',
					 'A','B','C','D','E','F',
					 'G','H','I','J','K','L',
					 'M','N','O','P','R','S',
					 'T','U','V','X','Y','Z',
					 '1','2','3','4','5','6',
					 '7','8','9','0','.',',',
					 '(',')','[',']','!','?',
					 '&','^','%','@','*','$',
					 '<','>','/','|','+','-',
					 '{','}','`','~');
		// Генерируем пароль
		$pass = "";
		for($i = 0; $i < $number; $i++)
		{
		  // Вычисляем случайный индекс массива
		  $index = rand(0, count($arr) - 1);
		  $pass .= $arr[$index];
		}
		return $pass;
	}
	/*
	public function actionRegistration() {
            $model = new RegistrationForm;
            $profile = new Profile;
            $profile->regMode = true;
            $profile->regType = (isset($_GET['role'])?$_GET['role']:'Author');
      			// ajax validators
			if(isset($_POST['ajax']) && $_POST['ajax']==='simple-registration-form') {
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
			{
				echo UActiveForm::validate(array($model,$profile));
				Yii::app()->end();
			}
			
		    if (Yii::app()->user->id) {
		    	$this->redirect(Yii::app()->controller->module->profileUrl);
		    } else {
		    	if(isset($_POST['RegistrationForm'])) {
					$model->attributes=$_POST['RegistrationForm'];
					$profile->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
					//print_r($profile->attributes);
					//if($profile->validate()) echo 'yes!';
					if($model->validate()&&$profile->validate()) {
                        
						$soucePassword = $model->password;
						$model->activkey=UserModule::encrypting(microtime().$model->password);
						$model->password=UserModule::encrypting($model->password);
						$model->verifyPassword=UserModule::encrypting($model->verifyPassword);
						$model->superuser=0;
						$model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);
						
						if ($model->save()) {
							$AuthAssignment = new AuthAssignment;
							$AuthAssignment->attributes=array('itemname'=>$profile->regType,'userid'=>$model->id);
							$AuthAssignment->save();

							$profile->user_id=$model->id;
							$profile->save();
							if (Yii::app()->controller->module->sendActivationMail) {
								$activation_url = '<a href="'.$this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->email)).'">Активировать</a>';
								UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
							}
							
							if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
									$identity=new UserIdentity($model->username,$soucePassword);
									$identity->authenticate();
									Yii::app()->user->login($identity,0);
									$this->redirect(Yii::app()->controller->module->returnUrl);
							} else {
								if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
								} elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
								} elseif(Yii::app()->controller->module->loginNotActiv) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
								} else {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.", ['{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl)]));
								}
								$this->refresh();
							}
						}
					} else $profile->validate();
				}
				Yii::app()->theme='client';
			    $this->render('/user/registration',array('model'=>$model,'profile'=>$profile));
		    }
	}*/
}
