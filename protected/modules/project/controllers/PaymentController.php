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
            $this->render('admin');
        }
    }
    
    public function actionApiView() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if (!$user->superuser) {
            $this->redirect('/');
        } else {
            $this->_prepairJson();
            $sort = $this->_request->getParam('sort');
            $type = $this->_request->getParam('type');
            $searchField = $this->_request->getParam('search_field');
            $searchType = $this->_request->getParam('search_type');
            $searchString = $this->_request->getParam('search_string');
            if (!$sort) {
                $sort = 'receive_date';
            }
            if (!$type) {
                $type = 'DESC';
            }
            if ($searchField == '' || $searchString == '' || $searchType == '') {
                $sql = 'SELECT * FROM `Payment` ORDER BY `'.$sort.'` '.$type.' ; ';
            } else {
                switch ($searchType) {
                    case 'bigger':
                        $searchType = '<';
                        break;
                    case 'smaller':
                        $searchType = '>';
                        break;
                    case 'equal':
                        $searchType = '=';
                        break;
                }
                $sql = 'SELECT * FROM `Payment` WHERE `'.$searchField.'` '.$searchType.' '.$searchString.' ORDER BY `'.$sort.'` '.$type.' ; ';
            }
            $data = Payment::model()->findAllBySql($sql);
            $report = array();
            $report['summary'] = 0;
            $report['ids_count'] = 0;
            foreach ($data as $row) {
                $report['ids_count']++;
                if ($row->payment_type == 0) {
                    $report['summary'] = $report['summary'] + $row->summ;
                } else {
                    $report['summary'] = $report['summary'] - $row->summ;
                }
                
            }
            $this->_response->setData( array(
                'data' => $data,
                'report' => $report
            ));
            $this->_response->send();
        }
    }
    
    public function actionAdmin() {
        $this->render('admin');
    }
    
    public function actionApproveFromBookkeeper() {
        $this->_prepairJson();
        $id = $this->_request->getParam('id');
        $method = $this->_request->getParam('method');
        if (!$method) {
            $method = 'Cash';
        }
        $payment = new Payment();
        $result = $payment->approveFromBookkeeper($id, $method);
        $this->_response->setData(array(
            'result' => $result
        ));
        $this->_response->send();
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
        $paying = $this->_request->getParam('to_pay');
        $payment->to_pay            = $payment->to_pay + $paying;
        if ($payment->save()) {
            $order = Zakaz::model()->findByPk($orderId);
            $buh = new Payment;
            $buh->approve = 0;
            $buh->order_id = $orderId;
            $buh->receive_date = date("Y-m-d");
            $buh->theme = $order->title;
            $user = User::model()->findByPk($order->executor);
            $buh->user = $user->email;
            $buh->summ = $paying;
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
        if ($payment->save() && $to_res != 0) {
            $order = Zakaz::model()->findByPk($orderId);
            $buh = new Payment;
            $buh->approve = 0;
            $buh->order_id = $orderId;
            $buh->receive_date = date('Y-m-d');
            $buh->theme = $order->title;
            $user = User::model()->findByPk($order->user_id);
            $buh->user = $user->email;
            $buh->summ = $to_res;
            $buh->payment_type = 0;
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
    
    public function actionManagersCancel() {
        
        $this->_prepairJson();
        $orderId = $this->_request->getParam('order_id');
        $payment = ProjectPayments::model()->find('order_id = :ORDER_ID', array(
            'ORDER_ID'=>$orderId
        ));
        $payment->to_receive = 0;
        if ($payment->save()) {
            $this->_response->setData(
                array (
                    'to_receive' => $payment->to_receive
                )
            );
        } else {
            $this->_response->setData(
                array (
                    'to_receive' => $payment->to_receive
                )
            );
        }
        $this->_response->send();
    }
}
