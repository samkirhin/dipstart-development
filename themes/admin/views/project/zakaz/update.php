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
    <h1><?= ProjectModule::t('Update Zakaz') ?> <span id="order_number"><?php echo $model->id; ?></span></h1>
    <div class="row">
        <?php
        //$this->renderPartial('_order_list_update');
        ?>
    </div>
    <div class="row order-contacts">
        <?php if ($author): ?>
        <div class="col-lg-6 col-xs-6 rightBorder">
            <div class="authorText"><b><a href="<?php echo Yii::app()->createUrl('/user/admin/update',array('id'=>$author->id));?>">Автор</a></b></div>
            <div class="authorName"><p><?= $author->profile->firstname ?> <?= $author->profile->lastname ?></p></div>
            <div class="authorMail"><p><?= $author->email ?></p></div>
            <div class="authorPhone"><p><?= $author->profile->mob_tel ?></p></div>
        </div>
        <?php endif; ?>
        <div class="col-lg-6 col-xs-7">
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
                    <button class="btn btn-primary" onclick="spam(<?php echo $model->id; ?>);" href="">Рассылка</button>
                </div>
                <div class="col-xs-12 notes">
                    <h4>Примечания (по всему заказу)</h4>

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
                    <div class="col-xs-12 notesBlockArea">
                        <?php echo $form->labelEx($model, 'author_notes'); ?>
                        <?php echo $form->textArea($model, 'author_notes', array('rows' => 3, 'class' => 'notesBlockTextarea')); ?>
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
                <div class="col-xs-12 btn btn-primary addPart" onclick="add_part(<?php echo $model->id;?>);">Добавить часть</div>
            </div>
            <!-- Конец блока добавления частей менеджера -->
            <!-- Начало блока правок частей менеджера -->
            <?php
            $this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
                'project' => $model,
            ))
            ?>
            <!-- Конец блока правок частей менеджера -->
            <?php
			$url = '/uploads/'.$model->id.'/';
            $path = Yii::getPathOfAlias('webroot').$url;
			$tmp = '';
            if (file_exists($path)) {
                foreach (array_diff(scandir($path), array('..', '.')) as $k => $v) {
                    $tmp .= '<li><a class="link-to-material" href="' . $url . $v . '">' . str_replace('#pre#', '', $v) . '</a>';
                    if (strstr($v, '#pre#'))
                        $tmp .= '<button id="approveFile_file" data-id="' . $model->id . '" data-name="' . $v . '" class="right btn" onclick="approveFile(this)">Одобрить</button>';
					$tmp .= '</li>';
                }
            }
			
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id' => 'justFileUpload',
                    'postParams' => array(
                        'id' => $model->id,
                    ),
                    'config' => array(
                        'action' => $this->createUrl('/project/chat/upload',array('id'=>$model->id)),
                        'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Перетащите файлы сюда</span><div class="qq-upload-button">Загрузить материал</div><ul class="qq-upload-list">'.$tmp.'</ul></div></div>',
                        'disAllowedExtensions'=>array('exe'),
                        'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                        'minSizeLimit' => 10,// minimum file size in bytes
                        'onComplete' => "js:function(id, fileName, responseJSON){}"
                    )
                )
            );
            ?>
        </div>
    
         <!-- Right column -->
        <div class="col-xs-8">
           <div class="row">
                <?php
                    $this->renderPartial('_formUpdateManager', array('model' => $model, 'times' => $times));
                ?>
				
            </div>
        </div>
      