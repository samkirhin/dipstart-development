<?php

class ModerateController extends Controller
{
    
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete + approve, ApiRenameFile', // we only allow deletion via POST request
        );
	}
		
	public function accessRules()
	{
			return array(
                array('allow', // 
                    'actions'=>array('view','index'),
                    'users'=>array('@'),
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions'=>array('approve', 'delete','index'),
                    'users'=>array('admin','manager'),
                ),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
	}
	

    public function actionIndex($id)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('event_id', $id);
        
        $dataProvider = new CActiveDataProvider('Moderate', [
            'criteria' => $criteria
        ]);
        
        $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
    
    public function actionApprove($id)
    {
        $model = $this->loadModel($id);
        $model->approve();
        $model = $this->loadModel($id);
    }
    
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $model->delete();
        $model = $this->loadModel($id);
    }
    
    public function loadModel($id)
	{
		$model=Moderate::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404);
		return $model;
	}
}