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