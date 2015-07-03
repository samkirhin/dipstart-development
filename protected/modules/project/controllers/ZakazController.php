<?php

class ZakazController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
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
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions'=>array('view','index','create','update', 'admin', 'preview', 'moderationAnswer', 'yiifilemanagerfilepicker','list', 'ownList','customerOrderList', 'uploadPayment'),
                    'users'=>array('@'),
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions'=>array('admin','delete', 'apiview','apifindauthor','spam','apiapprovefile'),
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

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST[$modelName]))
			{
				$model->attributes=$_POST[$modelName];

                if (!(User::model()->isManager() || User::model()->isAdmin())) {
                    $model->dbmanager_informed = date('d.m.Y H:i');
                    $model->dbdate = date('d.m.Y H:i');
                    $d1=date_create();
                    $d2=date_create($_POST['Moderation']['dbmax_exec_date']);
                    $d1->modify('+'.intval(date_diff($d1,$d2)->days/2).' days');
                    $model->dbauthor_informed = $d1->format('d.m.Y H:i');
                }
				if($model->save()){
					if (!(User::model()->isManager() || User::model()->isAdmin())) {
						EventHelper::createOrder($model->id);
					}
					$this->redirect(array('view','id'=>$model->id));
				}
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
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_order_list_update');
            Yii::app()->end();
        }
        $role = User::model()->getUserRole();
        $view = 'update';
        $isModified = false;
		Yii::app()->session['project_id'] = $id;
		$model=$this->loadModel($id);
        if (Yii::app()->request->getParam('close') == 'yes'){
            $model->status = 5;
            $model->save();
            $this->redirect(array('update','id'=>$model->id));
        }
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

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			if(isset($_POST['Zakaz']))
			{
				$zakaz = $_POST['Zakaz'];
				if ($role != 'Manager' && $role != 'Admin') {
					ModerationHelper::saveToModerate($model, $zakaz);
				} else {
					$model->attributes=$zakaz;
				}

				if($model->save()) {
					if ($role != 'Manager' && $role != 'Admin') {
						EventHelper::editOrder($model->id);
                        $view = 'orderInModerate';
					} else {
						ModerationHelper::clear($model->id);
                        $this->redirect(array('update','id'=>$model->id));
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
        
        if ($event->type == EventHelper::TYPE_MESSAGE) {
            $rid=$event->event_id;
            $event->delete();
            $this->redirect(['/project/zakaz/update', 'id' => $rid]);
        }

        $moderation = Moderation::model()->findByPk($event->event_id);
        if ($moderation) {
            $this->render('preview', array(
                'model' => $moderation,
                'event' => $event
            ));
        } else {
            $rid=$event->event_id;
            $event->delete();
            $this->redirect(['/project/zakaz/update', 'id' => $rid]);
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
                $userId = $model->user_id;
                foreach ($model->attributes as $k=>$v)
                    $zakaz->setAttribute($k,$v);
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
		if(Yii::app()->getRequest()->getParam('ajax',false))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model = new Zakaz('search');
        $model->unsetAttributes();
        if(Yii::app()->request->isAjaxRequest) {

            array_walk($_POST['Zakaz'],function(&$v,$k){
                if (substr($k,0,2))
                    if (strlen($v)>10) $v=substr($v,0,10);
            });
            $model->setAttributes(Yii::app()->request->getParam('Zakaz'));
            $this->renderPartial('index', array(
                'model' => $model,
            ), false, true);
        }
        else
            $this->render('index',array(
                'model'=>$model,
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
    public function actionCustomerOrderList()
    {
        if (!User::model()->isCustomer()) {
            throw new CHttpException(500);
        }

        $criteria = new CDbCriteria();
        $criteria->compare('user_id', Yii::app()->user->id);
        $model = new CActiveDataProvider('Zakaz', [
            'criteria' => $criteria
        ]);

        $this->render('customerOrderList', [
            'dataProvider' => $model
        ]);
    }

	public function actionList($status)
	{
		$model=new Zakaz('search');
		$model->unsetAttributes();
		if (User::model()->isAuthor()) {$model->executor = 0;$model->status=3;}

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

    public function actionSpam($order_id){
        $job = Zakaz::model()->findByPk($order_id)->job_id;
        $discipline = Zakaz::model()->findByPk($order_id)->category_id;
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('profile.discipline',$discipline);
        $criteria->addSearchCondition('profile.job_type',$job);
        $authors = User::model()->with('profile')->findAll($criteria);
        if(empty($authors)) echo json_encode(array('error'=>'Нет авторов'));
        $mail = new YiiMailer('contact', array('message' => 'Message to send', 'name' => 'John Doe', 'description' => 'Contact form'));
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = function($str, $level) {
            $GLOBALS['debug'] .= "$level: $str\n";
        };
        $mail->setFrom(Yii::app()->params['adminEmail'], 'John Doe');
        $mail->setSubject('Mail subject');
        foreach ($authors as $author) {
            $mail->setTo($author['email']);
            //$mail->send();
            print_r($author);
        }
        header('Content-type: application/json');

        Yii::app()->end();
    }
    public function actionApiApproveFile() {
        $this->_prepairJson();
        $data = $this->_request->getParam('data');
        $path=Yii::getPathOfAlias('webroot').'/uploads/'.$data['id'].'/';
        if (!file_exists($path)) mkdir($path);
        if (rename($path.$data['name'], $path.str_replace('#pre#', '', $data['name']))) {
            $this->_response->setData(true);
        } else $this->_response->setData(false);
        $this->_response->send();
    }
}
