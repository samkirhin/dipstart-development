<?php

class ChatController extends Controller {

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
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
				'actions'=>array(),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','upload'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'yiifilemanagerfilepicker', 'approve', 'remove', 'edit', 'setexecutor', 'delexecutor', 'readdress'),
				'users'=>array('admin', 'manager'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 *  Вывод и добавление сообщений
	 */
	public function actionIndex($orderId) {

        Yii::app()->clientScript->registerScriptFile('/js/chat.js');
        Yii::app()->session['project_id'] = $orderId;

		$order = Zakaz::model()->findByPk($orderId);

        if (!$order) {
            throw new CHttpException(404, 'Не найден');
        }
        
		$model = new ProjectMessages;
		$model->sender = Yii::app()->user->id;
		$model->moderated = 0;
		$model->order = $orderId;
		if(Yii::app()->request->getPost($model->tableName())) {
			$model->attributes = Yii::app()->request->getPost($model->tableName());
			$model->date = date('Y-m-d H:i:s');
			switch (array_keys($_POST)[1]){
				case 'manager':
					$model->recipient = 1;
				break;
				case 'customer':
                    if(User::model()->isCustomer())
                        $model->recipient = 2;
					if(User::model()->isAuthor())
						$model->recipient = 3;
				break;
			}
			$model->save();
			EventHelper::addMessage($model->order);
			$model->message = '';
			$model->recipient = '';
		}
		if(User::model()->isAuthor()) {
			$criteria=new CDbCriteria;
			$criteria->addCondition('(moderated=1 OR sender IN (SELECT userid FROM AuthAssignment WHERE itemname IN ("Admin","Manager")) OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient=2 OR recipient=0)');
			$criteria->addCondition('`order` = :oid');
			$criteria->params[':oid'] = (int) $orderId;
			$messages = ProjectMessages::model()->findAll($criteria);
			$middle_button = 'Отправить заказчику';
		}
		else if(User::model()->isCustomer()) {
			$criteria=new CDbCriteria;
			$criteria->addCondition('(moderated=1 OR sender IN (SELECT userid FROM AuthAssignment WHERE itemname IN ("Admin","Manager")) OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient=3 OR recipient=0)');
			$criteria->addCondition('`order` = :oid');
			$criteria->params[':oid'] = (int) $orderId;
			$messages = ProjectMessages::model()->findAll($criteria);
			$middle_button = 'Отправить автору';
		}
		else {
			$criteria=new CDbCriteria;
			$criteria->addCondition('`order` = :oid');
			$criteria->params[':oid'] = (int) $orderId;
			$messages = ProjectMessages::model()->findAll($criteria);
		}

        
        $attributes = [
            'id',
            array(
               'name' => 'category_id',
               'type' => 'raw',
               'value' => Categories::model()->findByPk($order->category_id)->cat_name,
            ),
            array(
               'name' => 'job_id',
               'type' => 'raw',
               'value' => $order->job_id > 0 ? Jobs::model()->findByPk($order->job_id)->job_name : null,
            ),
            'title',
            'text',
            [
               'name' => 'author_informed',
               'value' => Yii::app()->dateFormatter->formatDateTime($order->author_informed),
            ],
            [
               'name' => 'date_finish',
               'value' => Yii::app()->dateFormatter->formatDateTime($order->date_finish),
            ],
            'pages',
            'add_demands',
            array(
               'name' => 'status',
               'type' => 'raw',
               'value' => $order->status > 0 ? ProjectStatus::model()->findByPk($order->status)->status : null,
            ),
        ];

        if (User::model()->isManager() || User::model()->isAdmin()) {
            $attributes = CMap::mergeArray($attributes, [
                'is_payed',
                'informed',
                'notes'
            ]);
        }
        $parts = array();
        if (User::model()->isAdmin() || User::model()->isManager()) {
            $parts = new CActiveDataProvider('ZakazParts',array('criteria'=>array('proj_id'=>$orderId)));
        } elseif (User::model()->isCustomer() || User::model()->isAuthor()) {
            $parts = new CActiveDataProvider('ZakazParts',array(
                'criteria'=>array(
                    //'select'=>'orig_name',
                    'condition'=>'proj_id='.$orderId.' AND `show` IN (1'.(User::model()->isAuthor()?',0)':')'),
                    'select'=>array('id','title','file','date','comment','author_id','proj_id'),
                ),
            ));
        }

		$this->render('index', array(
			'model' => $model,
            'order' => $order,
            'parts' => $parts,
			'messages' => $messages,
			'executor' => Zakaz::getExecutor($orderId),
            'attributes' => $attributes,
            'middle_button' => $middle_button
		));
	}

	/**
	 * Одобрить сообщение
	 */
	public function actionApprove($messageId) {
		$model = ProjectMessages::model()->findByPk($messageId);
		$model->moderated = 1;
		$model->save();
	}

	/**
	 *  Удалить сообщение
	 */
	public function actionRemove($messageId) {
		$model = ProjectMessages::model()->findByPk($messageId);
		$model->delete();
	}

	/**
	 * Редактировать сообщение
	 */
	public function actionEdit($messageId) {
		$model = ProjectMessages::model()->findByPk($messageId);
		if(Yii::app()->request->getPost($model->tableName())) {
			$model->attributes = Yii::app()->request->getPost($model->tableName());
			$model->save();
			$this->redirect(Yii::app()->createUrl('project/chat', array('orderId' => $model->order)));
		}
		$this->render('edit', array(
			'model' => $model
		));
	}

	/**
	 * Назначить исполнителя
	 */
	public function actionSetExecutor($orderId, $executorId) {
		$model = Zakaz::model()->findByPk($orderId);
		$model->executor = $executorId;
		$model->save();
	}

	/**
	 * Снять исполнителя с заказа
	 */
	public function actionDelExecutor($orderId) {
		$model = Zakaz::model()->findByPk($orderId);
		$model->executor = 0;
		$model->save();
	}

	/**
	 * Переназначить сообщение автору заказа
	 */
    public function actionReaddress($messageId, $ordererId) {
        $model = ProjectMessages::model()->findByPk($messageId);
        $model->recipient = $ordererId;
        $model->save();
    }
	public function actionUpload() {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
        $folder='uploads/'.$_GET['id'].'/';// folder for uploaded files
        $config['allowedExtensions'] = array('jpg', 'gif', 'txt', 'doc', 'docx');
        $config['disAllowedExtensions'] = array("exe");
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($config, $sizeLimit);
        $_GET['qqfile']='#pre#'.$_GET['qqfile'];
        $result = $uploader->handleUpload($folder,true);
        if ($result['success']) {
            EventHelper::addChanges($_GET['proj_id']);
        }
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $fileName=$result['filename'];//GETTING FILE NAME
        echo $return;// it's array
    }
}
