<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 06.04.15
 * Time: 12:53
 */ ?>
<div class="info">
    <section class="hero clearfix p-maps"><h3>Карта сайта</h3>

        <div class="devyanosto"><a href="<?php echo Yii::app()->createUrl('registration/order');?>">
                <button type="submit" class="btn btn-large btn-primary">Оформить заказ</button>
            </a>

            <h2 style="margin-left: 0px;">Главная</h2>
            <ul>
                <li><a href="http://dipstart.ru/Sitemap.html">Карта сайта</a></li>
            </ul>
            <h2 style="margin-left: 0px;">О компании</h2>
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('site/page&view=warranty');?>">Гарантии</a></li>
                <li><a href="">Об авторах</a></li>
                <li><a href="">Сотрудничество</a></li>
                <li><a href="">Отзывы</a></li>
            </ul>
            <h2 style="margin-left: 0px;">Услуги</h2>
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('site/page&view=dissertation');?>">Диссертацию</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('site/page&view=diplom');?>">Дипломную</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('site/page&view=treatise');?>">Курсовую</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('site/page&view=abstract');?>">Реферат</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('site/page&view=report');?>">Отчет</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('registration/order');?>">Другое</a></li>
            </ul>
            <h2 style="margin-left: 0px;">Цены</h2>
            <ul>
                <li><a href="http://dipstart.ru/Akii.html">Акции</a></li>
            </ul>
            <div class="forseoprob"><h2>Заказать</h2>

                <h2>Готовые работы</h2>

                <h2>Контакты</h2>

                <h2>Обратная связь</h2></div>
        </div>
    </section>
</div>