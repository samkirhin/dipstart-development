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
                    'actions'=>array('view','create', 'uploadPayment', 'list', 'update', 'status','customerOrderList','index','ownList','apiRemoveFile','Upload','ApiRenameFile', ),
                    'users'=>array('@'),
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions'=>array('preview', 'moderationAnswer','apiview','apifindauthor','spam','apiapprovefile','update','status','index','delete', 'deleteFile'),
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

        if (!isset($model->unixtime)) {
            $model->unixtime = time();
        } 
        
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
                $this->moveFiles($model->unixtime,$model->id);
                $this->redirect(array('view','id'=>$model->id));
            }
			
        }

        $this->render('create',array(
            'model'=>$model
        ));
	}
    
    protected function moveFiles($unixtime,$id) 
    {
        
        $c_id = Campaign::getId();
        $root = Yii::getPathOfAlias('webroot');
        if ($c_id) {
            $from = $root.'/uploads/c'.$c_id.'/temp/'.$unixtime.'/';
        } else {
            $from = $root.'/uploads/temp/'.$unixtime.'/';
        }
        if (file_exists($from)) {
            $dir_handle = opendir($from);
            if ($c_id) {
                $to = $root.'/uploads/c'.$c_id.'/'.$id.'/';
            } else {
                $to = $root.'/uploads/'.$id.'/';
            }
            if (!file_exists($to)) {
                mkdir($to, 0777);
            }                    
            while ($file = readdir($dir_handle)) {
               if ($file === '.' || $file === '..' || is_dir($file)) continue;
               rename($from.$file, $to.$file);   
            }
            rmdir($from);                    
            
        }
    }
    
    public function actionApiRenameFile() {
        $this->_prepairJson();
        $data = $this->_request->getParam('data');
        $path=Yii::getPathOfAlias('webroot').$data['dir'];
        if (!file_exists($path)) mkdir($path);
        if (rename($path.$data['name'], $path.'#trash#'.$data['name'])) {
            EventHelper::materialsDeleted($_GET['orderId']);
            $this->_response->setData(true);
        } else $this->_response->setData(false);
        $this->_response->send();
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
					$this->redirect(array("../project/chat?orderId=$id"));
				} else {
//					$this->redirect(array('project/chat','orderId'=>$model->id));
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
					
					// Заказчику проект принят					
					$type_id = Emails::TYPE_12;
					$email = new Emails;
						
					$order= Zakaz::model()->findByPk($id);
					$user = User::model()->findAll("`id`='$order->user_id'");
					$user = $user[0];

					$email->from_id = 1;
					$email->to_id   = $user->id;
						
					$rec   = Templates::model()->findAll("`type_id`='$type_id'");
					$campaign = Campaign::search_by_domain($_SERVER['SERVER_NAME']);
					$email->campaign = $campaign->name;
					$email->name = $profle->firstname;
					// временно так
					$email->name = $user->username;;
					$email->num_order = $id;
					
					$email->login= $user->username;
					$email->password= $soucePassword;
					$email->sendTo( $user->email, $rec[0]->title, $rec[0]->text, $type_id);
					
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
/*	
	Статусы проекта:
	1=Новый заказ,
	2=Ждем решен. клиента,
	3=Поиск Автора,
	4=Автор работает,
	5=Завершен,	
*/	
    public function getProviders($new=false)
    {
		if ($new) { $arr = array(3); $sarr= '3'; } else	{
					$arr = array(1,2,3,4); $sarr= '1,2,3,4';
		};
		$uid		= Yii::app()->user->id;

        $criteria = new CDbCriteria();
		$criteria->addInCondition('status',$arr);
		
        if ($new) {
			$criteria->compare('executor', 0);
		} else {	
			if (User::model()->isAuthor())	$criteria->compare('executor', $uid);
			if (User::model()->isCustomer())$criteria->compare('user_id',  $uid);
		};	
		$criteria->addInCondition('status',$arr);

        $dataProvider = new CActiveDataProvider(Zakaz::model()->resetScope(), [
            'criteria' => $criteria,
			'pagination' => false
        ]);
		$result = array('model'=>$dataProvider, 'model_done'=> null);
		$criteria->addInCondition('status',$arr);
        
		$criteria_done = new CDbCriteria();
		if (User::model()->isAuthor())	$criteria_done->compare('executor', $uid);
		if (User::model()->isCustomer())$criteria_done->compare('user_id',  $uid);
		$criteria_done->addInCondition('status',array(5));

        $dataProvider_done = new CActiveDataProvider(Zakaz::model()->resetScope(), [
            'criteria' => $criteria_done,
			'pagination' => false
        ]);
		$result['model_done'] = $dataProvider_done;
		return	$result;
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
		$models = $this->getProviders(0);
        $this->render('list', [
            'model' => $models['model'],
            'model_done' => $models['model_done'],
            'dataProvider' => $models['model'],
            'dataProvider_done' => $models['model_done'],
        ]);
	}
	
    public function actionCustomerOrderList()
    {
		$models = $this->getProviders();
		
        $this->render('customerOrderList', [
            'model' => $models['model'],
            'model_done' => $models['model_done'],
            'dataProvider' => $models['model'],
            'dataProvider_done' => $models['model_done'],
        ]);
    }

	public function actionList($status=0)
	{
		$new 	= User::model()->isAuthor();
		$models = $this->getProviders(true);
		$model	=  $models['model'];

		$this->render('list',array(
			'model'=>$models['model'],
            'model_done' => $models['model_done'],
            'dataProvider' => $models['model'],
            'dataProvider_done' => $models['model_done'],
			'only_new'		=> $new,
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
            throw new CHttpException(404,Yii::t('site','The requested page does not exist.'));
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

    public function actionSpam($orderId) {

		header('Content-type: application/json');
        
        $order = Zakaz::model()->findByPk($orderId);
        
        if (!$order) {
            throw new CHttpException(500);
        }
		
		$criteria = new CDbCriteria();
        if(Campaign::getId()) {
			$projectFields = $order->getFields();
			if ($projectFields) 
				foreach($projectFields as $field) {
					if ($field->required==ProjectField::REQUIRED_YES_REG_SPAM) {
						$varname = $field->varname;
						$value = $order->$varname;
						$criteria->addSearchCondition('profile.'.$varname,$value);
						//$criteria->addCondition('profile.'.$varname.' REGEXP \'(^|[[:punct:]])'.$value.'($|[[:punct:]])\'');
					}
				}
		}
		$authors = User::model()->with('profile')->findAll($criteria);

		if(!empty($authors)) {

            $link = $this->createAbsoluteUrl('/project/chat/', ['orderId' => $orderId]);
            $mail = new YiiMailer(/*'invite', ['link' => $link]*/);
			$mail->clearLayout();
            $mail->setFrom(Yii::app()->params['supportEmail'], Yii::app()->name);
            $mail->setSubject('Приглашение в проект');
			$link = 'http://'.$_SERVER['SERVER_NAME'].'/project/chat?orderId='.$orderId;
            $mail->setBody('<a href="'.$link.'">'.$link.'</a>');
            foreach ($authors as $author) {
//                $mail->setTo($author->email);
//                if($author->getUserRole($author->id)=='Author') $mail->send();
            }
            
            echo 'ok =)';

			
			// новая рассылка

			$typeId = Emails::TYPE_18;
			$rec   = Templates::model()->findAll("`type_id`='$typeId'");
            foreach ($authors as $user) {
				
				$specials = explode(',',$user->profile->specials);
				if (!in_array($order->specials, $specials)) continue;
				
				$email = new Emails;

				$email->to_id = $user->id;

				$email->name = $user->profile->full_name;
				if (strlen($email->name) < 2) $email->name = $user->username;
				$email->login= $user->username;
		
				$email->num_order = $orderId;
				$email->page_order = 'http://'.$_SERVER['SERVER_NAME'].'/project/chat?orderId='.$orderId;
//				$email->neworder = $order->title;
				$email->sendTo( $user->email, $rec[0]->title, $rec[0]->text, $typeId);
			}	
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
    		if ($row['status_id'] == 3) {
    
    			$email = new Emails;
    
    			$orderId = Yii::app()->request->getPost('id');
    			$typeId = Emails::TYPE_14;
    			$order	 = Zakaz::model()->findByPk($orderId);
    		
    			$user = User::model()->findByPk($order->user_id);
    			
    			$email->to_id = $user->id;
    
    			$profile = Profile::model()->findAll("`user_id`='$user->id'");
    			$rec   = Templates::model()->findAll("`type_id`='$typeId'");
    
    			$email->name = $profle->firstname;
    			if (strlen($email->name) < 2) $email->name = $user->username;
    			$email->login= $user->username;
    		
    			$email->num_order = $orderId;
    			$email->page_order = 'http://'.$_SERVER['SERVER_NAME'].'/project/chat?orderId='.$orderId;
    			$email->message = $rec[0]->text;
    			$email->sendTo( $user->email, $rec[0]->title, $rec[0]->text, $typeId);
    		};	
		
        Yii::app()->end();
    }
    
    
    public function actionUpload() {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
        // --- кампании
        $c_id = Campaign::getId();
        if ($c_id) {
            $folder='uploads/c'.$c_id.'/temp/';
        } else {
            $folder='uploads/temp/';
        }
        // ---
        if (!file_exists($folder)) {
            mkdir($folder, 0777);
        }
        $folder = $folder.$_GET['unixtime'].'/';
        if (!file_exists($folder)) {
            mkdir($folder, 0777);
        }
        $config['allowedExtensions'] = array('png', 'jpg', 'jpeg', 'gif', 'txt', 'doc', 'docx');
        $config['disAllowedExtensions'] = array("exe");
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($config, $sizeLimit);
        if(!(User::model()->isAdmin())) $_GET['qqfile']='#pre#'.$_GET['qqfile'];
        $result = $uploader->handleUpload($folder,true);
        $result['fileSize']=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $result['fileName']=$result['filename'];//GETTING FILE NAME
        chmod($folder.$result['fileName'],0666);
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }
    
    
    public function actionDeleteFile() {

        $file_name = trim(Yii::app()->request->getPost('file_name'));
        
        $id = (int)Yii::app()->request->getPost('id');
        
        $path=Yii::getPathOfAlias('webroot').$file_name;
  
        if (file_exists($path)) {
          
          $note = ZakazPartsFiles::model()->findByPk($id);
          
          if ($note->delete()) {
          
            if (unlink($path)) {

                echo 'true';
                
            } else echo 'false';

          } else echo 'false';

        } else echo 'false';


    }
    
}
