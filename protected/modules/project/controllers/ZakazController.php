<?php

class ZakazController extends Controller
{
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
				/*array('allow',  // allow all users to perform 'index' and 'view' actions
					'actions'=>array('index','view','download'),
					'users'=>array('*'),
				),*/
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions'=>array('view','index','create','update', 'admin', 'preview', 'moderationAnswer', 'yiifilemanagerfilepicker','list', 'ownList','customerOrderList', 'uploadPayment'),
                    'users'=>array('@'),
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions'=>array('admin','delete', 'yiifilemanagerfilepicker','apiview','apifindauthor'),
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
		$model = $this->loadModel($id);
		$model->date = date("Y-m-d H:i", $model->date);
		$model->max_exec_date = date("Y-m-d H:i", $model->max_exec_date);
		$model->date_finish = date("Y-m-d H:i", $model->date_finish);
		$this->render('view',array(
			'model'=> $model
		));
	}
	protected $_request;
	protected $_response;
	protected function _prepairJson() {
		$this->_request = Yii::app()->jsonRequest;
		$this->_response = new JsonHttpResponse();
	}
	public function actionApiFindAuthor() {
		$user = User::model()->findByPk(Yii::app()->user->id);
		$request = Yii::app()->Request;
		if (!$user->superuser)
			$this->redirect('/');
		else {
			if (!($model = Moderation::model()->find('`order_id` = :ID', array('ID'=>$request->getParam('id')))))
				$model = Zakaz::model()->findByPk($request->getParam('id'));
			if ($request->getParam('value')=='true')
				$model->status=2;
			else
				$model->status=1;
			print_r($model->status);
			$model->save();
		}
	}
	public function actionApiView() {
		$user = User::model()->findByPk(Yii::app()->user->id);
		if (!$user->superuser) {
			$this->redirect('/');
		} else {
			$this->_prepairJson();
			$sort = $this->_request->getParam('sort');
			$type = $this->_request->getParam('type');
			$searchField = $this->_request->getParam('search_field');
			$searchType = $this->_request->getParam('search_type');
			$searchString = $this->_request->getParam('search_string');
			if (!$sort) {
				$sort = 'date';
			}
			if (!$type) {
				$type = 'DESC';
			}
			if ($searchField == '' || $searchString == '' || $searchType == '') {
				$criteria = new CDbCriteria;
				$criteria->with = array('user','category','job');
				$criteria->order = 't.'.$sort.' '.$type;
				$data = Zakaz::model()->findAll($criteria);
			} else {
				$searchFieldArr=explode('.',$searchField);
				switch ($searchType) {
					case 'bigger':
						$searchType = '<';
						break;
					case 'smaller':
						$searchType = '>';
						break;
					case 'equal':
						$searchType = '=';
						break;
				}
				if (count($searchFieldArr)==3){
					$dbName=ucfirst($searchField[1]);
					$searchString = $dbName::model()->findByAttributes(array($searchFieldArr[0]=>$searchString))->id;
					$searchField=$searchFieldArr[2];
				}
				$criteria = new CDbCriteria;
				$criteria->with = array('user','category','job');
				$criteria->condition='`t`.`'.$searchField.'` '.$searchType.' :scrit';
				$criteria->params=array(':scrit'=>$searchString);
				$criteria->order = '`t`.`'.$sort.'` '.$type;
				$data = Zakaz::model()->findAll($criteria);
			}
			$report = array();
			$report['summary'] = 0;
			$report['ids_count'] = count($data);
			foreach($data as $num=>$dat) {
				$res[$num]=$data[$num]->getAttributes()
				+$data[$num]->user->getAttributes()
				+((isset($data[$num]->category))?$data[$num]->category->getAttributes():array('cat_name'=>'Не определена'))
				+((isset($data[$num]->job))?$data[$num]->job->getAttributes():array('job_name'=>'Не определена'));
				}
			$this->_response->setData( array(
				'data' => $res,
				'report' => $report
			));
			$this->_response->send();
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            // start author Emericanec
            if(User::model()->isAdmin()) {
                $modelName = 'Zakaz';
                $model = new $modelName();

            }else{
                $modelName = 'Moderation';
                $model = new $modelName();

            }
            // end author Emericanec

			$model->date_finish = strtotime(date("d.m.Y"));
			$model->max_exec_date = strtotime(date("d.m.Y"));

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST[$modelName]))
			{
				$role = User::model()->getUserRole();
				$model->attributes=$_POST[$modelName];

                $model->max_exec_date = strtotime($_POST['Zakaz']['max_exec_date']['date'].' '.$_POST['Zakaz']['max_exec_date']['hours'].':'.$_POST['Zakaz']['max_exec_date']['minutes']);
				$model->date_finish = strtotime($_POST['Zakaz']['date_finish']['date'].' '.$_POST['Zakaz']['date_finish']['hours'].':'.$_POST['Zakaz']['date_finish']['minutes']);

				if($model->save()){
					if (!User::model()->isManager()) {
						EventHelper::createOrder($model->id);
					}
					$this->redirect(array('view','id'=>$model->id));
				}
			}

			$times = [];
			$times['date_finish']['date'] = date("d.m.Y", $model->date_finish);
			$times['date_finish']['hours'] = date("H", $model->date_finish);
			$times['date_finish']['minutes'] = date("i", $model->date_finish);
			$times['max_exec_date']['date'] = date("d.m.Y", $model->max_exec_date);
			$times['max_exec_date']['hours'] = date("H", $model->max_exec_date);
			$times['max_exec_date']['minutes'] = date("i", $model->max_exec_date);

			$this->render('create',array(
					'model'=>$model,
					'times'=>$times
			));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
			$role = User::model()->getUserRole();
			$view = 'update';
			$isModified = false;
		Yii::app()->session['project_id'] = $id;
		$model=$this->loadModel($id);
		if (ModerationHelper::isOrderChanged($id)) {
			if ($role == 'Customer' ) {
				$view = 'orderInModerate';
			} else {
				$isModified = true;
				$modelRows = $model->attributes;
				$moderateModel = Moderation::model()->find('`order_id` = :ID', array(
					'ID'=>$id
				));
				unset($modelRows[$id]);
				foreach ($modelRows as $key=>$value) {
					$model->$key = $moderateModel->$key;
				}
				$model->id = $moderateModel->order_id;
			}
		}
		$times = array();
        if ($model->date > 0) {
            $times['date']['date'] = date("Y-m-d", $model->date);
            $times['date']['hours'] = date("H", $model->date);
            $times['date']['minutes'] = date("i", $model->date);
        }
        if ($model->date_finish > 0) {
            $times['date_finish']['date'] = date("Y-m-d", $model->date_finish);
            $times['date_finish']['hours'] = date("H", $model->date_finish);
            $times['date_finish']['minutes'] = date("i", $model->date_finish);
        }
		if ($model->max_exec_date > 0) {
            $times['max_exec_date']['date'] = date("Y-m-d", $model->max_exec_date);
            $times['max_exec_date']['hours'] = date("H", $model->max_exec_date);
            $times['max_exec_date']['minutes'] = date("i", $model->max_exec_date);
        }
        if ($model->manager_informed > 0) {
            $times['manager_informed']['date'] = date("Y-m-d", $model->manager_informed);
            $times['manager_informed']['hours'] = date("H", $model->manager_informed);
            $times['manager_informed']['minutes'] = date("i", $model->manager_informed);
        }
        if ($model->author_informed > 0) {
            $times['author_informed']['date'] = date("Y-m-d", $model->author_informed);
            $times['author_informed']['hours'] = date("H", $model->author_informed);
            $times['author_informed']['minutes'] = date("i", $model->author_informed);
        }

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			if(isset($_POST['Zakaz']))
			{
				$zakaz = $_POST['Zakaz'];

				$time['date'] = !empty($zakaz['date']['date']) ? strtotime($zakaz['date']['date'].' '.$zakaz['date']['hours'].':'.$zakaz['date']['minutes']) : 0;
				$time['date_finish'] = !empty($zakaz['date_finish']['date']) ? strtotime($zakaz['date_finish']['date'].' '.$zakaz['date_finish']['hours'].':'.$zakaz['date_finish']['minutes']) : 0;
				$time['max_exec_date'] = !empty($zakaz['max_exec_date']['date']) ? strtotime($zakaz['max_exec_date']['date'].' '.$zakaz['max_exec_date']['hours'].':'.$zakaz['max_exec_date']['minutes']) : 0;
				$time['manager_informed'] = !empty($zakaz['manager_informed']['date']) ? strtotime($zakaz['manager_informed']['date'].' '.$zakaz['manager_informed']['hours'].':'.$zakaz['manager_informed']['minutes']) : 0;
				$time['author_informed'] = !empty($zakaz['author_informed']['date']) ? strtotime($zakaz['author_informed']['date'].' '.$zakaz['author_informed']['hours'].':'.$zakaz['author_informed']['minutes']) : 0;


				if ($role != 'Manager' && $role != 'Admin') {
					ModerationHelper::saveToModerate($model, $zakaz, $time);
				} else {
					$model->attributes=$zakaz;
					$model->date = $time['date'];
					$model->date_finish = $time['date_finish'];
					$model->max_exec_date = $time['max_exec_date'];
					$model->manager_informed = $time['manager_informed'];
					$model->author_informed = $time['author_informed'];
                    
                    if ($model->manager_informed === 0) {
                        $model->status = 5;
                    }
				}

				if($model->save()) {
					if ($role != 'Manager' && $role != 'Admin') {
						EventHelper::editOrder($model->id);
                        $view = 'orderInModerate';
					} else {
						ModerationHelper::clear($model->id);
                        $this->redirect(array('update','id'=>$model->id));
					}
                    if ($role == 'Customer' ) {
                        //$view = 'orderInModerate';
                    }
					//$this->redirect(array('view','id'=>$model->id));
                }
			}
            
            if ($isModified) {
                $message = 'Заказ на модерации';
            } else {
                $message = $model->projectStatus->status;
            }
			$this->render($view, array(
				'model'=>$model,
				'times'=>$times,
				'message'=>$message,
			));
	}
    
    public function actionUploadPayment($id)
    {
        if(isset($_POST['UploadPaymentImage'])) {
            $upload = new UploadPaymentImage;
            $upload->orderId = $id;
            $upload->file = CUploadedFile::getInstance($upload, 'file');
            if ($upload->validate()) {
                $upload->save();
            }
        }
        $this->redirect(['chat/index', 'orderId'=>$id]);
    }

    /**
     * Превью заказа который должен быть отмодерирован
     * @param $id
     * @author Emericanec
     */
    public function actionPreview($id)
    {
            
        $event = Events::model()->findByPk($id);

        if (!$event) {
            throw new CHttpException(404, "Событие не найдено");
        }

        $moderation = Moderation::model()->findByPk($event->event_id);
        if ($moderation) {
            $this->render('preview', array(
                'model' => $moderation,
                'event' => $event
            ));
        } else {
            $event->delete();
            $this->redirect(['/project/zakaz/update', 'id' => $event->event_id]);
        }
            
        
    }

    /**
     * Одобрение или нет заказа
     * @param $answer
     * @author Emericanec
     */
    public function actionModerationAnswer($id, $event_id, $answer){
        $model = Moderation::model()->findByPk($id);
        $event = Events::model()->findByPk($event_id);
        if($model && $event) {
            // если одобрили то создаем заказ и удаляем модерер и событие
            if ($answer) {
                $zakaz = new Zakaz();
                $zakaz->attributes = $model->attributes;
                $userId = $model->user_id;
                if($zakaz->save()){
                    // изза beforeSave такой костыль
                    $zakaz->user_id = $userId;
                    if($zakaz->save()) {
                        $model->delete();
                        $event->delete();
                        $this->redirect(Yii::app()->createUrl('project/zakaz/update', array(
                            'id' => $zakaz->id
                        )));
                    }
                }
            } else {
                // если нет то просто удаляем
                $model->delete();
                $event->delete();
                $this->redirect(Yii::app()->createUrl('project/event'));
            }
        }else{
            $event->delete();
            throw new CHttpException("Заказ не найден или его уже отмодерировали");
        }
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
		$dataProvider=new CActiveDataProvider('Zakaz');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Zakaz('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Zakaz']))
			$model->attributes=$_GET['Zakaz'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionOwnList()
	{
		if (!User::model()->isAuthor()) {
			throw new CHttpException(403, 'Доступ запрещен');
		}

		$model=new Zakaz('search');
		$model->unsetAttributes();  // clear any default values
		$model->executor = Yii::app()->user->id;

		$this->render('list',array(
			'model'=>$model,
		));
	}

	public function actionList()
	{
		$model=new Zakaz('search');
		$model->unsetAttributes();
		$model->status = 3;

		$this->render('list',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Zakaz the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Zakaz::model()->findByPk($id);
		if($model===null){
            $model = Moderation::model()->findByPk($id);
            if($model === null){
                throw new CHttpException(404,'The requested page does not exist.');
            }
        }

		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Zakaz $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='zakaz-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDownload()
	{
	   EDownloadHelper::download($_GET['path']);
			$this->redirect(Yii::app()->request->urlReferrer);
	}

	public function actionCustomerOrderList()
	{
		if (!User::model()->isCustomer()) {
			throw new CHttpException(500);
		}

		$criteria = new CDbCriteria();
		$criteria->compare('user_id', Yii::app()->user->id);
		$dataProvider = new CActiveDataProvider('Zakaz', [
			'criteria' => $criteria
		]);

		$this->render('customerOrderList', [
			'dataProvider' => $dataProvider
		]);
	}
}
