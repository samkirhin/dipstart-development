<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 05.04.15
 * Time: 23:56
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="{$description}" />
    <meta name="keywords" content="{$keywords}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--[if lte IE 8]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/main.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/skin.css" />
    <link href='http://fonts.googleapis.com/css?family=Lobster&subset=cyrillic' rel='stylesheet' type='text/css' />
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie/8.css" />
    <![endif]-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie/7.css" />
    <![endif]-->
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700,700italic&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Quicksand&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico"/>
    <link rel="icon" type="image/ico" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico"/>
    <link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico"/>
</head>
<body>
<!--[if lt IE 7]>
<p class="browsehappy">Вы используете <strong>устаревший</strong> браузер. Пожалуйста, <a href="http://browsehappy.com/">обновите ваш браузер</a>.</p>
<![endif]-->
<div class="container">
    <header class="header clearfix">
       <div class="row">
        <div class="logo col-xs-12 col-sm-12 col-md-3">
            <a href="/">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/header-logo.png" alt="Dipstart" />
            </a>
        </div>
        <!-- 1st column-->
        <div class="col-xs-12 col-sm-12 col-md-3 login">
                 <?php $this->renderPartial('//layouts/user_panel');?>
        </div>
        <!-- 2nd column-->
        <div class="col-xs-12 col-sm-12 col-md-3 header-contacts">
            <p>Почта: <span class="telenumb">dipstartru@mail.ru</span></br>
                <span>Скайп: </span><span class="telenumb">dipstart2010</span></br>
                <span class="telenumb">Тел: +7 (495) 504 37 19</span></br>
                заказать
                <a href="#callRequest" data-keyboard="true" data-backdrop="true" data-controls-modal="callRequest" class="callback">
                    <span class="callback-phone"></span>
                    обратный звонок
                </a>
            </p>
        </div>

        <!-- 3rd column-->
        <div class="col-xs-12 col-sm-12 col-md-3 header-adress">
            <p>г. Москва <br>м. Петровско-разумовская <br>Локомотивный проезд 21<br><a href="/Kontakti.html">показать на карте</a></p>
        </div>
        <div class="modal hide" id="callRequest" style="z-index:99999999">
            <form action="/registration/zakaz_mini" id="FormPanelAddRega" method="post">
                <div class="modal-header">
                    <button type="button" class="pull-right modal-close close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style=" margin:20px 0 10px 0; ">Запросить обратный звонок</h4>
                    <span>пожалуйста, вводите телефон в международном формате</span>
                </div>
                <div class="modal-body">
                    <label class="grey" for="phone">Телефон:</label>
                    <input type="hidden" name="zakaz_mini" />
                    <input class="span4" type="text" name="zakaz_mini_phone" id="add_rega_mobila" value="" />
                </div>
                <div class="modal-footer">
                    <label id="error_add_rega"></label>
                    <input type="submit" name="submit" class="pull-right" id="add_rega" value="Отправить" />
                </div>
            </form>
        </div>
    </div>
	<div id="control-menu">
		<? $this->widget('application.extensions.booster.widgets.TbMenu',array(
			'items'=> $this->menu,
			'type'=>'tabs',
			'htmlOptions'=>array('class'=>'userMenu'),
		));
		?>
	</div>
    </header>
    
    <div class="row">
       <a id="touch-menu" class="mobile-menu" href="#"><i class="icon-reorder"></i>Меню</a>
        <nav class="navbar-default">
   <?php
            if (    Yii::app()->user->isGuest) $this->widget('application.extensions.booster.widgets.TbMenu',array(
                    'htmlOptions'=>array('class'=>'menu'),
                    'items'=>array(
                    array('label'=>'<img src="'.Yii::app()->theme->baseUrl.'/images/home.png" alt="Главная" />','url'=>array('site/index'),'encodeLabel'=>false,'items'=>array(
                        array('label'=>'Карта сайта','url'=>array('site/page','view'=>'map')),
                        array('label'=>'Об авторах','url'=>array('site/page','view'=>'about')),
                        array('label'=>'Сотрудничество','url'=>array('site/index')),
                        array('label'=>'Отзывы','url'=>array('site/index')),
                        array('label'=>'Готовые работы','url'=>array('site/index')),
                        array('label'=>'Услуги - Диссертацию','url'=>array('site/page','view'=>'dissertation')),
                        array('label'=>'Услуги - Дипломную','url'=>array('site/page','view'=>'diplom')),
                        array('label'=>'Услуги - Курсовую','url'=>array('site/page','view'=>'treatise')),
                        array('label'=>'Услуги - Реферат','url'=>array('site/page','view'=>'abstract')),
                        array('label'=>'Услуги - Отчет','url'=>array('site/page','view'=>'report')),
                        array('label'=>'Услуги - Другое','url'=>array('registration/order')),
                        array('label'=>'Новости','url'=>array('site/page','view'=>'dissertation')),
                        array('label'=>'Статьи','url'=>array('site/page','view'=>'dissertation')),
                    )),
                    array('label'=>'Цены','url'=>array('site/page','view'=>'prices')),
                    array('label'=>'Специальности','url'=>array('site/page','view'=>'specialty')),
                    array('label'=>'Быстрый заказ','url'=>array('site/page','view'=>'fastorder')),
                    array('label'=>'Сроки','url'=>array('site/page','view'=>'terms')),
                    array('label'=>'Заказать','url'=>array('site/page','view'=>'order')),
                    array('label'=>'Гарантии','url'=>array('site/page','view'=>'warranty')),
                    array('label'=>'Контакты','url'=>array('site/page','view'=>'contacts')),
                    array('label'=>'оформить заказ','url'=>array('site/page'),'linkOptions'=>array('class'=>'button4 notmobileOrder')),
                    ),
                )
            );
            ?>
          
</nav>        
    </div>
    <div class="content-clearfix">
       <?php echo $content; ?>
    </div>
</div>
   
   <!-- FOOTER -->
   

<footer class="footer clearfix">
   <div class="container">
       <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 copyright center" style="padding-bottom:10px;"><span>DIPSTART</span></br>@ 2010-2015. Все права защищены</div>
    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px;">
    <button type="submit" onclick="$( location ).attr('href', 'registration/zakaz');" class="btn footerfirstbtn col-xs-12 col-sm-12">Оставить заявку</button>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px;">
    <button type="submit" data-keyboard="true" data-backdrop="true" data-controls-modal="callRequest" class="btn footersectbtn col-xs-offset-1 col-xs-12 col-sm-12">Обратный звонок</button>
    </div>
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-3 center" style="margin-bottom:1em;">
        <p style="margin: 0px;">Тел: +7 (495) 504 37 19</p>
        <p>E-mail: dipstartru@mail.ru</p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-2 center">
        <div style="width: 105px; padding-top: 5px; margin: 0 auto;">
    <a href="http://vk.com/club14585797"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/vkico.png"></a>
    <a href="https://www.facebook.com/pages/DipStart/228106837249863?hc_location=timeline"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/fbico.png"></a>
        </div>
    </div>
    </div>
   </div>
</footer>

<div class="modal hide" id="restorePass" style="z-index:99999999">
    <form id="FormRestorePass" method="post">
        <div class="modal-header">
            <button type="button" class="pull-right modal-close close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 style=" margin:20px 0 10px 0; ">Востановление пароля</h4>
            <span>Пожалуйста, введите e-mail, указанный при регистрации и нажмите кнопку “Отправить новый пароль”</span>
        </div>
        <div class="modal-body">
            <label class="grey" for="email">E-mail:</label>
            <input class="span4" type="text" name="email" id="restore_pass_email" value="" />
            <input type="hidden" name="restore_password" value="1" />
        </div>
        <div class="modal-footer">
            <label id="error_add_rega"></label>
            <input class="pull-right" type="submit" name="submit" id="do_restore_password" value="Отправить новый пароль" class="btn" />
        </div>
    </form>
</div>


<!--JS-->
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.tinycarousel.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.slicknav.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/menu.js"></script>

<!--Мобильное меню-->
<script type="text/javascript">
    $(document).ready(function(){
        $('.main-menu').slicknav();
    });
</script><!--Запуск мобильного меню-->
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#slider1').tinycarousel();
    });
</script>
<!-- Yandex.Metrika counter -->
<?php /*<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter17979787 = new Ya.Metrika({id:17979787,
                    webvisor:true,
                    clickmap:true,
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
<noscript><div><img src="//mc.yandex.ru/watch/17979787" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->*/?>
</body>
</html>
