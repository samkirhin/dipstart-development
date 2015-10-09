<?php

class ZakazController extends Controller
{
	public function filters()
    {
        return array(
            'accessControl',
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
                    'actions'=>array('view','create', 'uploadPayment','list','update','status','customerOrderList','index','ownlist','ownList','OwnList'),
                    'users'=>array('@'),
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions'=>array('preview', 'moderationAnswer','apiview','apifindauthor','spam','apiapprovefile','update','status','index','ownlist','ownList','OwnList'),
                    'users'=>array('admin','manager'),
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
        $model = new Zakaz();
        
        if(User::model()->isManager() || User::model()->isAdmin()) {
            $model->is_active = 1;
        } else {
            $model->status = 1;
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Zakaz']))
        {
            $model->attributes=$_POST['Zakaz'];

            if (!(User::model()->isManager() || User::model()->isAdmin())) {
                $model->user_id = Yii::app()->user->id;
                
                $model->dbmanager_informed = date('d.m.Y H:i');
                $model->dbdate = date('d.m.Y H:i');
                $d1=date_create();
                $d2=date_create($model->dbmax_exec_date);
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
            'model'=>$model
        ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
    {

        if (Yii::app()->request->isAjaxRequest) {
            
            $data = Yii::app()->request->getRestParams();
			$field = str_replace('Zakaz_','',$data['elid']);
            if (is_array($data)) {
                $model=$this->loadModel($data['id']);
                echo json_encode($model->$field=$data['data']);
                echo json_encode($model->save());
                Yii::app()->end();
            }
            $this->renderPartial('_order_list_update');
            Yii::app()->end();
            
        }
        
        $role = User::model()->getUserRole();
        $view = 'update';
        $isModified = false;
		Yii::app()->session['project_id'] = $id;
		$model=$this->loadModel($id);
		
        if (Yii::app()->request->getParam('close') == 'yes'){
            $model->old_status = $model->status;
			$model->status = 5;
			$model->save(false);
			$this->redirect(array('update','id'=>$model->id));
		} elseif (Yii::app()->request->getParam('open') == 'yes'){
			$model->status = $model->old_status;
			$model->save(false);
			$this->redirect(array('update','id'=>$model->id));
		}
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Zakaz'])) {
			$model->attributes = $_POST['Zakaz'];

			if(isset($_POST['Zakaz']['dbdate']))
				$model->dbdate = $_POST['Zakaz']['dbdate'];


			if(Campaign::getId()){
				$projectFields = $model->getFields();
				if ($projectFields) foreach($projectFields as $field) {
					if ($field->field_type=="TIMESTAMP") {
						// ----------------------------------------------------
						$tmp = $field->varname;
						if (isset($_POST['Zakaz'][$tmp])) {
							$model->$tmp = $_POST['Zakaz'][$tmp];
							$model->timestampInput($field);
						}
					}
				}
			}
			
			if($model->save()) {
				if ($role != 'Manager' && $role != 'Admin') {
// где-то есть дублрующий вызов записи события, поэтому этот комментируем
// oldbadger 09.10.2015					
//					EventHelper::editOrder($model->id);
					$view = 'orderInModerate';
				} else {
					$this->redirect(array('update','id'=>$model->id));
				}
			}
			
		}

		$this->render($view, array(
			'model'=>$model,
			'message'=>$model->projectStatus->status,
			'isModified'=>$isModified,
		));
	}
    
    public function actionUploadPayment($id)
    {
        if(isset($_POST['UploadPaymentImage'])) {
            $upload = new UploadPaymentImage;
            $upload->orderId = $id;
            $upload->file = CUploadedFile::getInstance($upload, 'file');
            if ($upload->file && $upload->validate()) {
                $upload->save();
				EventHelper::chekUploaded($id);
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

        $model = Zakaz::model()->resetScope()->findByPk($event->event_id);
        if (!$model->is_active) {
			$profile = Profile::model()->findByPk($model->user_id);
            $this->render('preview', array(
                'model' => $model,
				'profile' => $profile,
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
        $model = Zakaz::model()->resetScope()->findByPk($id);
        $event = Events::model()->findByPk($event_id);
        if(!$model->is_active && $event) {
            
            if ($answer == 1) {
                $model->is_active = 1;
                
                if($model->save()) {
                    $event->delete();
                    $this->redirect(Yii::app()->createUrl('project/zakaz/update', array(
                        'id' => $model->id
                    )));
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
		if(!Yii::app()->getRequest()->getParam('ajax',false))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($all=0) {
        $model = new Zakaz('search');
        $model->unsetAttributes();
		if($all == 1) $model->setAttribute('status', -1);
        if(Yii::app()->request->isAjaxRequest) {

            array_walk($_POST['Zakaz'],function(&$v,$k){
                if (substr($k,0,2))
                    if (strlen($v)>10) $v=substr($v,0,10);
            });
			$params = Yii::app()->request->getParam('Zakaz');
            $model->setAttributes($params);
			Yii::app()->user->setState('ZakazFilterState', $params);
            $this->renderPartial('index', array(
                'model' => $model,
            ), false, true);
        }
        else {
			$params = Yii::app()->user->getState('ZakazFilterState');
			if ( isset($params) ) {
				$model->setAttributes($params);
			}
            $this->render('index',array(
                'model'=>$model,
            ));
		}
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
		$model=new Zakaz('search');
		$model->unsetAttributes();  // clear any default values
        $model->executor = Yii::app()->user->id;

		$this->render('list',array(
			'model'=>$model,
		));
	}
    public function actionCustomerOrderList()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', Yii::app()->user->id);
		$criteria->addInCondition('status',array(1,2,3,4,6));
        $model = new CActiveDataProvider(Zakaz::model()->resetScope(), [
            'criteria' => $criteria,
			'pagination' => false
        ]);

        $criteria_done = new CDbCriteria();
        $criteria_done->compare('user_id', Yii::app()->user->id);
		$criteria_done->addInCondition('status',array(5));
        $model_done = new CActiveDataProvider(Zakaz::model()->resetScope(), [
            'criteria' => $criteria_done,
			'pagination' => false
        ]);
		
        $this->render('customerOrderList', [
            'dataProvider' => $model,
            'dataProvider_done' => $model_done
        ]);
    }

	public function actionList($status=0)
	{
		$model=new Zakaz('search');
		$model->unsetAttributes();
		
		if (User::model()->isAuthor()) {
			$model->executor = 0;
			$model->status=3;
			$user = User::model()->findByPk(Yii::app()->user->id);
			$fields=$model->getFields();
			foreach ($fields as $field) {
				if ($field->field_type == 'LIST') {
					$tmp = $field->varname;
					$model->$tmp = $user->profile->$tmp;
				}
			}
		}

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
		$model = Zakaz::model()->resetScope()->findByPk($id);
		if($model===null){
            throw new CHttpException(404,'The requested page does not exist.');
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

    public function actionSpam($order_id) {
        
        header('Content-type: application/json');
        
        $zakaz = Zakaz::model()->findByPk($order_id);
        
        if (!$zakaz) {
            throw new CHttpException(500);
        }
		
		$criteria = new CDbCriteria();
        if(Campaign::getId()) {
			$projectFields = $zakaz->getFields();
			if ($projectFields) foreach($projectFields as $field) {
				if ($field->required==ProjectField::REQUIRED_YES_REG_SPAM) {
					$varname = $field->varname;
					$value = $zakaz->$varname;
					$criteria->addSearchCondition('profile.'.$varname,$value);
					//$criteria->addCondition('profile.'.$varname.' REGEXP \'(^|[[:punct:]])'.$value.'($|[[:punct:]])\'');
				}
			}
			//echo json_encode(array('error'=>$tmp));
			//Yii::app()->end();
		} else {
			$job = $zakaz->job_id;
			$discipline = $zakaz->category_id;
			
			$criteria->addSearchCondition('profile.discipline',$discipline);
			$criteria->addSearchCondition('profile.job_type',$job, true, 'OR');
        }
		$authors = User::model()->with('profile')->findAll($criteria);
		
		if(!empty($authors)) {

            $link = $this->createAbsoluteUrl('/project/chat/', ['orderId' => $order_id]);
            $mail = new YiiMailer('invite', ['link' => $link]);
            $mail->setFrom(Yii::app()->params['supportEmail'], Yii::app()->name);
            $mail->setSubject('Приглашение в проект');
            
            foreach ($authors as $author) {
                $mail->setTo($author->email);
                if($author->getUserRole($author->id)=='Author') $mail->send();
            }
            
            echo 'ok =)';
            
        } else {
             echo json_encode(array('error'=>'Нет авторов'));
        }
        
        Yii::app()->end();
    }
    public function actionApiApproveFile() {
        $this->_prepairJson();
        $data = $this->_request->getParam('data');
		// --- campaign
		if(isset(Zakaz::$files_folder)){
			$path=Yii::getPathOfAlias('webroot').Zakaz::$files_folder.$data['id'].'/';
		} else {
			$path=Yii::getPathOfAlias('webroot').'/uploads/'.$data['id'].'/';
		}
		// ---
        //$path=Yii::getPathOfAlias('webroot').'/uploads/'.$data['id'].'/';
        if (!file_exists($path)) mkdir($path);
        if (rename($path.$data['name'], $path.str_replace('#pre#', '', $data['name']))) {
            $this->_response->setData(true);
        } else $this->_response->setData(false);
        $this->_response->send();
    }
    
    /*
     * Remove attachment file
     */
    public function actionApiRemoveFile() {
        $this->_prepairJson();
        $data = $this->_request->getParam('data');
		if(isset(Zakaz::$files_folder)){
			$path=Yii::getPathOfAlias('webroot').Zakaz::$files_folder.$data['id'].'/';
		} else {
			$path=Yii::getPathOfAlias('webroot').'/uploads/'.$data['id'].'/';
		}
        if (!file_exists($path)) mkdir($path);
        if (unlink($path.$data['name'])) {
            $this->_response->setData(true);
        } else $this->_response->setData(false);
        $this->_response->send();
    }

    public function actionStatus() {
		$row	= array(
			'status_id' => Yii::app()->request->getPost('status_id'),
		);
		$id		= Yii::app()->request->getPost('id');
		$condition 	= array();
		$params		= array();
		ZakazParts::model()->updateByPk( $id, $row, $condition, $params);
        Yii::app()->end();
    }
}
