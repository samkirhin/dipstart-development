<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 16.04.15
 * Time: 11:56
 */
$items = array();
$role = User::model()->getUserRole();
switch ($role){
    case 'Admin':

        //$items[] = array('label'=>Yii::t('site','Home'), 'url'=>Yii::app()->getBaseUrl(true));
        $items[] = array('label'=>Yii::t('site','Projects'), 'url'=>array('/project'), 'items' => array(
            array('label'=>Yii::t('site','Zakazs'), 'url'=>array('/project/zakaz')),
            array('label'=>Yii::t('site','Create Zakaz'), 'url'=>array('/project/zakaz/create')),
			array('label'=>Yii::t('site','Zakaz Fields'), 'url'=>array('/project/projectField/admin')),
        ), 'itemOptions' =>   array('class' => 'dropdown-submenu'));
        $items[] = array('label'=>Yii::t('site','Users'), 'url'=>array('/user'), 'items' => array(
            array('label'=>Yii::t('site','Users'), 'url'=>array('/user')),
            array('label'=>Yii::t('site','Profile Fields'), 'url'=>array('/user/profileField/admin')),
            array('label'=>Yii::t('site','Rights'), 'url'=>array('/rights')),
        ));
        $items[] = array('label'=>Yii::t('site','References'), 'url'=>array('#'), 'items' => array(
            array('label'=>Yii::t('site','Categories'), 'url'=>array('/categories/index')),
            array('label'=>Yii::t('site','Jobs'), 'url'=>array('/jobs/index')),
            array('label'=>Yii::t('site','Statuses'), 'url'=>array('/projectStatus/index')),
            array('label'=>Yii::t('site','Templates'), 'url'=>array('/templates/index')),
        ));
        $items[] = array('label'=>Yii::t('site','Events'), 'url'=>array('/project/event'));
        $user = User::model()->findByPk(Yii::app()->user->id);
        $items[] = array('label'=>'Бухгалтерия', 'url'=>array('/project/payment/view'), 'visible'=>$user->superuser);
        $items[] = array('label'=>Yii::t('site','Logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'));

        break;
    case 'Manager':

        //$items[] = array('label'=>Yii::t('site','Home'), 'url'=>array('/'));
        $items[] = array('label'=>Yii::t('site','Users'), 'url'=>array('/user'));
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
        $items[] = array('label'=>Yii::t('site','Events'), 'url'=>array('/project/event'));
        $items[] = array('label'=>Yii::t('site','Logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'));

        break;
}
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/skin.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/skin2.css');
Yii::app()->clientScript->registerCssFile('/css/font-awesome/css/font-awesome.css');

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo Yii::app()->controller->pageTitle;?></title>
</head>
<body>
<div class="main-menu">
			<?php
			$this->widget('application.extensions.booster.widgets.TbMenu',array(
				'justified'=>true,
				'items'=> $items,
				'type'=>'pills',
				'htmlOptions'=>array('class'=>'topMenu'),
			));
			?>
</div>
<div class="container">
	<div class="row main-header">
		<div class="header-logo"></div>
	</div>
<?php echo $content;?>
</div>
</body>
</html>
