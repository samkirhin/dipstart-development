<?php
/* @var $this RegistrationController */

$this->breadcrumbs=array(
	'Registration'=>array('/registration'),
	'Order',
);
?>
<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 06.04.15
 * Time: 10:48
 */

//Yii::app()->clientscript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/zakaz/function.js?v=2');
//Yii::app()->clientscript->registerScriptFile(Yii::app()->request->baseUrl.'/js/zakaz/file.js');
//Yii::app()->clientscript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQ/ui/jquery.ui.core.js');
//Yii::app()->clientscript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQ/ui/jquery.ui.datepicker.js');
//Yii::app()->clientscript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQ/ui/i18n/jquery.ui.datepicker-ru.js');
//Yii::app()->clientscript->registerCssFile(Yii::app()->request->baseUrl.'/js/jQ/themes/base/jquery.ui.all.css');
/*Yii::app()->clientscript->registerScript('custom1','
    $(function() {

        $( "input[id^=\'data\']" ).datepicker({
            showOn: "button",
            buttonImage: "<?php echo Yii::app()->request->baseUrl; ?>/js/jQ/images/calendar.gif",
            buttonImageOnly: true,
            altFormat: " d MM, yy",
            buttonText: "Выберите дату"
        });



        $( "#dater" ).datepicker({
            altField: "#alternate",
            showOn: "button",
            buttonImage: "<?php echo Yii::app()->request->baseUrl; ?>/js/jQ/images/calendar.gif",
            buttonImageOnly: true,
            altFormat: "dd.mm.yy",
            buttonText: "Выберите дату"
        });


    });
');
Yii::app()->clientscript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery/jquery-ui-timepicker-addon.js');
Yii::app()->clientscript->registerScript('custom2','
    $("#example3").timepicker({});
');
Yii::app()->clientscript->registerScriptFile(Yii::app()->request->baseUrl.'/js/zak.js');
*/?>
<div class="info">
    <section class="hero clearfix">

        <h3>Заказ работы</h3>
        <p class="halv">Если у Вас возникли трудности или вопросы при заполнении формы заказа, Вы можете связаться
            с менеджером по телефону: +7 (495) 504-37-19, либо посмотреть
            <a href="http://dipstart.ru/kak-zakazat-diplom.html">подробную инструкцию</a>.
            После оформления заявки Менеджер свяжется с Вами в течение 10 минут для подтверждения заказа.
            Если Вы хотите оперативно узнать стоимость Вашей работы, Вы можете позвонить менеджеру по телефону:
            +7 (495) 504 37 19, в skype:dipstart2010, ICQ: 616-403-777. Спасибо!
        </p>
        <div class="devyanosto">
            <div class="buy-form">
                <?php if ($error!=''): ?>
                    <p style="color:red">{$error}</p>
                <?php endif; ?>

                <form role="form" method='post' id='zakaz_add' action="
                <?php echo Yii::app()->request->baseUrl.'/'.(Yii::app()->user->isGuest?'registration/zakaz':'user/add_prof_zakaz');?>" enctype="multipart/form-data">
                    <?php $this->renderPartial('user_order');
                    if (Yii::app()->user->isGuest) $this->renderPartial('user_rega',array('user_type'=>'customer'));?>
                    <input type='hidden' name='rega'>
                    <div class="devyanosto">
                        <button class="btn btn-large btn-primary" href="javascript:void(0)" onclick="$('#zakaz_add').submit()">Оформить заказ</button>
                    </div>
                </form>
            </div>
        </div>
        <?php /*   Yii::app()->clientscript->registerScript('custom2','
           $(":file").filestyle();
        ');*/
        ?>
    </section>
</div>
