<?php

class ModerateController extends Controller
{
    
    public function filters()
    {
        return CMap::mergeArray(
            parent::filters(), 
            [
                'postOnly + approve'
            ]);
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
    }
    
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $model->delete();
    }
    
    public function loadModel($id)
	{
		$model=Moderate::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404);
		return $model;
	}
}