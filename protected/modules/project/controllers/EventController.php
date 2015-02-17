<?php

class EventController extends Controller {

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
