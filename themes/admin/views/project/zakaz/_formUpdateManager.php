<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */
?>


<div class="col-xs-12 terms-block" style="padding-right: 0px;">
    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'zakaz-form',
            'enableAjaxValidation' => false,
        ));
        echo $form->errorSummary($model); ?>
    </div>
    <div class="row">
        <div class="col-xs-6"><h4>Сроки выполнения</h4></div>
        <div class="col-xs-6" style="float:right;">
            <?php echo CHtml::submitButton(ProjectModule::t('Save'), array('class' => 'btn btn-primary terms-save-btn')); ?>
        </div>
        <div class="col-xs-4 terms-columns">
            <p><?php echo $form->labelEx($model, 'max_exec_date'); ?></p>

            <?php
            $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'dbmax_exec_date',
            ));?>
        </div>
        <div class="col-xs-4 terms-columns">
            <p><?php echo $form->labelEx($model, 'manager_informed'); ?></p>
            <?php
            $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'dbmanager_informed',
            ));?>
        </div>
        <div class="col-xs-4 terms-columns terms-columns-last">
            <p><?php echo $form->labelEx($model, 'author_informed'); ?></p>
            <?php
            $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'dbauthor_informed',
            ));?>
        </div>




        <?php $this->endWidget(); ?>
    </div>
    <!-- form -->
</div>

<div class="col-xs-12 chatBlockBg">
    <div class="chatBlock">
        <div id="chatWindow"></div>
        <?php
        $this->widget('YiiChatWidget', array(
            'chat_id' => $model->id,
            'executor' => $model->executor,
            'identity' => Yii::app()->user->id,
            'selector' => '#chatWindow',
            'minPostLen' => 1,
            'maxPostLen' => 5000,
            'model' => new ChatHandler(),
            'data' => 'any data',
            'onSuccess' => new CJavaScriptExpression(
                "function(code, text, post_id){   }"),
            'onError' => new CJavaScriptExpression(
                "function(errorcode, info){  }"),
        ));
        ?>
    </div>
</div>

<div class="col-xs-12 payment-block">
    <?php
    $this->widget('application.modules.project.widgets.payment.PaymentWidget', array(
        'projectId' => $model->id
    ));
    ?>
</div>

</div>
</div>

<div class="row">
    <div class="col-xs-12 info-block">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-white">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#infoZakaz">
                            Информация о заказе
                        </a>
                    </h4>
                </div>
                <div id="infoZakaz" class="panel-collapse collapse">
                    <div class="panel-body">

                        <div class="col-xs-12 aboutZakaz">
                            <div class="form">

                                <?php $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'zakaz-form',
                                    'enableAjaxValidation' => false,
                                ));
                                echo $form->errorSummary($model); ?>
                                <div class="col-xs-6 info-column">
                                    <?php echo $form->labelEx($model, 'category_id'); ?>
                                    <?php $models = Categories::model()->findAll();
                                    $list = CHtml::listData($models, 'id', 'cat_name');
                                    echo $form->dropDownList($model, 'category_id', $list, array('empty' => ProjectModule::t('Select a category')));
                                    ?>
                                    <?php echo $form->error($model, 'category_id'); ?>
                                    <br>
                                    <?php echo $form->labelEx($model, 'job_id'); ?>
                                    <?php $models = Jobs::model()->findAll();
                                    $list = CHtml::listData($models, 'id', 'job_name');
                                    echo $form->dropDownList($model, 'job_id', $list, array('empty' => ProjectModule::t('Select a job')));
                                    ?>
                                    <?php echo $form->error($model, 'job_id'); ?>
                                    <br>
                                    <?php echo $form->labelEx($model, 'title'); ?>
                                    <?php echo $form->textField($model, 'title', array('size' => 70, 'maxlength' => 255)); ?>
                                    <?php echo $form->error($model, 'title'); ?>
                                    <br>
                                    <?php echo $form->labelEx($model, 'text'); ?>
                                    <?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 70)); ?>
                                    <?php echo $form->error($model, 'text'); ?>

                                    <h3> Сроки выполнения </h3>

                                    <table class="table table-striped" style="font-size: 12px;">
                                        <thead>
                                        <th>Наименование</th>
                                        <th>Дата</th>
                                        <th>Время</th>
                                        </thead>
                                        <tr>
                                            <td>
                                                <?php echo $form->labelEx($model, 'date'); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                                                    'model' => $model,
                                                    'attribute' => 'dbdate',
                                                ));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php echo $form->labelEx($model, 'date_finish'); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                                                    'model' => $model,
                                                    'attribute' => 'dbdate_finish',
                                                ));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php echo $form->labelEx($model, 'pages'); ?>
                                                <?php echo $form->textField($model, 'pages'); ?>
                                                <?php echo $form->error($model, 'pages'); ?>
                                            </td>
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                        </tr>

                                    </table>
                                    <?php echo $form->labelEx($model, 'time_for_call'); ?><br>
                                    <?php echo $form->textField($model, 'time_for_call'); ?>
                                    <?php echo $form->error($model, 'time_for_call'); ?>
                                    <br>
                                    <?php echo $form->labelEx($model, 'edu_dep'); ?><br>
                                    <?php echo $form->textField($model, 'edu_dep'); ?>
                                    <?php echo $form->error($model, 'edu_dep'); ?>
                                </div>
                                <div class="col-xs-6 info-column">

                                    <?php echo $form->labelEx($model, 'add_demands'); ?><br>
                                    <?php echo $form->textArea($model, 'add_demands', array('rows' => 6, 'cols' => 53)); ?>
                                    <?php echo $form->error($model, 'add_demands'); ?>
                                    <br>
                                    <?php echo $form->labelEx($model, 'notes'); ?><br>
                                    <?php echo $form->textArea($model, 'notes', array('rows' => 6, 'cols' => 53)); ?>
                                    <?php echo $form->error($model, 'notes'); ?>
                                    <br>
                                    <?php echo $form->labelEx($model, 'author_notes'); ?><br>
                                    <?php echo $form->textArea($model, 'author_notes', array('rows' => 6, 'cols' => 53)); ?>
                                    <?php echo $form->error($model, 'author_notes'); ?>
                                </div>
                                <div class="col-xs-12 info-buttons">
                                    <div
                                        style="float: right;"><?php echo CHtml::submitButton(ProjectModule::t('Save'), array('class' => 'btn btn-primary')); ?></div>
                                </div>

                                <?php $this->endWidget(); ?>
                            </div>
                            <!-- form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
