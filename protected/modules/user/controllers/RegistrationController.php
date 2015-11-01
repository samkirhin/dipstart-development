<?php

class RegistrationController extends Controller
{
	public $defaultAction = 'registration';
	
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

						//$login_url = '<a href="'.$this->createAbsoluteUrl('/user/login').'">'.Yii::app()->name.'</a>';
						//UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("You have registred from {login_url}<br /><br />Your password: {pass}",array('{login_url}'=>$login_url, '{pass}'=>$soucePassword)));
						
						// новая служба системных сообщений

						$type_id = Emails::TYPE_11;
						$email = new Emails;
						
						$criteria = new CDbCriteria();
						$criteria->order = 'id DESC';
						$criteria->limit = 1;
						$user = User::model()->findAll($criteria);
						$user = $user[0];

						$email->from_id = 1;
						$email->to_id   = $user->id;
						
						$rec   = Templates::model()->findAll("`type_id`='$type_id'");
						$title = $rec[0]->title;
						$body  = $rec[0]->text;
						$id = Campaign::getId();
						$email->campaign = Campaign::getName();
						$email->name = $model->full_name;
						$email->login= $model->username;
						$email->password= $soucePassword;
						
						$email->page_cabinet = 'http://'.$_SERVER['SERVER_NAME'].'/user/profile/edit';
						$email->sendTo( $user->email, $body, $type_id);
						
						$identity=new UserIdentity($model->username,$soucePassword);
						$identity->authenticate();
						Yii::app()->user->login($identity,0);
//=======
						//$this->redirect(Yii::app()->controller->module->returnUrl[0]);
//						Yii::app()->user->setFlash('reg_success',UserModule::t("Thank you for your registration. Password has been sent to your e-mail. Please check your e-mail ({{login}}) before start.", ['{{login}}'=>$model->email]));
//						$this->refresh();
						//Yii::app()->end();
//>>>>>>> refs/remotes/origin/oldbadger
						
						//$this->redirect(Yii::app()->controller->module->returnUrl);
						Yii::app()->user->setFlash('reg_success',UserModule::t("Thank you for your registration. Password has been sent to your e-mail. Please check your e-mail ({{email}}) before start.", ['{{email}}'=>$model->email]));
						$this->refresh();
						//Yii::app()->end();

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
}
