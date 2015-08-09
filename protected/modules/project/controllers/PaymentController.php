<?php

class PaymentController extends Controller {

    protected $_request;
    protected $_response;

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','apiview','approvefrombookkeeper','managersapprove','managerscancel','savepayments','savepaymentstoauthor','savepaymentstouser','view'),
                'users'=>array('admin','manager'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
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
		$c_id = Campaign::getId();
		$table_prefix = '';
		if ($c_id) {
			$table_prefix = $c_id.'_';
		}
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
                $sql = 'SELECT * FROM `'.$table_prefix.'Payment` ORDER BY `'.$sort.'` '.$type.' ; ';
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
                $sql = 'SELECT * FROM `'.$table_prefix.'Payment` WHERE `'.$searchField.'` '.$searchType.' '.$searchString.' ORDER BY `'.$sort.'` '.$type.' ; ';
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

        $payment = Payment::model()->findByPk($id);
        if (!$payment) {
            $this->_response->setData(array(
                'result'  => false,
                'message' => 'Not found'
            ));
            Yii::app()->end();
        }

        $this->_response->setData(array(
            'result' => $payment->approveFromBookkeeper($method)
        ));
        $this->_response->send();

    }

    public function actionSavePayments() {
        $this->_prepairJson();
        $orderId = $this->_request->getParam('order_id');
        $payment = ProjectPayments::model()->find('order_id = :ORDER_ID', array(
            ':ORDER_ID'=>$orderId
        ));
        if (!$payment) {
            $payment = new ProjectPayments;
            $payment->order_id = $orderId;
            $payment->received = 0;
            $payment->to_receive = 0;
            $payment->to_pay = 0;
        }
        
        $to_receive = $this->_request->getParam('to_receive', 0);
        
        $payment->project_price = $this->_request->getParam('project_price');
        $payment->to_receive   += (int) $this->_request->getParam('to_receive');
        $payment->work_price = $this->_request->getParam('work_price');
        $paying              = (int) $this->_request->getParam('to_pay');
        
        if ( ($paying > 0) && ($to_receive == 0) && ($payment->work_price > 0) && ($paying + $payment->to_pay > $payment->work_price + $payment->payed) && ((int) $payment->to_pay > 0) ) {
            echo CJson::encode(['Оплата превышает лимит']);
            Yii::app()->end();
        }
        
        $payment->to_pay    += $paying;
        if ($payment->save()) {
			//(To User)
            $zakaz = Zakaz::model()->findByPk($orderId);
            if ($payment->project_price > 0 && $zakaz && $zakaz->status == 1) {
                $zakaz->status = 2;
                $zakaz->save(false);
            }
			//(To Author)
            $order = Zakaz::model()->findByPk($orderId);
            
            if ($paying>0) {
                
                $user = User::model()->findByPk($order->executor);
                $manag = User::model()->findByPk(Yii::app()->user->id);
                
                $buh = new Payment;
                $buh->approve = 0;
                $buh->order_id = $orderId;
                $buh->receive_date = date("Y-m-d");
                $buh->theme = $order->title;
                $buh->user = $user->email;
                $buh->summ = $paying;
                $buh->payment_type = 1;
                $buh->manager = $manag->email;
                $buh->details_ya = $user->profile->yandex;
                $buh->details_wm = $user->profile->wmr;
                $buh->details_bank = $user->profile->bank_account;
                $buh->save();
            }
            
            $this->_response->setData(
                array (
                    'project_price' => $payment->project_price,
                    'to_receive'    => $payment->to_receive,
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
	/*
    public function actionSavePaymentsToUser() {
        $this->_prepairJson();
        $orderId = $this->_request->getParam('order_id');
        $payment = ProjectPayments::model()->find('order_id = :ORDER_ID', array(
            ':ORDER_ID'=>$orderId
        ));
        if (!$payment) {
            $payment = new ProjectPayments;
            $payment->order_id = $orderId;
            $payment->received = 0;
            $payment->to_receive = 0;
            $payment->to_pay = 0;
        }

        $payment->project_price = $this->_request->getParam('project_price');
        $payment->to_receive   += (int) $this->_request->getParam('to_receive');
        if ($payment->save()) {

            $zakaz = Zakaz::model()->findByPk($orderId);
            if ($payment->project_price > 0 && $zakaz && $zakaz->status == 1) {
                $zakaz->status = 2;
                $zakaz->save(false);
            }

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
            ':ORDER_ID'=>$orderId
        ));
        if (!$payment) {
            $payment = new ProjectPayments;
        }


        $payment->work_price = $this->_request->getParam('work_price');
        $paying              = (int) $this->_request->getParam('to_pay');
        $payment->to_pay    += $paying;
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

    }*/

    public function actionManagersApprove() {
		new UploadPaymentImage;
		/////////////////////////////////////////////////////////////
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
			//remove chek
			$dir = Yii::getPathOfAlias('webroot') . UploadPaymentImage::$folder;
			if ($order->payment_image && file_exists($dir.$order->payment_image)) unlink($dir.$order->payment_image);
			$order->payment_image = null;
			if ($order->status < 3) $order->status = 3;
			$order->save();
			//
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
