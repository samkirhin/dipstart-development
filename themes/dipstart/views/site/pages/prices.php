<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 06.04.15
 * Time: 12:50
 */ ?>
<div class="info">
    <section class="hero clearfix">
        <h3>Расценки</h3>

        <a href="<?php echo Yii::app()->createUrl('registration/order');?>">
            <div class="devyanosto">
                <button class="btn btn-large btn-primary" type="submit">Оформить заказ</button>
            </div>
        </a>

        <p class="halv"><b>Мы не берём 100% предоплаты на выполнение работы.</b> Мы предлагаем Вам очень удобную систему
            оплаты. Вы вносите всего 50% депозита и оплачиваете остальные 50% только тогда, когда Ваша работа выполнена
            на 100% так, как вы заказывали. <b>Все доработки (в т.ч. и после сдачи работы!) выполняются бесплатно!</b>
            Убедительно просим Вас не сотрудничать с компаниями, которые просят Вас внести 100% предоплаты. <b>Цены на
                дипломные работы, цены на диссертации, цены на курсовые работы</b><br/>
            Оплата происходит по факту выполненной работы, после её проверки клиентом!</p>

        <h3 class="title-prices-list">Прайс-лист</h3>

        <div class="bg-tg-table-plain">
            <table class="tg-table-plain">
                <tbody>
                <tr class="header_price">
                    <th>Тип работы</th>
                    <th>Примечания</th>
                    <th>Стоимость(руб)</th>
                </tr>
                <tr>
                    <td><span>Реферат</span></td>
                    <td><span>10-12 стр., 14 шрифт, 7 дней</span></td>
                    <td><span>от 900*</span></td>
                </tr>
                <tr class="tg-even">
                    <td><span>Контрольная работа</span></td>
                    <td><span>10-12 стр., 14 шрифт, 7 дней</span></td>
                    <td><span>от 900*</span></td>
                </tr>
                <tr>
                    <td><span>Отчет по практике</span></td>
                    <td><span>15-20 стр., 14 шрифт, 14 дней</span></td>
                    <td><span>от 1500*</span></td>
                </tr>
                <tr class="tg-even">
                    <td><span>Курсовая работа</span></td>
                    <td><span>20-25 стр., 14 шрифт, 14 дней</span></td>
                    <td><span>от 2000*</span></td>
                </tr>
                <tr>
                    <td><span>Курсовая работа с практической частью</span></td>
                    <td><span>20-25 стр., 14 шрифт, 16 дней</span></td>
                    <td><span>от 2500*</span></td>
                </tr>
                <tr class="tg-even">
                    <td><span>Технический курсовой проект</span></td>
                    <td><span>25-30 стр., 14 шрифт, 21 дней</span></td>
                    <td><span>от 3500*</span></td>
                </tr>
                <tr>
                    <td><span>Дипломный проект<br/>
			 Дипломная работа</span></td>
                    <td><span>60 стр., 14 шрифт, 30 дней</span></td>
                    <td><span>от 8000*</span></td>
                </tr>
                <tr class="tg-even">
                    <td><span>Дипломная работа МВА</span></td>
                    <td><span>60 стр., 14 шрифт, 30 дней</span></td>
                    <td><span>от 10 000**</span></td>
                </tr>
                <tr>
                    <td><span>Кандидатская диссертация</span></td>
                    <td><span>100 стр., 14 шрифт</span></td>
                    <td><span>от 70 000*</span></td>
                </tr>
                <tr class="tg-even">
                    <td><span>Докторская диссертация</span></td>
                    <td><span>150 стр., 14 шрифт</span></td>
                    <td><span>цена зависит от<br/>
			 направления и<br/>
			 требований</span></td>
                </tr>
                <tr>
                    <td><span>Автореферат к диссертации</span></td>
                    <td><span>10-15 стр., 14 шрифт, 14 дней</span></td>
                    <td><span>от 6000*</span></td>
                </tr>
                <tr class="tg-even">
                    <td><span>Бизнес-план</span></td>
                    <td><span>1-5 стр., 14 шрифт, 14 дней</span></td>
                    <td><span>от 10 000*</span></td>
                </tr>
                <tr>
                    <td><span>Перевод</span></td>
                    <td><span>Английский, Немецкий, Французский,<br/>
			 Итальянский и др. языки</span></td>
                    <td><span>от 200 руб*<br/>
			 за 180* знаков</span></td>
                </tr>
                <tr class="tg-even">
                    <td><span>Чертежи</span></td>
                    <td><span>А1 - 7 дней<br/>
			 А3 - 5 дней<br/>
			 А4 - 5 дней</span></td>
                    <td><span>от 700*<br/>
			 от 550*<br/>
			 от 400*</span></td>
                </tr>
                <tr>
                    <td><span>Эссе</span></td>
                    <td><span>2-5 стр., 14 шрифт, 14 дней</span></td>
                    <td><span>от 500*</span></td>
                </tr>
                <tr class="tg-even">
                    <td><span>Набор текста</span></td>
                    <td><span>рубли/страницы</span></td>
                    <td><span>от 25*/1</span></td>
                </tr>
                <tr>
                    <td><span>Готовые работы</span></td>
                    <td><span>Реферат<br/>
			 Курсовая работа<br/>
			 Дипломный проект</span></td>
                    <td><span>от 600*<br/>
			 от 1000*<br/>
			 от 4000*</span></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="footnotes">
            <p class="red">*Заказывайте работы в Dipstart +7 (495) 504 37 19</p>

            <div class="buy">
                <hr/>
                <p>Каждая работа индивидуальна, поэтому точная стоимость работы расcчитываеться из следующих
                    факторов:</p>

                <ol>
                    <li>
                        <p>Тема работа</p>
                    </li>
                    <li>
                        <p>Специальность</p>
                    </li>
                    <li>
                        <p>Объём работы</p>
                    </li>
                    <li>
                        <p>Дополнительные пожелания к выполнению работы(написание речи, преддипломной практики и
                            т.д.)</p>
                    </li>
                    <li>
                        <p>Сроки выполнения</p>
                    </li>
                </ol>
            </div>
        </div>
    </section>
</div>
