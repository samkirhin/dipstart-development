<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $profile Profile */
/* @var $author User */
/* @var $customer User */

$user = User::model();
$author = $model->author;
$customer = $model->user;

$this->breadcrumbs = array(
    ProjectModule::t('Zakazs') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    ProjectModule::t('Update'),
);
?>

<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>
    <h1><?= ProjectModule::t('Update Zakaz') ?> <span id="order_number"><?php echo $model->id; ?></span>
			<?php if ($model->status < 5) { ?>
				<button id="close_order" class="btn btn-change-status" onclick="js: window.location='<?php echo $this->createUrl('',array('id'=>$model->id,'close'=>'yes'));?>';"><?=ProjectModule::t('Complete the order')?></button>
			<?php } else { ?>
				<button id="open_order" class="btn btn-change-status" onclick="js: window.location='<?php echo $this->createUrl('',array('id'=>$model->id,'open'=>'yes'));?>';"><?=ProjectModule::t('Open order')?></button>
			<?php } ?>
	</h1>
    <div class="row">
        <?php
        //$this->renderPartial('_order_list_update');
        ?>
    </div>
    <div class="row order-contacts">
        <?php if ($author): ?>
        <div class="col-lg-6 col-xs-6 rightBorder">
            <div class="authorText"><b><a href="<?php echo Yii::app()->createUrl('/user/admin/update',array('id'=>$author->id));?>"><?=ProjectModule::t('Author')?></a></b></div>
            <div class="authorName"><p><?= $author->full_name ?></p></div>
            <div class="authorMail"><p class="author-mail-icon"></p><p><?= $author->email ?></p></div>
            <div class="authorPhone"><p class="author-phone-icon"></p><p><?= $author->phone_number ?></p></div>
        </div>
        <?php endif; ?>
        <div class="col-lg-6 col-xs-7 leftBorder">
            <div class="customerText"><b><a href="<?php echo Yii::app()->createUrl('/user/admin/update',array('id'=>$customer->id));?>"><?=ProjectModule::t('Customer')?></a></b></div>
            <div class="customerName"><p><?= $customer->full_name ?></p></div>
            <div class="customerMail"><p class="customer-mail-icon"></p><p><?= $customer->email ?></p></div>
            <div class="customerPhone"><p class="customer-phone-icon"></p><p><?= $customer->phone_number ?></p></div>
        </div>
    </div>

    <div class="row">
       <!-- Left column -->

        <div class="col-xs-4 left-column">
            <div class="row zero-edge">
               <div class="col-xs-12 statusBlock">
                   <span class="label label-warning"><b><?= $message; ?></b></span>
				   <button class="btn btn-primary btn-spam" onclick="spam(<?php echo $model->id; ?>);" href=""><?=ProjectModule::t('Search author')?></button>
					<!-- Тут была кнопка открыть или закрыть заказ -->
               </div>
            </div>
            <?php if ($isModified) echo '<span><b>'. ProjectModule::t('Order moderation') .'</b></span>';?>

            <div class="row">
                <div class="col-xs-12">
					<!-- Тут была кнопка рассылки -->
                </div>
                <div class="col-xs-12 notes">
                    <h4><?=ProjectModule::t('Notes (on all orders)')?></h4

                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'zakaz-form',
                        //'enableAjaxValidation' => true,
                        //'enableClientValidation'=>true,
                        //'action'=>Yii::app()->createAbsoluteUrl('/zakaz/update',array('id'=>$model->id)),
                        'clientOptions'=>array(
                            'validationDelay'=>2000,
                            'validateOnType'=>true,
                        ),
                        //'ajaxType'=>'POST',
                        /*'htmlOptions'=>array(
                            'onkeypress'=>'alert(event.keyCode);'
                        ),*/
                    ));
                    echo $form->errorSummary($model); ?>
                    <div class="col-xs-12 notesBlockArea">
                        <?php echo $form->labelEx($model, 'notes'); ?>
                        <?php echo $form->textArea($model, 'notes', array('rows' => 3, 'class' => 'notesBlockTextarea')); ?>
                    </div>

                    <?php //echo CHtml::submitButton('Сохранить',''); ?>

                    <?php $this->endWidget(); ?>
                </div>
            </div>



            <?php Yii::app()->getClientscript()->registerScriptFile(Yii::app()->theme->baseUrl.'/js/manager.js');?>
          <!-- Начало блока добавления частей менеджера -->
          <?php
            $this->widget('application.modules.project.widgets.zakazParts.ZakazPartWidget', array(
                'projectId'=>$model->id,
            ));
            ?>
            <div class="row zero-edge">
                <div class="col-xs-12 btn btn-primary addPart" onclick="add_part(<?php echo $model->id;?>);"><?=ProjectModule::t('Add part')?></div>
            </div>
            <!-- Конец блока добавления частей менеджера -->
            <!-- Начало блока правок (доработок) менеджера -->
            <?php
            $this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
                'project' => $model,
            ))
            ?>
            <!-- Конец блока правок (доработок) менеджера -->

        </div>

         <!-- Right column -->
        <div class="col-xs-8">
           <div class="row">
                <?php
                    $this->renderPartial('_formUpdateManager', array('model' => $model, 'times' => $times));
                ?>

            </div>
        </div>
