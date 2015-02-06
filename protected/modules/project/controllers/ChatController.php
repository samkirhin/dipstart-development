<?php

class ChatController extends Controller {

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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
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
			$model->save();
			EventHelper::addMessage($model->order);
                        $model->message = '';
			$model->recipient = '';
		}
		if(User::model()->isAuthor()) {
			$criteria=new CDbCriteria;
			$criteria->addCondition('moderated=1 OR sender='.Yii::app()->user->id);
			$criteria->addCondition('`order` = :oid');
			$criteria->params[':oid'] = (int) $orderId;
			$messages = ProjectMessages::model()->findAll($criteria);
		}
		else if(User::model()->isCustomer()) {
			$criteria=new CDbCriteria;
			$criteria->addCondition('moderated=1');
			$criteria->addCondition('`order` = :oid');
			$criteria->params[':oid'] = (int) $orderId;
			$messages = ProjectMessages::model()->findAll($criteria);
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
               'name' => 'user_id',
               'type' => 'raw',
               'value' => User::model()->findByPk($order->user_id)->username,
            ),
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
               'name' => 'date',
               'value' => Yii::app()->dateFormatter->formatDateTime($order->date),
            ],
            [
               'name' => 'max_exec_date',
               'value' => Yii::app()->dateFormatter->formatDateTime($order->max_exec_date),
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
		
		$this->render('index', array(
			'model' => $model,
            'order' => $order,
			'messages' => $messages,
			'orderId' => $orderId,
			'executor' => Zakaz::getExecutor($orderId),
			'ordererId' =>$order->user_id,
            'attributes' => $attributes
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
}