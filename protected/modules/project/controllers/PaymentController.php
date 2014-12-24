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
                    'pageSize' => '100',
                ),
            ));
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }
    }
    
    public function actionAdmin()
    {
        $model=new Payment('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Payment']))
                $model->attributes=$_GET['Payment'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }
    
    public function actionSavePaymentsToUser() {
        $this->_prepairJson();
        $orderId = $this->_request->getParam('order_id');
        $payment = ProjectPayments::model()->find('order_id = :ORDER_ID', array(
            'ORDER_ID'=>$orderId
        ));
        if (!$payment) {
            $payment = new ProjectPayments;
            $payment->order_id = $order_id;
            $payment->received = 0;
            $payment->to_receive = 0;
            $payment->to_pay = 0;
        }
        
        $payment->project_price    = $this->_request->getParam('project_price');
        $payment->to_receive       = $payment->to_receive + $this->_request->getParam('to_receive');
        if ($payment->save()) {
            $this->_response->setData(
                array (
                    'project_price' => $payment->project_price,
                    'to_receive'    => $payment->to_receive
                )
            );
        } else {
            $this->_response->setData(
                array (
                    'result' => 'false'
                )
            );
        }
        $this->_response->send();
    }
    
    public function actionSavePaymentsToAuthor() {
        $this->_prepairJson();
        $orderId = $this->_request->getParam('order_id');
        $payment = ProjectPayments::model()->find('order_id = :ORDER_ID', array(
            'ORDER_ID'=>$orderId
        ));
        if (!$payment) {
            $payment = new ProjectPayments;
        }
        
        
        $payment->work_price        = $this->_request->getParam('work_price');
        $payment->to_pay            = $payment->to_pay + $this->_request->getParam('to_pay');
        if ($payment->save()) {
            $order = Zakaz::model()->findByPk($orderId);
            $buh = new Payment;
            $buh->approve = 0;
            $buh->order_id = $orderId;
            $buh->receive_date = date("Y-m-d");
            $buh->theme = $order->title;
            $user = User::model()->findByPk($order->executor);
            $buh->user = $user->email;
            $buh->summ = $payment->to_pay;
            $buh->payment_type = 1;
            $manag = User::model()->findByPk(Yii::app()->user->id);
            $buh->manager = $manag->email;
            $buh->save();
            $this->_response->setData(
                array (
                    'work_price'    => $payment->work_price,
                    'to_pay'        => $payment->to_pay
                )
            );
        } else {
            $this->_response->setData(
                array (
                    'result' => 'false'
                )
            );
        }
        $this->_response->send();
        
    }
    
    public function actionManagersApprove() {
        $this->_prepairJson();
        $orderId = $this->_request->getParam('order_id');
        $payment = ProjectPayments::model()->find('order_id = :ORDER_ID', array(
            'ORDER_ID'=>$orderId
        ));
        $payment->received = $payment->received + $payment->to_receive;
        $to_res = $payment->to_receive;
        $payment->to_receive = 0;
        if ($payment->save() && $to_res!=0) {
            $order = Zakaz::model()->findByPk($orderId);
            $buh = new Payment;
            $buh->approve = 0;
            $buh->order_id = $orderId;
            $buh->receive_date = date('Y-m-d');
            $buh->theme = $order->title;
            $user = User::model()->findByPk($order->user_id);
            $buh->user = $user->email;
            $buh->summ = $to_res;
            $buh->payment_type = 1;
            $manag = User::model()->findByPk(Yii::app()->user->id);
            $buh->manager = $manag->email;
            $buh->save();
            $this->_response->setData(
                array (
                    'received' => $payment->received
                )
            );
        } else {
            $this->_response->setData(
                array (
                    'received' => $payment->received
                )
            );
        }
        $this->_response->send();
        
    }
    
}
