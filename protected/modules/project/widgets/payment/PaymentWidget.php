<?php

class PaymentWidget extends CWidget {
    
    public $projectId;
    
    public function init() {
        
        $payments = ProjectPayments::model()->find('order_id = :ORDER_ID', array(
            ':ORDER_ID' => $this->projectId
        ));
        if (!$payment) {
            $model = new ProjectPayments();
            $model->order_id = $this->projectId;
            $project = Zakaz::model()->findByPk($this->projectId);
            $model->project_price = $project->budget;
            if ($model->save()) {
                $payments = $model;
            }
        }
        $this->renderForm($payments);
        
    }
    
    public function renderForm($payments) {
        $userRole = User::model()->getUserRole();
        if ($userRole == 'Admin') {
            $userRole = 'Manager';
        }
        Yii::app()->controller->renderPartial('application.modules.project.widgets.payment.views.view'.$userRole, array(
            'model' => $payment
        ));
    } 
    
    
}
