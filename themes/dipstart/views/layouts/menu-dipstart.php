    <div class="row">
       <a id="touch-menu" class="mobile-menu" href="#"><i class="icon-reorder"></i><?= UserModule::t('Menu') ?></a>
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