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
    $items = array();
    if (Yii::app()->user->isGuest) {
            $items[] = array('label'=>Yii::t('site','Home'), 'url'=>array('/site/index'));
            $items[] = array('label'=>Yii::t('site','About'), 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest);
            $items[] = array('label'=>Yii::t('site','Contact'), 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest);
            $items[] = array('label'=>Yii::t('site','Login'), 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest);
            $items[] = array('label'=>Yii::t('site','Logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest);
    } else {
        $role = User::model()->getUserRole();
        switch ($role){
            case 'Admin':
                
                $items[] = array('label'=>Yii::t('site','Home'), 'url'=>array('/site/index'));
                $items[] = array('label'=>Yii::t('site','Projects'), 'url'=>array('/project'), 'items' => array(
                        array('label'=>Yii::t('site','Zakazs'), 'url'=>array('/project/zakaz')),
                        array('label'=>Yii::t('site','Create Zakaz'), 'url'=>array('/project/zakaz/create')),
                    ));
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
                $items[] = array('label'=>'Бухгалтерия', 'url'=>array('/project/payment/view'), 'visible'=>$user->superuser);
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
                    array('label'=>'Личный кабинет', 'url'=>array('#')),
                    array('label'=>'Личный счет', 'url'=>array('/user/profile/account')),
                    array('label'=>'Профиль', 'url'=>array('/user/profile/edit'))
                ));
                $items[] = array('label'=>Yii::t('site','Projects'), 'url'=>array('#'), 'items' => array(
                    array('label'=>ProjectModule::t('Last Zakaz'), 'url'=>array('/project/zakaz/list', 'status' => '2')),
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
                    array('label'=>'Профиль', 'url'=>array('/user/profile/edit')),
                ));
                $items[] = array('label'=>Yii::t('site','Projects'), 'url'=>array('#'), 'items' => array(
                    array('label'=>ProjectModule::t('Create Zakaz'), 'url'=>array('/project/zakaz/create')),
                    array('label'=>'Мои заказы', 'url'=>array('#'))
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
                <!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=27826308&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/27826308/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:27826308,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter27826308 = new Ya.Metrika({id:27826308,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/27826308" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
