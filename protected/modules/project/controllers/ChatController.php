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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),*/
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
        
        $times = array();
		$times['date']['date'] = date("Y-m-d", $order->date);
		$times['date']['hours'] = date("H", $order->date);
		$times['date']['minutes'] = date("i", $order->date);
		$times['date_finish']['date'] = date("Y-m-d", $order->date_finish);
		$times['date_finish']['hours'] = date("H", $order->date_finish);
		$times['date_finish']['minutes'] = date("i", $order->date_finish);
		
		$times['max_exec_date']['date'] = date("Y-m-d", $order->max_exec_date);
		$times['max_exec_date']['hours'] = date("H", $order->max_exec_date);
		$times['max_exec_date']['minutes'] = date("i", $order->max_exec_date);
		$times['manager_informed']['date'] = date("Y-m-d", $order->manager_informed);
		$times['manager_informed']['hours'] = date("H", $order->manager_informed);
		$times['manager_informed']['minutes'] = date("i", $order->manager_informed);
		$times['author_informed']['date'] = date("Y-m-d", $order->author_informed);
		$times['author_informed']['hours'] = date("H", $order->author_informed);
		$times['author_informed']['minutes'] = date("i", $order->author_informed);

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
					if(User::model()->isAuthor())
						$model->recipient = Zakaz::model()->findByPk($model->order)->user_id;
					if(User::model()->isCustomer())
						$model->recipient = print_r(Zakaz::model()->findByPk($model->order)->executor);
					if ($model->recipient==0) throw new CHttpException(404, 'Автор не назначен');
				break;
			}
			$model->save();
			EventHelper::addMessage($model->order);
			$model->message = '';
			$model->recipient = '';
		}
		if(User::model()->isAuthor()) {
			$criteria=new CDbCriteria;
			$criteria->addCondition('(moderated=1 OR sender IN (SELECT userid FROM AuthAssignment WHERE itemname IN ("Admin","Manager")) OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient='.Yii::app()->user->id.' OR recipient=0)');
			$criteria->addCondition('`order` = :oid');
			$criteria->params[':oid'] = (int) $orderId;
			$messages = ProjectMessages::model()->findAll($criteria);
			$middle_button = 'Отправить заказчику';
		}
		else if(User::model()->isCustomer()) {
			$criteria=new CDbCriteria;
			$criteria->addCondition('(moderated=1 OR sender IN (SELECT userid FROM AuthAssignment WHERE itemname IN ("Admin","Manager")) OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient='.Yii::app()->user->id.' OR recipient=0)');
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
        $parts = array();
        if (User::model()->isAdmin() || User::model()->isManager()) {
            $models = new CActiveDataProvider('ZakazParts',array('criteria'=>array('proj_id'=>$orderId)));
        } elseif (User::model()->isCustomer() || User::model()->isAuthor()) {
            $models = new CActiveDataProvider('ZakazParts',array(
                'criteria'=>array(
                    'condition'=>'proj_id='.$orderId.' AND `show` IN (1'.(User::model()->isAuthor()?',0)':')'),
                ),
            ));
        }

		$this->render('index', array(
			'model' => $model,
            'order' => $order,
            'parts' => $models,
			'messages' => $messages,
			'orderId' => $orderId,
			'executor' => Zakaz::getExecutor($orderId),
			'ordererId' =>$order->user_id,
            'attributes' => $attributes,
            'times' => $times,
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
}
