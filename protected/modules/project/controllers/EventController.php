<?php

class EventController extends Controller {
    
    public function actionIndex() {
        
        $sql = 'SELECT * FROM `ProjectsEvents` ORDER BY `timestamp` ; ';
        $events = Events::model()->findAllBySql($sql);
        $this->render('index', array(
            'events' => $events 
        ));
        
    }
    
}
