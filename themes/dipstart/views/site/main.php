<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 28.05.15
 * Time: 22:22
 */
echo 'main';
if (User::model()->isAuthor()){
	$this->redirect('/project/zakaz/ownList');
}else{
	$this->redirect('/project/zakaz/customerOrderList');
}
?>
