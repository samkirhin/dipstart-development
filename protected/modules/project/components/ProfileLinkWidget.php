<?php

class ProfileLinkWidget extends CWidget {
 
    public $params = array(
        'userId'=>0,
        'name'=>'',
        'id'=>'',
        'isLink' => true
    );
 
    public function run() {
        $this->render('profilelink',array('params' => $this->params));
    }
}