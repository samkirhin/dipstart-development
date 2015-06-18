<?php

class EventController extends Controller {

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index'),
                'users'=>array('admin','manager'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
    public function actionIndex() {
        $events = Events::model()->findAll(array(
            'condition' => '',
            'order' => 'timestamp DESC'
        ));

        $this->render('index', array(
            'events' => $events
        ));
        
    }
    
}
