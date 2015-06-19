<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 28.05.15
 * Time: 22:22
 */
$this->widget('application.extensions.booster.widgets.TbMenu',array(
    'items'=> $this->menu,
    'type'=>'tabs',
    'htmlOptions'=>array('class'=>'userMenu'),
));
