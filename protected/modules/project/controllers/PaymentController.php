<?php

class PaymentController extends CController {
    
    public function actionView() {
        if (User::model()->getUserRole()!='Admin') {
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
