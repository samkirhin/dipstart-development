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
				<button id="close_order" class="btn btn-change-status" onclick="js: window.location='<?php echo $this->createUrl('',array('id'=>$model->id,'close'=>'yes'));?>'; send_message(17,'Заказчику о завершении заказа');"><?=ProjectModule::t('Complete the order')?></button>
			<?php } else { ?>
				<button id="open_order" class="btn btn-change-status" onclick="js: window.location='<?php echo $this->createUrl('',array('id'=>$model->id,'open'=>'yes'));?>';"><?=ProjectModule::t('Open order')?></button>
			<?php } ?>
	</h1>
    <div class="row">
        <?php
        //$this->renderPartial('_order_list_update');
        ?>
    </div>
    
    <div class="row">
        <div class="col-xs-12 info-block">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-white">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#infoZakaz">
                                <?=ProjectModule::t('Order information').' '.$model->id.': "'.$model->title.'"'?> <i class="fa fa-angle-down fa-lg"></i>

                            </a>
                            <br/><!--<a data-toggle="collapse" data-parent="#accordion" href="#infoZakaz">-->
                            <!--<img onclick="this.style.transform+='rotate(180deg)'" src="http://crm.obshya.com/themes/admin/views/project/zakaz/line_2.jpg" id="str" />-->
                            <!--</a>-->
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
                                        <div class="notesBlockArea">
                                            <?php echo $form->labelEx($model, 'author_notes'); ?>
                                            <?php echo $form->textArea($model, 'author_notes', array('rows' => 3, 'class' => 'notesBlockTextarea')); ?>
                                        </div>

                                        <?php
                                        // --- campaign
                                        if(isset(Zakaz::$files_folder)){
                                            $url = Zakaz::$files_folder.$model->id.'/';
                                        } else {
                                            $url = '/uploads/'.$model->id.'/';
                                        }
                                        // ---
                                        $path = Yii::getPathOfAlias('webroot').$url;
                                        $tmp = '';
                                        if (file_exists($path)) {
                                            foreach (array_diff(scandir($path), array('..', '.')) as $k => $v) {
                                                $tmp .= '<li><a class="link-to-material" href="' . $url . $v . '">' . str_replace('#pre#', '', $v) . '</a>';
                                                $tmp .= '<a href="#" data-id="' . $model->id . '" data-name="' . $v . '" onclick="removeFile(this); return false;"><i class="glyphicon glyphicon-remove" title="'. Yii::t('site', 'Delete') .'"></i></a>'; #remove file btn
                                                if (strstr($v, '#pre#'))
                                                    $tmp .= '<button id="approveFile_file" data-id="' . $model->id . '" data-name="' . $v . '" class="right btn" onclick="approveFile(this)">'. ProjectModule::t('Approve') .'</button>';
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
                                                    'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>'. ProjectModule::t('Drag and drop files here') .'</span><div class="qq-upload-button">'. ProjectModule::t('Upload material') .'</div><ul class="qq-upload-list">'.$tmp.'</ul></div></div>',
                                                    'disAllowedExtensions'=>array('exe'),
                                                    'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
                                                    'minSizeLimit' => 10,// minimum file size in bytes
                                                    'onComplete' => "js:function(id, fileName, responseJSON){}"
                                                )
                                            )
                                        );
                                        ?>

                                        <?php
                                        if (!Campaign::getId()){
                                        echo $form->labelEx($model, 'category_id');
                                        $models = Categories::model()->findAll();
                                        $list = CHtml::listData($models, 'id', 'cat_name');
                                        echo $form->dropDownList($model, 'category_id', $list, array('empty' => ProjectModule::t('Select a category')));
                                        echo $form->error($model, 'category_id');
                                        echo '<br>';
                                        echo $form->labelEx($model, 'job_id');
                                        $models = Jobs::model()->findAll();
                                        $list = CHtml::listData($models, 'id', 'job_name');
                                        echo $form->dropDownList($model, 'job_id', $list, array('empty' => ProjectModule::t('Select a job')));
                                        echo $form->error($model, 'job_id');
                                        echo '<br>';
                                        echo $form->labelEx($model, 'title');
                                        echo $form->textField($model, 'title', array('size' => 70, 'maxlength' => 255));
                                        echo $form->error($model, 'title');
                                        echo '<br>';
                                        echo $form->labelEx($model, 'text');
                                        echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 70));
                                        echo $form->error($model, 'text'); 
                                        } else {
                                            $projectFields = $model->getFields();
                                            if ($projectFields) {
                                                foreach($projectFields as $field) {
                                                    echo '<div class="form-group">';
                                                    echo $form->labelEx($model,$field->varname).'<br/>';
                                                    if ($field->field_type=="LIST"){
                                                        $models = Catalog::model()->findAllByAttributes(array('field_varname'=>$field->varname));
                                                        $list = CHtml::listData($models, 'id', 'cat_name');
                                                        echo $form->dropDownList($model, $field->varname, $list, array('empty' => ProjectModule::t('Select a category'),'class'=>'form-control'));
                                                        echo $form->error($model,$field->varname);
                                                    } elseif ($field->field_type=="TEXT") {
                                                        echo $form->textArea($model,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control'));
                                                    } elseif ($field->field_type!="TIMESTAMP") {
                                                        echo $form->textField($model,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'));
                                                    }
                                                    echo '</div>';
                                                }
                                            }
                                        }
                                        ?>
                                        <h3> <?=ProjectModule::t('Deadlines')?> </h3>

                                        <table class="table table-striped" style="font-size: 12px;">
                                            <thead>
                                            <th><?=ProjectModule::t('Product name')?></th>
                                            <th><?=ProjectModule::t('Date/Time')?></th>
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
                                            <?php if (!Campaign::getId()){ ?>
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
                                            </tr><?php
                                            } else {
                                                $projectFields = $model->getFields();
                                                if ($projectFields) foreach($projectFields as $field) {
                                                    if ($field->field_type=="TIMESTAMP") {
                                                    $varname = $field->varname;
                                                    $model->timestampOutput($field);
                                            ?><tr>
                                                <td>
                                                    <?php echo $form->labelEx($model, $varname); ?>
                                                </td>
                                                <td><?php
                                                        $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                                                            'model' => $model,
                                                            'attribute' => $varname,
                                                        ));?>
                                                </td>
                                            </tr><?php
                                                    }
                                                }
                                            } ?>
                                        </table>
                                        <?php if (!Campaign::getId()){ ?>
                                        <?php echo $form->labelEx($model, 'time_for_call'); ?><br>
                                        <?php echo $form->textField($model, 'time_for_call'); ?>
                                        <?php echo $form->error($model, 'time_for_call'); ?>
                                        <br>
                                        <?php echo $form->labelEx($model, 'edu_dep'); ?><br>
                                        <?php echo $form->textField($model, 'edu_dep'); ?>
                                        <?php echo $form->error($model, 'edu_dep'); ?>
                                        <?php } ?>
                                    </div>
                                    <?php if (!Campaign::getId()){ ?>
                                    <div class="col-xs-6 info-column">

                                        <?php echo $form->labelEx($model, 'add_demands'); ?><br>
                                        <?php echo $form->textArea($model, 'add_demands', array('rows' => 6, 'cols' => 53)); ?>
                                        <?php echo $form->error($model, 'add_demands'); ?>
                                    </div>
                                    <?php } ?>
                                    <div class="col-xs-12 info-buttons">
									<?php $attr = array('class' => 'btn btn-primary'); ?>
									<?php if(Yii::app()->user->isGuest) $attr['disabled'] = 'disabled'; ?>
                                        <div>
										<?php echo CHtml::submitButton(ProjectModule::t('Save'), $attr); ?>
										</div>
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
