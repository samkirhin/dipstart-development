<?php

class PaymentController extends CController {
    
    protected $_request;
    protected $_response;
    
    protected function _prepairJson() {
        $this->_request = Yii::app()->jsonRequest;
        $this->_response = new JsonHttpResponse();
    }
    
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
    
    public function actionSaveToPayments() {
        
    }
    
    
    
}
