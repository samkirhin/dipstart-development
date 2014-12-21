<?php

class PaymentController extends CController {
    
    public function actionView() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if (!$user->superuser) {
            $this->redirect('/');
        } else {
            $dataProvider = new CActiveDataProvider('Payment', array(
                'pagination' => array(
                    'pageSize' => '20',
                ),
            ));
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }
    }
    
}
