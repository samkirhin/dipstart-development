<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 16.04.15
 * Time: 11:56
 */
$items = array();
if (Yii::app()->user->isGuest) {
	$items[] = array('label'=>Yii::t('site','Home'), 'url'=>array('/site/index'));
	$items[] = array('label'=>Yii::t('site','About'), 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest);
	$items[] = array('label'=>Yii::t('site','Contact'), 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest);
	$items[] = array('label'=>Yii::t('site','Login'), 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest);
	$items[] = array('label'=>Yii::t('site','Logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('user/logout'), 'visible'=>!Yii::app()->user->isGuest);
} else {
	$role = User::model()->getUserRole();
	switch ($role){
		case 'Admin':

			$items[] = array('label'=>Yii::t('site','Home'), 'url'=>array('/site/index'));
			$items[] = array('label'=>Yii::t('site','Projects'), 'url'=>array('/project'), 'items' => array(
				array('label'=>Yii::t('site','Zakazs'), 'url'=>array('/project/zakaz')),
				array('label'=>Yii::t('site','Create Zakaz'), 'url'=>array('/project/zakaz/create')),
			), 'itemOptions' =>   array('class' => 'dropdown-submenu'));
			$items[] = array('label'=>Yii::t('site','Users'), 'url'=>array('/user'), 'items' => array(
				array('label'=>Yii::t('site','Profile Fields'), 'url'=>array('/user/profileField/admin')),
				array('label'=>Yii::t('site','Rights'), 'url'=>array('/rights')),
			));
			$items[] = array('label'=>Yii::t('site','References'), 'url'=>array('#'), 'items' => array(
				array('label'=>Yii::t('site','Categories'), 'url'=>array('/categories/index')),
				array('label'=>Yii::t('site','Jobs'), 'url'=>array('/jobs/index')),
				array('label'=>Yii::t('site','Statuses'), 'url'=>array('/projectStatus/index')),
				array('label'=>Yii::t('site','Templates'), 'url'=>array('/templates/index')),
			));
			$items[] = array('label'=>Yii::t('site', 'Message'), 'url'=>array('/mailbox/message'), 'items' => array(
				array('label'=>Yii::t('site', 'Inbox'), 'url'=>array('/mailbox/message/inbox')),
				array('label'=>Yii::t('site', 'Sent'), 'url'=>array('/mailbox/message/sent')),
				array('label'=>Yii::t('site','Trash'), 'url'=>array('/mailbox/message/trash')),
			));
			$user = User::model()->findByPk(Yii::app()->user->id);
			$items[] = array('label'=> Yii::t('site','Bookkeeping'), 'url'=>array('/project/payment/view'), 'visible'=>$user->superuser);
			$items[] = array('label'=>Yii::t('site','Logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'));

			break;
		case 'Manager':

			$items[] = array('label'=>Yii::t('site','Home'), 'url'=>array('/site/index'));
			$items[] = array('label'=>Yii::t('site','Projects'), 'url'=>array('/project/zakaz/admin'), 'items' => array(
				array('label'=>Yii::t('site','Zakazs'), 'url'=>array('/project/zakaz')),
				array('label'=>Yii::t('site','Create Zakaz'), 'url'=>array('/project/zakaz/create')),
			));
			$items[] = array('label'=>Yii::t('site','References'), 'url'=>array('#'), 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
				array('label'=>Yii::t('site','Categories'), 'url'=>array('/categories/index')),
				array('label'=>Yii::t('site','Jobs'), 'url'=>array('/jobs/index')),
				array('label'=>Yii::t('site','Statuses'), 'url'=>array('/projectStatus/index')),
				array('label'=>Yii::t('site','Templates'), 'url'=>array('/templates/index')),
			));
			$items[] = array('label'=>Yii::t('site', 'Message'), 'url'=>array('/mailbox/message'), 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
				array('label'=>Yii::t('site', 'Inbox'), 'url'=>array('/mailbox/message/inbox')),
				array('label'=>Yii::t('site', 'Sent'), 'url'=>array('/mailbox/message/sent')),
				array('label'=>Yii::t('site','Trash'), 'url'=>array('/mailbox/message/trash')),
			));
			$items[] = array('label'=>Yii::t('site','Logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'));

			break;
		case 'Author':

			$items[] = array('label'=>Yii::t('site','Home'), 'url'=>array('/site/index'));
			$items[] = array('label'=>'Личные данные', 'items'=>array(
				array('label'=> Yii::t('site','My account'), 'url'=>array('#')),
				array('label'=>Yii::t('site','Личный счет'), 'url'=>array('/user/profile/account')),
				array('label'=>Yii::t('site','Profile'), 'url'=>array('/user/profile/edit'))
			));
			$items[] = array('label'=>Yii::t('site','Projects'), 'items' => array(
				array('label'=>ProjectModule::t('Last Zakaz'), 'url'=>array('/project/zakaz/list')),
				array('label'=>ProjectModule::t('My Zakaz'), 'url'=>array('/project/zakaz/ownList')),
			));
			$items[] = array('label'=>Yii::t('site', 'Message'), 'url'=>array('/mailbox/message'), 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
				array('label'=>Yii::t('site', 'Inbox'), 'url'=>array('/mailbox/message/inbox')),
				array('label'=>Yii::t('site', 'Sent'), 'url'=>array('/mailbox/message/sent')),
				array('label'=>Yii::t('site','Trash'), 'url'=>array('/mailbox/message/trash')),
			));
			$items[] = array('label'=>Yii::t('site','Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'));

			break;

		case 'Customer':

			$items[] = array('label'=>Yii::t('site','Home'), 'url'=>array('/site/index'));
			$items[] = array('label'=>'Личные данные', 'items'=>array(
				array('label'=>'Личный кабинет', 'url'=>array('#')),
				array('label'=>'Личный счет', 'url'=>array('/user/profile/account')),
				array('label'=>Yii::t('site','Profile'), 'url'=>array('/user/profile/edit')),
			));
			$items[] = array('label'=>Yii::t('site','Projects'), 'url'=>array('#'), 'items' => array(
				array('label'=>ProjectModule::t('Create Zakaz'), 'url'=>array('/project/zakaz/create')),
				array('label'=>ProjectModule::t('My Zakaz'), 'url'=>array('/project/zakaz/customerOrderList'))
			));
			$items[] = array('label'=>Yii::t('site', 'Message'), 'url'=>array('/mailbox/message'), 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
				array('label'=>Yii::t('site', 'Inbox'), 'url'=>array('/mailbox/message/inbox')),
				array('label'=>Yii::t('site', 'Sent'), 'url'=>array('/mailbox/message/sent')),
				array('label'=>Yii::t('site','Trash'), 'url'=>array('/mailbox/message/trash')),
			));
			$items[] = array('label'=>Yii::t('site','Logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'));

			break;
	}
}
Yii::app()->getClientScript()->registerCoreScript('jquery');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Новые заказы</title>
	<!-- Bootstrap -->
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/libs/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/frontend/layout2/styles.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/libs/bootstrap/css/bootstrap-custom.css" rel="stylesheet">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="header-logo"></div>
	</div>
	<div class="row">
				<?php
				$this->widget('application.extensions.booster.widgets.TbMenu',array(
					'items'=> $items,
                    'htmlOptions'=>array('class'=>'nav-pills'),
                ));
				?>
	</div>
<?php echo $content;?>
</div>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
