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
    protected $_request;
    protected $_response;
    protected function _prepairJson() {
        $this->_request = Yii::app()->jsonRequest;
        $this->_response = new JsonHttpResponse();
    }

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
                'actions' => array('index'),
                'expression' => array('ChatController', 'allowOnlyOwner'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('upload'),
                'users' => array('@'),
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'approve', 'remove', 'edit', 'setexecutor', 'delexecutor', 'readdress'),
				'users'=>array('admin', 'manager'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public static function allowOnlyOwner(){
        if(User::model()->isAdmin()){
            return true;
        }
        else{
            $zakaz = Zakaz::model()->findByPk($_GET["orderId"]);
            if(User::model()->isCustomer())
                return ($zakaz->user->id === Yii::app()->user->id);
            if(User::model()->isAuthor())
                return (($zakaz->executor == 0) || ($zakaz->executor === Yii::app()->user->id));
        }
    }

	/**
	 *  Вывод и добавление сообщений
	 */
    public function actionIndex($orderId)
    {

        Yii::app()->session['project_id'] = $orderId;

        if (Yii::app()->request->isAjaxRequest) {
            if (Yii::app()->request->getPost(ProjectMessages::model()->tableName())) {
                $model = new ProjectMessages;
                $model->sender = Yii::app()->user->id;
                $model->moderated = 0;
                $model->order = $orderId;
                $model->attributes = Yii::app()->request->getPost($model->tableName());
                $model->date = date('Y-m-d H:i:s');
                switch ($model->recipient) {
                    case 'manager':
                        $model->recipient = 1;
                        break;
                    case 'customer':
                        if (User::model()->isCustomer())
                            $model->recipient = 2;
                        if (User::model()->isAuthor())
                            $model->recipient = 3;
                        break;
                }
                $model->save();
                EventHelper::addMessage($orderId, $model->message);
            }
            $this->renderPartial('chat', array(
                'orderId' => $orderId,
            ));
            Yii::app()->end();
        }
        $this->render('index', array(
            'orderId' => $orderId,
            'executor' => Zakaz::getExecutor($orderId),
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
        $result['fileSize']=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $result['fileName']=$result['filename'];//GETTING FILE NAME
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }
}
