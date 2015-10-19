<?php

class AdminController extends Controller
{
	public $defaultAction = 'admin';
	public $layout='//layouts/second_menu';
	
	private $_model;

	public function get_specials($specials=''){
		
		$model	= Catalog::model()->findAllByAttributes(array('field_varname'=>'specials'));
        $list	= CHtml::listData($model, 'id', 'cat_name');

		$arr	= explode( ',', $specials);
		$sizenumber = count($list);
		$select	= '
			<select class="select-specilization" name="Profile[specials]" id="Profile[specials]" multiple size="'.$sizenumber.'">
			<option value="" disabled>'.ProjectModule::t('UseCtrlForMultiselect').'</option>
			<optgroup label="'.ProjectModule::t('All').'">'.ProjectModule::t('All').'</optgroup>
		';
		foreach($list as $key => $opt){
			$select	.= '<option value="'.$key.'"';
			if (in_array( $key, $arr))
				$select	.= ' selected="selected"';
			$select	.= '>'.Yii::t('project', $opt).'</option>';
		}
		$select	.= '</select>';
		return $select;
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','view'),
//				'users'=>UserModule::getAdmins(),
				'users'=>array('admin','manager')
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$model	= $this->loadModel();
		$specials = $this->get_specials();
		$this->render('view',array(
			'model'		=> $model,
			'specials'	=> $specials,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model		= new User;
		$profile	= new Profile;
		$specials	= $this->get_specials($model->profile->specials);
		
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			
			$_temp = array('','icq','sms','email');
			$_POST['Profile']['mailing_list'] = array_search($_POST['Profile']['mailing_list'],$_temp);
			$profile->attributes=$_POST['Profile'];
			$profile->user_id=0;
			if($model->validate()&&$profile->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					$profile->user_id=$model->id;
					$profile->save();
				}
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$specials = $this->get_specials();
		$this->render('create',array(
			'model'		=> $model,
			'profile'	=> $profile,
			'specials'	=> $specials,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model			= $this->loadModel();
		$profile		= $model->profile;
		$specials	= $this->get_specials($model->profile->specials);

		$this->performAjaxValidation(array($model,$profile));

		$manager = !User::model()->isAuthor();
		$admin	 = User::model()->isAdmin();

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$_POST['Profile']['mailing_list'] = array_search($_POST['Profile']['mailing_list'],array('','icq','sms','email'));
			$profile->setAttributes($_POST['Profile'], false);
			if($model->validate()&&$profile->validate()) {
				$old_password = User::model()->notsafe()->findByPk($model->id);
				if ($old_password->password!=$model->password) {
					$model->password=Yii::app()->controller->module->encrypting($model->password);
					$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
				}
				$model->save();
				$profile->save();
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		};

		$specials = $this->get_specials();

		$fields = ProfileField::model()->findAll();
		$this->render('update',array(
			'model'		=> $model,
			'profile'	=> $profile,
			'manager'	=> $manager,
			'admin'		=> $admin,
			'fields'	=> $fields,
			'specials'	=> $specials,
		));	
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel();
			$profile = Profile::model()->findByPk($model->id);
			$AuthAssignment = AuthAssignment::model()->findByAttributes(array('userid'=>$model->id));
			if($AuthAssignment) $AuthAssignment->delete();
			if($profile) $profile->delete();
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('/user/admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($validate)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($validate);
			Yii::app()->end();
		}
	}
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->notsafe()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,Yii::t('site','The requested page does not exist.'));
		}
		return $this->_model;
	}
	
}
