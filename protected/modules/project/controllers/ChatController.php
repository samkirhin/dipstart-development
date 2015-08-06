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
            if (Yii::app()->request->getPost('ProjectMessages')) {
                $model = new ProjectMessages;
                $model->sender = Yii::app()->user->id;
                $model->moderated = 0;
                $model->order = $orderId;
                $model->attributes = Yii::app()->request->getPost('ProjectMessages');
                $model->date = date('Y-m-d H:i:s');
                switch ($model->recipient) {
                    case 'manager':
                        $model->recipient = 1;
                        break;
                    case 'customer':
                        if (User::model()->isCustomer())
                            $model->recipient = Zakaz::model()->findByPk($orderId)->attributes['executor'];
                        if (User::model()->isAuthor())
                            $model->recipient = Zakaz::model()->findByPk($orderId)->attributes['user_id'];
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
        $model=Zakaz::model()->findByPk($orderId);
        if(isset($_POST['Zakaz']))
        {
            $zakaz = $_POST['Zakaz'];
            ModerationHelper::saveToModerate($model, $zakaz);

            if($model->save()) {
                EventHelper::editOrder($model->id);
            }
        }
		//echo '=)';
        $this->render('index', array(
            'orderId' => $orderId,
            'executor' => Zakaz::getExecutor($orderId),
			'chek_image' => Zakaz::getPaymentImage($orderId),
        ));
    }
	public function actionUpload() {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
		// --- кампании
		$campaign = Campaign::search_by_domain($_SERVER['SERVER_NAME']);
		if (isset($this->campaign_id)) {
			$folder='uploads/c'.$this->campaign_id.'/'.$_GET['id'].'/';
		} else {
			$folder='uploads/'.$_GET['id'].'/';
		}
		// ---
		if (!file_exists($folder)) {
			mkdir($folder, 0777);
		}
        $config['allowedExtensions'] = array('png', 'jpg', 'jpeg', 'gif', 'txt', 'doc', 'docx');
        $config['disAllowedExtensions'] = array("exe");
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($config, $sizeLimit);
        if(!(User::model()->isAdmin())) $_GET['qqfile']='#pre#'.$_GET['qqfile'];
        $result = $uploader->handleUpload($folder,true);
        if ($result['success'] && User::model()->isCustomer()) {
            EventHelper::materialsAdded($_GET['id']);
        }
        $result['fileSize']=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $result['fileName']=$result['filename'];//GETTING FILE NAME
		chmod($folder.$result['fileName'],0666);
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }
}
