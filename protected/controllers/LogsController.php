<?php
class LogsController extends Controller {
	public $defaultAction = 'logs';
	
	public function actionLogs() {
		$model = new ManagerLog('search');
		$model->unsetAttributes();
		if(Yii::app()->request->isAjaxRequest) {
			$params = Yii::app()->request->getParam('ManagerLog');
			$model->setAttributes($params);
			Yii::app()->user->setState('ManagerLogFilterState', $params);
		}
		$this->render('list',array(
			'model'=>$model,
		));
	}
}