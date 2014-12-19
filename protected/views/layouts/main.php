<?php /* @var $this Controller */ ?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />


	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
<?php
if (User::model()->isAdmin() || User::model()->isManager()){
$items = array(
				array('label'=>Yii::t('site','Home'), 'url'=>array('/site/index')),

                array('label'=>Yii::t('site','Projects'), 'url'=>array('/project'), 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
                    array('label'=>Yii::t('site','Zakazs'), 'url'=>array('/project/zakaz')),
                    array('label'=>Yii::t('site','Create Zakaz'), 'url'=>array('/project/zakaz/create')),

                )),
                array('label'=>Yii::t('site','Users'), 'url'=>array('/user'), 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
                     array('label'=>Yii::t('site','Profile Fields'), 'url'=>array('/user/profileField/admin')),
                     array('label'=>Yii::t('site','Rights'), 'url'=>array('/rights')),
                )),
                array('label'=>Yii::t('site','References'), 'url'=>array('#'), 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
                    array('label'=>Yii::t('site','Categories'), 'url'=>array('/categories/index')),
                    array('label'=>Yii::t('site','Jobs'), 'url'=>array('/jobs/index')),
                    array('label'=>Yii::t('site','Statuses'), 'url'=>array('/projectStatus/index')),
                    array('label'=>Yii::t('site','Templates'), 'url'=>array('/templates/index')),
                )),

                array('label'=>Yii::t('site','About'), 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('site','Contact'), 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest),

                array('label'=>Yii::t('site', 'Message'), 'url'=>array('/mailbox/message'), 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
                     array('label'=>Yii::t('site', 'Inbox'), 'url'=>array('/mailbox/message/inbox')),
                     array('label'=>Yii::t('site', 'Sent'), 'url'=>array('/mailbox/message/sent')),
                     array('label'=>Yii::t('site','Trash'), 'url'=>array('/mailbox/message/trash')),
                )),


                array('label'=>Yii::t('site','Login'), 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('site','Logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
            );
}else if (User::model()->isAuthor() || User::model()->isCustomer()) {
$items = array(
				array('label'=>Yii::t('site','Home'), 'url'=>array('/site/index')),

                array('label'=>Yii::t('site','Projects'), 'url'=>array('#'), 'items' => array(
                    array('label'=>ProjectModule::t('Last Zakaz'), 'url'=>array('/project/zakaz/list', 'status' => '2'), 'visible'=>User::model()->isAuthor()),
                    array('label'=>ProjectModule::t('My Zakaz'), 'url'=>array('/project/zakaz/list', 'status' => '4', 'executor' => Yii::app()->user->id), 'visible'=>User::model()->isAuthor()),
                    array('label'=>ProjectModule::t('Create Zakaz'), 'url'=>array('/project/zakaz/create'), 'visible'=> User::model()->isCustomer()),
                    array('label'=>UserModule::t('Profile edit'), 'url'=>array('/user/profile/edit'), 'visible'=> User::model()->isCustomer()),

                )),
                array('label'=>Yii::t('site','About'), 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('site','Contact'), 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest),

                array('label'=>Yii::t('site', 'Message'), 'url'=>array('/mailbox/message'), 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
                     array('label'=>Yii::t('site', 'Inbox'), 'url'=>array('/mailbox/message/inbox')),
                     array('label'=>Yii::t('site', 'Sent'), 'url'=>array('/mailbox/message/sent')),
                     array('label'=>Yii::t('site','Trash'), 'url'=>array('/mailbox/message/trash')),
                )),

                array('label'=>Yii::t('site','Login'), 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('site','Logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)

        );
}else{
 $items =  array(
				array('label'=>Yii::t('site','Home'), 'url'=>array('/site/index')),

                array('label'=>Yii::t('site','About'), 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('site','Contact'), 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest),

				array('label'=>Yii::t('site','Login'), 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('site','Logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
            );
}
?>
	<div id="mainMbMenu">
		<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
			'items'=> $items));
        ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> Dipstart.ru<br/>
		<?=Yii::t('site','All rights reserved.')?><br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
