<?php
/*
class UserController extends Controller {

	private $_model; // @var CActiveRecord the currently loaded data model instance.

	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
                    'accessControl',
                    'ajaxOnly +rating',
                    'postOnly +rating'
		));
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}	

	public function actionView() // Displays a particular model.
	{
		$model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model,
		));
	}

	public function actionIndex() // Lists all models.
	{
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>array(
		        'condition'=>'status>'.User::STATUS_BANNED,
		    ),
				
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	// * Returns the data model based on the primary key given in the GET variable.
	// * If the data model is not found, an HTTP exception will be raised.
	 
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,Yii::t('site','The requested page does not exist.'));
		}
		return $this->_model;
	}

}
*/