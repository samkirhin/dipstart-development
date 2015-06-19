
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
    <h1><?= ProjectModule::t('Update Zakaz') ?> <?php echo $model->id; ?></h1>
    
    <div class="row order-contacts">
        <?php if ($author): ?>
        <div class="col-xs-6 rightBorder">
            <div class="authorText"><b><a href="<?php echo Yii::app()->createUrl('/user/admin/update',array('id'=>$author->id));?>">Автор</a></b></div>
            <div class="authorName"><p><?= $author->profile->firstname ?> <?= $author->profile->lastname ?></p></div>
            <div class="authorMail"><p><?= $author->email ?></p></div>
            <div class="authorPhone"><p><?= $author->profile->mob_tel ?></p></div>
        </div>
        <?php endif; ?>
        <div class="col-xs-6">
            <div class="customerText"><b><a href="<?php echo Yii::app()->createUrl('/user/admin/update',array('id'=>$customer->id));?>">Заказчик</a></b></div>
            <div class="customerName"><p><?= $customer->profile->firstname ?> <?= $customer->profile->lastname ?></p></div>
            <div class="customerMail"><p><?= $customer->email ?></p></div>
            <div class="customerPhone"><p><?= $customer->profile->mob_tel ?></p></div>
        </div>
    </div>
    
    <div class="row">
       <!-- Left column -->
       
        <div class="col-xs-4 left-column">
            <div class="row zero-edge">
               <div class="col-xs-12 statusBlock">
                   <?php if ($isModified) echo '<span class="label label-warning" style="font-size:16px;"><b>Заказ на модерации</b></span>';?>
                   <span class="label label-warning"><b><?= $message; ?></b></span>
                   <button id="close_order" class="btn" onclick="js: window.location='<?php echo $this->createUrl('',array('id'=>$model->id,'close'=>'yes'));?>';">Завершить заказ</button>
               </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <h4>Примечания (по всему заказу)</h4>

                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'zakaz-form',
                        'enableAjaxValidation' => true,
                        'enableClientValidation'=>true,
                        'action'=>Yii::app()->createUrl('zakaz/update'),
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
                    <div class="col-xs-12 notesBlockArea">
                        <?php echo $form->labelEx($model, 'author_notes'); ?>
                        <?php echo $form->textArea($model, 'author_notes', array('rows' => 3, 'class' => 'notesBlockTextarea')); ?>
                    </div>
                    <?php echo CHtml::ajaxSubmitButton('Save',''); ?>

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
                <div class="col-xs-12 btn btn-primary addPart" onclick="add_part(<?php echo $model->id;?>);">Добавить часть</div>
            </div>
            <!-- Конец блока добавления частей менеджера -->
            <!-- Начало блока правок частей менеджера -->
            <h4><?php echo ProjectModule::t('Changes'); ?></h4>
            <?php
            $this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
                'project' => $model,
            ))
            ?>
            <!-- Конец блока правок частей менеджера -->
        </div>
    
         <!-- Right column -->
        <div class="col-xs-8">
           <div class="row">
                <?php
                    $this->renderPartial('_formUpdateManager', array('model' => $model, 'times' => $times));
                ?>
            </div>
        </div>
      