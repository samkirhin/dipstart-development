
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
    <div class="row">
        <?php
        //$this->renderPartial('_order_list_update');
        ?>
    </div>
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
                    <button class="btn btn-primary" onclick="spam(<?php echo $model->id; ?>);" href="">Spam</button>
                </div>
                <div class="col-xs-12">
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
                    <?php echo CHtml::submitButton('Save',''); ?>

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
            <div class="row zero-edge">
                <?php
                echo CHtml::form('', 'post', array('id' => 'up_file', 'enctype' => 'multipart/form-data'));
                ?>
                <div class="col-xs-12">
                    <?php echo CHtml::label('Прикрепить файл', 'fileupload'); ?>
                    <?php echo CHtml::fileField('ProjectChanges[fileupload]', $fileupload, array('class' => 'col-xs-12 btn btn-user')); ?>
                </div>

                <div class="col-xs-12">
                    <?php echo CHtml::label('Комментарий', 'comment'); ?>
                    <?php echo CHtml::textArea('ProjectChanges[comment]', $comment, array('class' => 'col-xs-12')); ?>
                </div>
                <?php echo CHtml::endForm(); ?>
                <?php
                $url = Yii::app()->createUrl("/project/changes/add",array('project'=>$project->id));
                echo CHtml::htmlButton(ProjectModule::t('Add changes'), array(
                    'class' => 'col-xs-12 btn btn-primary addPart',
                    'onclick' => "javascript: send('$url')",
                ));?>
            </div>
            <!-- Конец блока правок частей менеджера -->
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id' => 'justFileUpload',
                    'postParams' => array(
                        'id' => $model->id,
                    ),
                    'config' => array(
                        'action' => $this->createUrl('/project/chat/upload',array('id'=>$model->id)),
                        'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                        'disAllowedExtensions'=>array('exe'),
                        'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                        'minSizeLimit' => 10,// minimum file size in bytes
                        'onComplete' => "js:function(id, fileName, responseJSON){}"
                    )
                )
            );
            $path=Yii::getPathOfAlias('webroot').'/uploads/'.$model->id.'/';
            if (file_exists($path)) {
                foreach (array_diff(scandir($path), array('..', '.')) as $k => $v) {
                    echo str_replace('#pre#', '', $v) . '<br />';
                    if (strstr($v, '#pre#'))
                        echo '<button id="approveFile_file" data-id="' . $model->id . '" data-name="' . $v . '" class="right btn" onclick="approveFile(this)">Approve</button>';
                }
            }
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
      