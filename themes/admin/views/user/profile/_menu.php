<?php
if (User::model()->isAdmin() || User::model()->isManager()){
    $this->menu = array(
        array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
        array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
        array('label'=>UserModule::t('Profile Edit'), 'url'=>array('/user/profile/edit')),
        array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
        array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
    );
}elseif (User::model()->isAuthor() || User::model()->isCustomer()) {
    $this->menu = array(
        array('label'=>ProjectModule::t('Last Zakaz'), 'url'=>array('/project/zakaz/list', 'status' => '1'), 'visible'=>User::model()->isAuthor()),
        array('label'=>ProjectModule::t('My Zakaz'), 'url'=>array('/project/zakaz/list', 'uid' => '1', 'status' => '2'), 'visible'=>User::model()->isAuthor()),
        array('label'=>UserModule::t('Profile Edit'), 'url'=>array('/user/profile/edit')),
        array('label'=>ProjectModule::t('Create Zakaz'), 'url'=>array('/project/zakaz/create'), 'visible'=> User::model()->isCustomer()),
        array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
        array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
    );
}


?>