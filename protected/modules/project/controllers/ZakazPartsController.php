<?php

class ZakazPartsController extends Controller
{
    
    protected $_request;
    protected $_response;
    
    /*Вызов методов для работы с json*/
    protected function _prepairJson() {
        $this->_request = Yii::app()->jsonRequest;
        $this->_response = new JsonHttpResponse();
    }
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','apiGetAll', 'apiCreate', 'apiDelete', 'apiGetPart'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ZakazParts;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ZakazParts']))
		{
			$model->attributes=$_POST['ZakazParts'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ZakazParts']))
		{
			$model->attributes=$_POST['ZakazParts'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ZakazParts');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ZakazParts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ZakazParts']))
			$model->attributes=$_GET['ZakazParts'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ZakazParts the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ZakazParts::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ZakazParts $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='zakaz-parts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        /* Получение списка частей для заказа по ИД*/
        public function actionApiGetAll() {
            $this->_prepairJson();
            $zakazId = $this->_request->getParam('orderId');
            if (User::model()->isAdmin() || User::model()->isManager()) {
                $parts = ZakazParts::model()->findAll('proj_id = :PROJ_ID',
                    array("PROJ_ID"=>$zakazId)
                );
                $this->_response->setData(array(
                    'parts'=>$parts
                ));
                $this->_response->send();
            }
            if (User::model()->isCustomer()) {
                $parts = ZakazParts::model()->findAll(array('proj_id = :PROJ_ID','show = :SHOW'),
                    array("PROJ_ID"=>$zakazId, "SHOW"=>1)
                );
                $this->_response->setData(array(
                    'parts'=>$parts
                ));
                $this->_response->send();
            }
        }
        
        /*Создание новой части на основе имени и ИД-заказа*/
        public function actionApiCreate() {
            $this->_prepairJson();
            $zakazId = $this->_request->getParam('orderId');
            $zakaz = Zakaz::model()->findByPk($zakazId);
            $model = new ZakazParts;
            $model->proj_id = $zakaz->id;
            $model->title = $this->_request->getParam('name');
            $model->author_id = $zakaz->executor;
            if ( $model->save() ) {
                $this->_response-> setData(array(
                    'result'=>$model->id
                ));
                $this->_response->send();
            } else {
                $this->_response->setData(array(
                    'result'=>false
                ));
                $this->_response->send();
            }
        }
        
        /*Удаление части по ИД*/
        public function actionApiDelete() {
            $this->_prepairJson();
            $id = $this->_request->getParam('id');
            $part =  ZakazParts::model()->findByPk($id);
            
            if ($part->delete()) {
                $this->_response->setData(array(
                    'result'=>true
                ));
                $this->_response->send();
            } else {
                $this->_response->setData(array(
                    'result'=>false
                ));
                $this->_response->send();
            }
        }
        
        /*Получение данных части по ИД для дальнейшего редактирования*/
        public function actionApiGetPart() {
            $this->_prepairJson();
            $id = $this->_request->getParam('id');
            $model = ZakazParts::model()->findByPk($id);
            $part = array();
            $part = $model->getAttributes();
            $this->_response->setData(array(
                    'part'=>$part
                ));
            $this->_response->send();
        } 
}
