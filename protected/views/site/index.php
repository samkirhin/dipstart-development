<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Добро пожаловать, <b><?php echo Yii::t('site',$role); ?></b>, на наш сайт <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Мы рады приветствовать Вас на нашем сайте. Для начала работы <a href="<?php echo $this->createUrl('/user/login');?>">войдите</a> либо <a href="<?php echo $this->createUrl('/user/registration&role=Customer');?>">зарегистрируйтесь</a>.</p>

