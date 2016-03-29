<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 20.08.15
 * Time: 2:19
 */
Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl.'/js/manager.js');
?>

<script type="text/javascript">
$(document).ready(function () {
	$('#extremum-in').click(function() {
		$('#in').show();
		$('#out').hide();		
	});
	$('#extremum-out').click(function(){
		$('#in').hide();
		$('#out').show();
	});
});
</script>

<a href="#" id="extremum-in">Входящие</a>
<br>
<a href="#" id="extremum-out">Исходящие</a>

<div id="in">
	<h3>Входящие</h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'buh_transaction_in',
		'dataProvider' => $model->search('0'),
		'filter'=>$model,
		'columns'=>array(
			array(
				'name' => 'order_id',
				'type' => 'raw',
				'value'=>function($data) {
					return CHtml::link($data->order_id,array('zakaz/update','id'=>$data->order_id));
				}
			),
			array(
				'name' => 'receive_date',
				'value' => function($data) {
					if($data->receive_date) return date("d.m.Y", strtotime($data->receive_date));
				},
			),
			array(
				'name' => 'pay_date',
				'value' => function($data) {
					if($data->pay_date) return date("d.m.Y H:i:s", strtotime($data->pay_date));
				},
			),
			array(
				'name' => 'zakaz.title',
			),
			array(
				'header' => 'Спец',
				'name' => 'zakaz.catalog_specials.cat_name',
			),
			array(
				'header' => 'Спец2',
				'value' => function($data) {			
					//$columns = Yii::app()->db->createCommand("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . Company::getId() . "_projects'")->queryRow();
					$specials2 = false;
					$projectFields = Zakaz::model()->getFields();
					foreach($projectFields as $field) {
						if($field->varname == 'specials2') $specials2 = true;
					}
					if ($specials2) {
						if (isset($data->zakaz->catalog_specials2)) return $data->zakaz->catalog_specials2->cat_name;
					} else return false;
				}
			),
			array(
				'name' => 'manager',
				'type' => 'raw',
				'value'=>function($data) {
					return CHtml::link($data->manager,array('/user/admin/view','id'=>$data->profileManager->id));
				}
			),
			array(
				'name' => 'user',
				'type' => 'raw',
				'value'=>function($data) {
					return CHtml::link($data->user,array('/user/admin/view','id'=>$data->profileUser->id));
				}
			),
			/*array(
				'name' => 'profileUser.AuthAssignment.AuthItem.description',
			),*/
			'summ',
			array(
				'header' => Yii::t('site','Payment method'),
				'type' => 'raw',
				'value'=>function($data) {
					$payFields = ProfileField::model()->findAllByAttributes(array('paymentProps' => '1'));
					$payFieldsUser = $data->profileUser;

					foreach ($payFields as $field) {
						$fields[] = $field->varname;
						$final[$field->varname] = $field->title;
					}
					$fields = implode($fields, ',');
					
					$userPayFields = Profile::model()->find(array('select' => $fields, 'condition' => 'user_id = :user', 'params' => array(':user' => $data->profileUser->id)));
					
					$fields = array();
					if(!empty($userPayFields))
						foreach ($userPayFields as $key => $field)
							if ($field != null) $fields[$key] = $final[$key];
					
					$model = Company::model()->findByPk(Company::getId());
					if ($model !== null && $model->PaymentCash == '1') $fields['cash'] = 'Наличные';
				
					return CHtml::dropDownList('paymentType_' . $data->id, $data->details_type, $fields,
						array(
							'empty' => '',
							'disabled' => in_array($data->approve, array('0','1')) == 1 ? true : false,
							'ajax' => array(
								'url'=> PaymentController::createUrl('getPayNumber'),
								'data' => array(
									'payType' => 'js:this.value',
									'user' => $data->profileUser->id,
								),
								'success' => 'function(html) {
									if (html != "") $("#payDetailNumber_' . $data->id . '").val(html);
									else $("#payDetailNumber_' . $data->id . '").val("");
								}',
							),
						)
					);
				}
			),
			array(
				'name' => 'details_number',
				'type' => 'raw',
				'value'=>function($data) {
					return CHtml::textField("payDetailNumber_{$data->id}", $data->details_number, array('disabled' => in_array($data->approve, array('0','1')) == 1 ? true : false));
				}
			),
			array(
				'class' => 'CButtonColumn',
				'template'=> '{approved} {reject} {for_reject} {for_approve} ',
				'buttons' => array(
					'for_approve' => array(
						'label' => Yii::t('site','Confirm'),
						'options' => array("class"=>"btn btn-primary btn-xs approve_payment"),
						'visible' => '$data->approve == 2',
						'click' =>'function(){setApprove($(this).attr("href"),$("#paymentType_"+$(this).attr("href")).val(),$("#payDetailNumber_"+$(this).attr("href")).val());return false;}', // manager.js
						'url'=>'$data->id',
					),
					'for_reject' => array(
						'label' => Yii::t('site','Reject'),
						'options' => array("class"=>"btn btn-primary btn-xs reject_payment"),
						'visible' => '$data->approve == 2',
						'click' => 'function(){setReject($(this).attr("href"));return false;}', 
						'url'=>'$data->id',
					),
					'approved' => array(
						'label' => Yii::t('site','Confirmed'),
						'visible' => '$data->approve == 1',
					),
					'reject' => array(
						'label' => Yii::t('site','Rejected'),
						'visible' => '$data->approve == 0',
					),
				),
			),
			array(
				'header' => 'Отменить платеж',
				'class' => 'CButtonColumn',
				'template'=> '{cancel}',
				'buttons' => array(
					'cancel' => array(
						'label' => Yii::t('site','Cancel'),
						'options' => array("class"=>"btn btn-primary btn-xs cancel_payment"),
						'visible' => 'in_array($data->approve, array(0, 1))',
						'click' => 'function(){cancelPayment($(this).attr("href"));return false;}', // manager.js
						'url'=>'$data->id',
					),
				),
			),
		),
	));
	?>
	Количество: <b><?= $data['in']['count'] ?></b>
	<br>
	Сумма: <b><?= $data['in']['sum'] ?>&nbsp;р.</b>
	
</div>

<div id="out" style="display: none;">
	<h3>Исходящие</h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'buh_transaction_out',
		'dataProvider' => $model->search('1,2,3'),
		'filter'=>$model,
		'columns'=>array(
			array(
				'name' => 'order_id',
				'type' => 'raw',
				'value'=>function($data) {
					return CHtml::link($data->order_id,array('zakaz/update','id'=>$data->order_id));
				}
			),
			array(
				'name' => 'receive_date',
				'value' => function($data) {
					if($data->receive_date) return date("d.m.Y", strtotime($data->receive_date));
				},
			),
			array(
				'name' => 'pay_date',
				'value' => function($data) {
					if($data->pay_date) return date("d.m.Y H:i:s", strtotime($data->pay_date));
				},
			),
			array(
				'name' => 'zakaz.title',
			),
			array(
				'header' => 'Спец',
				'name' => 'zakaz.catalog_spec1.cat_name',
			),
			array(
				'header' => 'Спец2',
				'value' => function($data) {			
					//$columns = Yii::app()->db->createCommand("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . Company::getId() . "_projects'")->queryRow();
					$specials2 = false;
					$projectFields = Zakaz::model()->getFields();
					foreach($projectFields as $field) {
						if($field->varname == 'specials2') $specials2 = true;
					}
					if ($specials2) {
						if (isset($data->zakaz->catalog_specials2)) return $data->zakaz->catalog_specials2->cat_name;
					} else return false;
				}
			),
			array(
				'name' => 'manager',
				'type' => 'raw',
				'value'=>function($data) {
					return CHtml::link($data->manager,array('/user/admin/view','id'=>$data->profileManager->id));
				}
			),
			array(
				'name' => 'user',
				'type' => 'raw',
				'value'=>function($data) {
					return CHtml::link($data->user,array('/user/admin/view','id'=>$data->profileUser->id));
				}
			),
			array(
				'name' => 'profileUser.AuthAssignment.AuthItem.description',
			),
			'summ',
			array(
				'header' => Yii::t('site','Payment method'),
				'type' => 'raw',
				'value'=>function($data) {
					$payFields = ProfileField::model()->findAllByAttributes(array('paymentProps' => '1'));
					$payFieldsUser = $data->profileUser;

					foreach ($payFields as $field) {
						$fields[] = $field->varname;
						$final[$field->varname] = $field->title;
					}

					$fields = implode($fields, ',');

					$userPayFields = Profile::model()->find(array('select' => $fields, 'condition' => 'user_id = :user', 'params' => array(':user' => $data->profileUser->id)));

					$fields = array();
					if(!empty($userPayFields))					
						foreach ($userPayFields as $key => $field)
							if ($field != null) $fields[$key] = $final[$key];
					
					$model = Company::model()->findByPk(Company::getId());
					if ($model !== null && $model->PaymentCash == '1') $fields['cash'] = 'Наличные';
						
					return CHtml::dropDownList('paymentType_' . $data->id, $data->details_type, $fields,
						array(
							'empty' => '',
							'disabled' => in_array($data->approve, array('0','1')) ? true : false,
							'ajax' => array(
								'url'=> PaymentController::createUrl('getPayNumber'),
								'data' => array(
									'payType' => 'js:this.value',
									'user' => $data->profileUser->id,
								),
								'success' => 'function(html) {
									if (html != "") $("#payDetailNumber_' . $data->id . '").val(html);
									else $("#payDetailNumber_' . $data->id . '").val("");
								}',
							),
						)
					);
				}
			),
			array(
				'name' => 'details_number',
				'type' => 'raw',
				'value'=>function($data) {
					return CHtml::textField("payDetailNumber_{$data->id}", $data->details_number, array('disabled' => in_array($data->approve, array('0','1')) ? true : false));
				}
			),
			array(
				'class' => 'CButtonColumn',
				'template'=> '{approved} {reject} {for_reject} {for_approve} ',
				'buttons' => array(
					'for_approve' => array(
						'label' => Yii::t('site','Confirm'),
						'options' => array("class"=>"btn btn-primary btn-xs approve_payment"),
						'visible' => '$data->approve == 2',
						'click' =>'function(){setApprove($(this).attr("href"),$("#paymentType_"+$(this).attr("href")).val(),$("#payDetailNumber_"+$(this).attr("href")).val());return false;}', // manager.js
						'url'=>'$data->id',
					),
					'for_reject' => array(
						'label' => Yii::t('site','Reject'),
						'options' => array("class"=>"btn btn-primary btn-xs reject_payment"),
						'visible' => '$data->approve == 2',
						'click' => 'function(){setReject($(this).attr("href"));return false;}', 
						'url'=>'$data->id',
					),
					'approved' => array(
						'label' => Yii::t('site','Confirmed'),
						'visible' => '$data->approve == 1',
					),
					'reject' => array(
						'label' => Yii::t('site','Rejected'),
						'visible' => '$data->approve == 0',
					),
				),
			),
			array(
				'header' => 'Отменить платеж',
				'class' => 'CButtonColumn',
				'template'=> '{cancel}',
				'buttons' => array(
					'cancel' => array(
						'label' => Yii::t('site','Cancel'),
						'options' => array("class"=>"btn btn-primary btn-xs cancel_payment"),
						'visible' => 'in_array($data->approve, array(0, 1))',
						'click' => 'function(){cancelPayment($(this).attr("href"));return false;}', // manager.js
						'url'=>'$data->id',
					),
				),
			),
		),
	));
	?>
	Количество: <b><?= $data['out']['count'] ?></b>
	<br>
	Сумма: <b><?= $data['out']['sum'] ?>&nbsp;р.</b>
</div>