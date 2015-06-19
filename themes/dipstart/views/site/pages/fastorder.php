<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 06.04.15
 * Time: 12:40
 */
?>
<div class="info">
    <section class="hero clearfix">
        <div>
            <h3>Заказать дипломную работу. Дипломные работы на заказ.</h3>

            <p class="halv">Компания "ДипСтарт" успешно предоставляет услуги по написанию авторских дипломных работ уже
                более 7 лет! Мы сотрудничаем с преподавателями лучших ВУЗов России и предоставляем нашим Клиентам только
                100% оригинальные работы. Мы готовы принять Ваш заказ в любое время и написать дипломную работу по любой
                специальности (например: дипломная работа по экономике, дипломная работа по менеджменту, дипломные
                работы по техническим и гуманитарные дисциплинам) по приемлемой для Вас цене. Кроме того, выгодные
                акции, действующие для наших клиентов, Вас приятно удивят!</p>

            <form id="fastorder" class="form-horizontal">
                <div class="myrow clearfix"><select name="type" id="type" class="col_33">
                        <option disabled="disabled" selected="selected" value="">Выбрать тип</option>
                        {$vid}</select> <input name="volume" id="volume" class="col_33" placeholder="Объем"
                                               type="text"/> <input name="phone" id="phone" class="col_33"
                                                                    placeholder="Телефон" type="text"/>

                    <div class="devyanosto"><br>
                        <button class="btn btn-large btn-primary " type="submit">Заказать работу</button>
                    </div>
            </form>
        </div>

        <div class="right">
            <div class="student">
                <div class="photo"><img alt="" height="124"
                                        src="<?php echo Yii::app()->request->baseUrl; ?>/images/x_8649f776.jpg"/></div>

                <p>Казаринов Нарим Камилевич</p>
            </div>

            <div class="student">
                <div class="photo"><img alt="" height="124"
                                        src="<?php echo Yii::app()->request->baseUrl; ?>/images/x_f57826f8.jpg"/></div>

                <p>Миленкина Екатерина Борисовна</p>
            </div>

            <div class="student">
                <div class="photo"><img alt="" height="124"
                                        src="<?php echo Yii::app()->request->baseUrl; ?>/images/x_4a4e791e.jpg"/></div>

                <p>Бородин Андрей Дмитриевич</p>
            </div>
        </div>
    </section>
</div>