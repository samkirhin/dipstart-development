<?php

class TipsWidget extends CWidget{
    public $project;

    public function init() {
    }

    public function run() {
    	$tip = Templates::model()->findByAttributes([
    		'type_id' => 5,
    		'name' => 'tip_just_in',
    	]);

    	$this->render('view', array(
            'tip' => $tip
        ));
    }
}
