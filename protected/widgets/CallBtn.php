<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CallBtn
 *
 * @author Admin
 */
class CallBtn  extends CWidget
{
    public $to;
    public function run()
    {
        echo CHtml::ajaxButton(
            'Call',
            ['/call/call'],
                [
                    'type' => 'POST',
                    'data'=> 'to='.$this->to,
                    'success'=>'function(msg){alert(msg);}',
                ]
        );
    }
}
