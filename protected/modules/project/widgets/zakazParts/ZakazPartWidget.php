<?php

class ZakazPartWidget extends CWidget{
    
    public $projectId;
    public $userType;
    public $action = 'view';
    
    
    public function init() {
        switch ($this->action) {
            case 'edit':
                $type = 'edit';
                break;
            default:
                $type = 'show';
                break;
        }
        
        $this->renderPartForm($type);
    }
    
    public function renderPartForm($type) {
        Yii::app()->controller->renderPartial('application.modules.project.widgets.zakazParts.views.'.$type, array(
            'orderId' => $this->projectId
        ));
    }
}
