<?php
/* @var $this ZakazController */
/* @var $model Zakaz */

$user = User::model();
$this->breadcrumbs = array(
    ProjectModule::t('Zakazs') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    ProjectModule::t('Update'),
);
?>

    <h1><?= ProjectModule::t('Update Zakaz') ?> <?php echo $model->id; ?></h1>
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
<table class="table table-bordered" style="table-layout: fixed; width:100%; border:2px">
    <tr>
        <td rowspan="2" style="width:20%">
            <?php echo $form->labelEx($model,'user_id');
                        $list = CHtml::listData(User::model()->findAllCustomers(), 'id', 'username');
                        echo $form->dropDownList($model, 'user_id', $list, array('empty' => ProjectModule::t('Select a customer')));
                    ?>
            <?php echo $form->error($model,'executor'); ?>
            
            <?php echo $form->labelEx($model,'executor');
                        $list = CHtml::listData(User::model()->findAllAuthors(), 'id', 'username');
                        echo $form->dropDownList($model, 'executor', $list, array('empty' => ProjectModule::t('Select a author')));
                    ?>
                    <?php //echo $form->textField($model,'executor',array('size'=>53,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'executor'); ?>
            
            <?php echo $form->labelEx($model,'category_id'); ?>
                    <?php $models = Categories::model()->findAll();
                        $list = CHtml::listData($models, 'id', 'cat_name');
                        echo $form->dropDownList($model, 'category_id', $list, array('empty' => ProjectModule::t('Select a category')));
                    ?>
            <?php echo $form->error($model,'category_id'); ?>
            
            <?php echo $form->labelEx($model,'job_id'); ?>
                    <?php $models = Jobs::model()->findAll();
                        $list = CHtml::listData($models, 'id', 'job_name');
                        echo $form->dropDownList($model, 'job_id', $list, array('empty' => ProjectModule::t('Select a job')));
                    ?>
            <?php echo $form->error($model,'job_id'); ?>
            
            <?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>20,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title'); ?>
            
            <?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>8, 'cols'=>20)); ?>
            <?php echo $form->error($model,'text'); ?>
        </td>
        <td colspan="2" width="50%">
            <?php
                $this->widget('application.modules.project.widgets.payment.PaymentWidget', array(
                    'projectId'=>$model->id
                ));
            ?>
        </td>
        <td rowspan="2" width="30%">
            11
        </td>
    </tr>
    <tr>
        <td colspan="2">
            5
        </td>
    </tr>
    <tr>
        <td rowspan="2" style="width:20%">
            10
        </td>
        <td colspan="2" width="50%">
            6
        </td>
        <td  width="30%">
            8
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?php
                $this->widget('application.modules.project.widgets.changes.ChangesWidget', array(
                    'project' => $model,
                ));
            ?>
        </td>
        <td>
            ???
        </td>
    </tr>

</table>
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? ProjectModule::t('Create') : ProjectModule::t('Save')); ?>
        </div>
<?php $this->endWidget(); ?>