<?php
$this->redirect(Yii::app()->createUrl('/project/zakaz/update', array('id'=>$model->id)));

//Don't work...

/* @var $this ZakazController */
/* @var $model Zakaz */
/* oldbadger 02.11.2015
$filelist = Yii::app()->fileman->list_files($model->id);
foreach ($filelist as $fd) {
  $real_path = Yii::app()->fileman->get_file_path($fd['id'], $fd['file_id']);
  $files .= CHtml::link($fd['filename'], array('zakaz/download', 'path' => $real_path)).'&nbsp;&nbsp;';
  //echo EDownloadHelper::download($real_path);
}
*/
	$this->breadcrumbs=array(
		ProjectModule::t('Zakazs')=>array('index'),
		$model->title,
	);

?>

<h1><?=ProjectModule::t('View Zakaz')?> #<?php echo $model->id; ?></h1>
<?php 
	if (User::model()->isManager() || User::model()->isAdmin()){
		$attr = array(
			'id',
			array(
				'name' => 'user_id',
				'type' => 'raw',
				'value' => User::model()->findByPk($model->user_id)->username,
			),
			'title',
			'max_exec_date',
			array(
				'name' => 'status',
				'type' => 'raw',
				'value' => $model->status > 0 ? ProjectStatus::model()->findByPk($model->status)->status : null,
			),
			'notes',
		);
	}else{
		$attr = array(
			'id',
			array(
				'name' => 'user_id',
				'type' => 'raw',
				'value' => User::model()->findByPk($model->user_id)->username,
			),
			'title',
			'text',
			'date',
			'max_exec_date',
			//'date_finish',
			'pages',
			'add_demands',
			array(
				'name' => 'status',
				'type' => 'raw',
				'value' => $model->status > 0 ? ProjectStatus::model()->findByPk($model->status)->status : null,
			),
//'is_payed',
//'informed',
//'notes',
		);
	}
	//$this->widget('zii.widgets.CDetailView', array(
	//	'data'=>$model,
	//	'attributes'=>$attr,
	//));
/*	
echo '<pre>';
print_r($projectFields);
echo '</pre>';
*/

	$projectFields = $model->getFields();
	if ($projectFields) {
		
		/*$form = $this->beginWidget('CActiveForm', array(
			'id'=>'zakaz-form',
			'action'=>isset ($model->id) ? $this->createUrl('zakaz/update', ['id'=>$model->id]) : '',
			'enableAjaxValidation'=>false,
		));*/
		
		foreach($projectFields as $field) {
			if ($field->field_type=="BOOL"){
//				echo $form->ActiveCheckBox($model,$field->varname);
			} elseif ($field->field_type=="LIST"){
				echo '<div class="form-item">';
				echo $form->labelEx($model,$field->varname).'<br/>';
				$models = Catalog::model()->findAllByAttributes(array('field_varname'=>$field->varname));
				$list = CHtml::listData($models, 'id', 'cat_name');
				echo $form->dropDownList($model, $field->varname, $list, array('empty' => ProjectModule::t('Select a category'),'class'=>'form-control'));
				echo $form->error($model,$field->varname);
				echo '</div>';
			} elseif ($field->field_type=="TIMESTAMP" || $field->field_type=="DATE") {
		?>
				<div class="form-item" style="position: relative; float: left; width: 100%;">
				<label style="position: relative; float: left; width: 100px;"><?php echo $form->labelEx($model,$field->varname);?></label>
		<?php
				$this->widget('ext.juidatetimepicker.EJuiDateTimePicker', array(
					'model' => $model,
					'attribute' => $field->varname,
				));?>
				</div><?php
			} elseif ($field->field_type=="TEXT") {
				echo '<div class="form-item">';
				echo $form->labelEx($model,$field->varname).'<br/>';
				echo$form->textArea($model,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control'));
				echo '</div>';
			} else {
				echo '<div class="form-item">';
				echo $form->labelEx($model,$field->varname).'<br/>';
				echo $form->textField($model,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'));
				echo '</div>';
			}
		}
	}
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attr,
	));
	
/*
$this->widget('application.modules.project.widgets.zakazParts.ZakazPartWidget', array(
'projectId'=>$model->id,
'userType'=>'1',
'action'=>'show'
));
*/
