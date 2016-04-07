<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $profile Profile */
/* @var $author User */
/* @var $customer User */

$user = User::model();
$author = $model->author;
$customer = $model->user;

?>

<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>
    <h1><?= ProjectModule::t('Update Zakaz') ?> <span id="order_number"><?php echo $model->id; ?></span>
			<?php if ($model->status < 5) { ?>
				<button id="close_order" class="btn btn-change-status" onclick="js: window.location='<?php echo $this->createUrl('',array('id'=>$model->id,'close'=>'yes'));?>'; send_message(17,'Заказчику о завершении заказа');"><?=ProjectModule::t('Complete the order')?></button>
				<button id="refound_order" class="btn btn-change-status" onclick="js: window.location='<?php echo $this->createUrl('',array('id'=>$model->id,'refound'=>'yes'));?>';"><?=ProjectModule::t('Refound and close order')?></button>
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
                                <div class="form-container">

                                    <?php $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'zakaz-form',
                                        'enableAjaxValidation' => false,
                                    ));
                                    echo $form->errorSummary($model); ?>

									<div class="form-item notesBlockArea">
										<?php echo $form->labelEx($model, 'author_notes'); ?>
										<?php echo $form->textArea($model, 'author_notes', array('rows' => 3, 'class' => 'notesBlockTextarea')); ?>
									</div>

									<div class="form-item">
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
											$tmp .= '<li><a class="link-to-material" href="' . $url . rawurlencode($v) . '">' . str_replace('#pre#', '', $v) . '</a>';
											$tmp .= '<a href="#" data-id="' . $model->id . '" data-name="' . $v . '" onclick="removeFile(this); return false;"><i class="glyphicon glyphicon-remove" title="'. Yii::t('site', 'Delete') .'"></i></a>'; #remove file btn
											if (strstr($v, '#pre#'))
												$tmp .= '<button id="approveFile_file" data-id="' . $model->id . '" data-name="' . $v . '" class="right btn" onclick="approveFile(this); return false;">'. ProjectModule::t('Approve') .'</button>';
											$tmp .= '</li>';
										}
									}

									$this->widget('ext.EAjaxUpload.EAjaxUpload',
										array(
											'id' => 'justFileUpload',
											'config' => array(
												'action' => $this->createUrl('/project/zakaz/upload',array('id'=>$model->id)),
												'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>'. ProjectModule::t('Drag and drop files here') .'</span><div class="qq-upload-button">'. ProjectModule::t('Upload material') .'</div><ul class="qq-upload-list">'.$tmp.'</ul></div></div>',
												'disAllowedExtensions'=>array('exe','scr'),
												'sizeLimit' => Tools::maxFileSize(), // maximum file size in bytes
												'minSizeLimit' => 1,// minimum file size in bytes
												'onComplete' => "js:function(id, fileName, responseJSON){}"
											)
										)
									);
									?>
									</div>
									<?php $this->renderPartial('_form', array('model' => $model, 'form' => $form)); ?>

									

									<div class="form-item">
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
											<?php
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
											?>
										</table>
									</div>
                                    <div class="form-save">
										<?php echo CHtml::submitButton(ProjectModule::t('Save'), array('class' => 'btn btn-primary')); ?>
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
            <div class="authorText"><b><a href="<?php echo Yii::app()->createUrl('/user/admin/view',array('id'=>$author->id));?>"><?=ProjectModule::t('Author')?></a></b></div>
            <?php if ($author->full_name) { ?><div class="authorName"><p><?= $author->full_name ?></p></div><?php } ?>
            <div class="authorMail"><p class="author-mail-icon"></p><p><?= $author->email ?></p></div>
            <?php if ($author->phone_number) { ?><div class="authorPhone"><p class="author-phone-icon"></p><p><?= $author->phone_number ?></p></div><?php } ?>
        </div>
        <?php endif; ?>
        <div class="col-lg-6 col-xs-7 leftBorder">
            <div class="customerText"><b><a href="<?php echo Yii::app()->createUrl('/user/admin/view',array('id'=>$customer->id));?>"><?=ProjectModule::t('Customer')?></a></b></div>
            <?php if ($customer->full_name) { ?><div class="customerName"><p><?= $customer->full_name ?></p></div><?php } ?>
            <div class="customerMail"><p class="customer-mail-icon"></p><p><?= $customer->email ?></p></div>
            <?php if ($customer->phone_number) { ?><div class="customerPhone"><p class="customer-phone-icon"></p><p><?= $customer->phone_number ?></p></div><?php } ?>
        </div>
    </div>

    <div class="row">
       <!-- Left column -->

        <div class="col-xs-4 left-column">
            <div class="row zero-edge">
               <div class="col-xs-12 statusBlock">
                   <!--<span class="label label-warning"><b><?php //echo $message; ?></b></span>-->
				   <?=CHtml::dropDownList('Zakaz_status', $model->status, CHtml::listData(ProjectStatus::model()->findAll(), 'id', 'status'),
                            array('ajax' => array('url' => $this->createUrl('/project/zakaz/update'),
                                                  'data' => 'js:"id='.$model->id.'&sid="+this.value',
                                                  'cache' => false,
                                                  ),)); ?>
				   <button class="btn btn-primary btn-spam" onclick="spam(<?php echo $model->id; ?>);" href=""><?=ProjectModule::t('Search author')?></button>
					<!-- Тут была кнопка открыть или закрыть заказ -->
               </div>
			   <div class="col-xs-12 linkToAuthors">
					<?='http://'.$_SERVER["HTTP_HOST"].Yii::app()->createUrl('/project/chat/view',array('orderId'=>$model->id));?>
			   </div>
            </div>
            <?php if ($isModified) echo '<span><b>'. ProjectModule::t('Order moderation') .'</b></span>';?>

            <div class="row">
                <div class="col-xs-12">
					       <!-- Тут была кнопка рассылки -->
                </div>
                <div class="col-xs-12 notes">
                    <h4><?=ProjectModule::t('Notes (on all orders)')?></h4>

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
                <div class="col-xs-12 btn btn-primary addPart" onclick="add_part(<?php echo $model->id;?>,'<?=ProjectModule::t('New part')?>');"><?=ProjectModule::t('Add part')?></div>
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
	</div>