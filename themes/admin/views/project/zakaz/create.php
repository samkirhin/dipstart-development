<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>
<div class="row">
<?php
/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs')=>array('index'),
	ProjectModule::t('Create'),
);  
$this->menu=array(
	array('label'=>ProjectModule::t('List Zakaz'), 'url'=>array('index')),
	array('label'=>ProjectModule::t('Manage Zakaz'), 'url'=>array('admin')),
);
?>

<h1><?=ProjectModule::t('Create Zakaz')?></h1>
<div class="col-md-12 create-zakaz-block">
    <?php
    ?>
    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'zakaz-form',
            //'type' => 'horizontal',
            //'htmlOptions' => array('class' => 'well'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
        )); ?>

        <p class="note"><?=ProjectModule::t('Fields with <span class="required">*</span> are required.')?></p>
		<?php
	if(Campaign::getId()){
		$projectFields = $model->getFields();
		if ($projectFields) {
			foreach($projectFields as $field) {
				echo '<div class="form-group">';
				echo $form->labelEx($model,$field->varname).'<br/>';
				if (isset($field->field_id)){
					$models = Catalog::model()->findAllByAttributes(array('field_id'=>$field->field_id));
					$list = CHtml::listData($models, 'id', 'cat_name');
					echo $form->dropDownList($model, $field->varname, $list, array('empty' => ProjectModule::t('Select a category'),'class'=>'form-control'));
					echo $form->error($model,$field->varname);
				} elseif ($field->field_type=="TEXT") {
					echo$form->textArea($model,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control'));
				} else {
					echo $form->textField($model,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'));
				}
				echo '</div>';
			}
		}
	} else { ?>		
        <div class="row create-form-selects block-with-border">
            <div class="col-md-6" style="padding-left: 0; padding-right: 0;">
                <div class="col-md-12 create-form-selects">
                    <?php echo $form->labelEx($model,'title'); ?>
                    <?php echo $form->textField($model,'title',array('size'=>70,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'title'); ?>
                </div>
                <div class="col-md-12 col-lg-12 create-form-selects">
                    <?php echo $form->labelEx($model,'text'); ?>
                    <?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>70)); ?>
                    <?php echo $form->error($model,'text'); ?>
                </div>
            </div>
            <div class="col-md-6" style="padding-left: 0; padding-right: 0;">
                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'category_id'); ?>
                    <?php $models = Categories::model()->findAll();
                    $list = CHtml::listData($models, 'id', 'cat_name');
                    echo $form->dropDownList($model, 'category_id', $list, array('empty' => ProjectModule::t('Select a category')));
                    ?>
                    <?php echo $form->error($model,'category_id'); ?>
                </div>
                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'job_id'); ?>
                    <?php $models = Jobs::model()->findAll();
                    $list = CHtml::listData($models, 'id', 'job_name');
                    echo $form->dropDownList($model, 'job_id', $list, array('empty' => ProjectModule::t('Select a job')));
                    ?>
                    <?php echo $form->error($model,'job_id'); ?>
                </div>
                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'pages'); ?>
                    <?php echo $form->textField($model,'pages'); ?>
                    <?php echo $form->error($model,'pages'); ?>
                </div>
                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'edu_dep'); ?>
                    <?php echo $form->textField($model,'edu_dep'); ?>
                    <?php echo $form->error($model,'edu_dep'); ?>
                </div>
            </div>
        </div>


        <div class="row create-form-selects block-with-border" style="margin-top: 15px;">
            <div class="col-md-6" style="padding-left: 0; padding-right: 0;">
                <?php echo $form->errorSummary($model); ?>
                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'status');
                    $models = ProjectStatus::model()->findAll();
                    $list = CHtml::listData($models, 'id', 'status');
                    echo $form->dropDownList($model, 'status', $list, array('empty' => ProjectModule::t('Select a status')));?>
                    <?php echo $form->error($model,'status'); ?>
                </div>
                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'user_id');
                    $list = CHtml::listData(User::model()->findAllCustomers(), 'id', 'username');
                    echo $form->dropDownList($model, 'user_id', $list, array('empty' => ProjectModule::t('Select a customer')));
                    ?>
                    <?php echo $form->error($model,'executor'); ?>
                </div>
                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'executor');
                    $list = CHtml::listData(User::model()->findAllAuthors(), 'id', 'username');
                    echo $form->dropDownList($model, 'executor', $list, array('empty' => ProjectModule::t('Select a author')));
                    ?>
                    <?php //echo $form->textField($model,'executor',array('size'=>53,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'executor'); ?>
                </div>
                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'time_for_call'); ?>
                    <?php echo $form->textField($model,'time_for_call'); ?>
                    <?php echo $form->error($model,'time_for_call'); ?>
                </div>
                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'add_demands'); ?>
                    <?php echo $form->textArea($model,'add_demands',array('rows'=>6, 'cols'=>53)); ?>
                    <?php echo $form->error($model,'add_demands'); ?>
                </div>

                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'notes'); ?>
                    <?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>53)); ?>
                    <?php echo $form->error($model,'notes'); ?>
                </div>
                <div class="col-md-12">
                    <?php echo $form->labelEx($model,'author_notes'); ?>
                    <?php echo $form->textArea($model,'author_notes',array('rows'=>6, 'cols'=>53)); ?>
                    <?php echo $form->error($model,'author_notes'); ?>
                </div>
            </div>




            <div class="col-md-6 create-terms">
                <h3>Сроки выполнения </h3>
                <table class="table" style="font-size: 12px">
                    <thead>
                    <th>Наименование</th>
                    <th>Дата Время</th>
                    </thead>
                    <tr>
                        <td>
                            <?php echo $form->labelEx($model,'date'); ?>
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
                            <?php echo $form->labelEx($model,'max_exec_date'); ?>
                        </td>
                        <td>
                            <?php
                            $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                                'model' => $model,
                                'attribute' => 'dbmax_exec_date',
                                'options'=>array(
                                    'onSelect'=> "js: function(dateText,inst){
                                        var date=new Date(dateText.replace(/(\d+).(\d+).(\d+)( \d+:\d+)/, '$3/$2/$1'));
                                        var dnow=new Date;
                                        dnow.setHours(date.getHours());
                                        dnow.getMinutes(date.getMinutes());
                                        dnow.getSeconds(date.getSeconds());
                                        date.setDate(dnow.getDate()+Math.ceil((date-dnow)/2000/3600/24));
                                        $('#Zakaz_dbauthor_informed').datetimepicker('setDate',date);
                                    }"
                                ),
                            ));?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->labelEx($model,'date_finish');?>
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
                            <?php echo $form->labelEx($model,'manager_informed'); ?>
                        </td>
                        <td>
                            <?php
                            $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                                'model' => $model,
                                'attribute' => 'dbmanager_informed',
                            ));?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->labelEx($model,'author_informed'); ?>
                        </td>
                        <td>
                            <?php
                            $this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
                                'model' => $model,
                                'attribute' => 'dbauthor_informed',
                            ));?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
		<?php } ?>
        <div class="row" style="float: right; margin: 15px 0 0 0; ">
            <?php echo CHtml::submitButton($model->isNewRecord ? ProjectModule::t('Create') : ProjectModule::t('Save'), array ('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>
</div>