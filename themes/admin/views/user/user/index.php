<?php
$this->breadcrumbs=array(
	UserModule::t("Users"),
);
if(UserModule::isAdmin()) {
	//$this->layout='//layouts/column2';
	$this->menu=array(
		array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
		array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
		array('label'=>UserModule::t('List Author User'), 'url'=>array('/user&s=Author')),
		array('label'=>UserModule::t('List Customer User'), 'url'=>array('/user&s=Customer')),
	);
	$this->widget('zii.widgets.CMenu', array(
		'items'=>$this->menu,
		'htmlOptions'=>array('class'=>'operations'),
	));
}
?>
<table>
	<tr>
		<td>
			<?php echo CHtml::link(Yii::t('site', 'Authors'),array('','s'=>'Author'),array('class'=>'btn btn-default btn-block'));?>
		</td>
		<td>
			<?php echo CHtml::link(Yii::t('site', 'Customers'),array('','s'=>'Customer'),array('class'=>'btn btn-default btn-block'));?>
		</td>
	</tr>
</table>
<?php
echo '<h1>'.UserModule::t("List User").'</h1>';
switch ($_GET['s']) {
	case 'Author':
		echo '<h2>'.UserModule::t("List Author User").'</h2>';
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'itemGrid',
			'dataProvider'=>$dataProvider,
			'columns'=>array(
				'id',
				array(
					'name' => UserModule::t("username"),
					'type'=>'raw',
					'value' => 'CHtml::link(CHtml::encode($data["username"]),array("admin/update","id"=>$data["id"]))',
				),
				array(
					'type'=>'raw',
					'name'=>UserModule::t("First Name"),
					'value'=>'$data["firstname"]',
				),
				array(
					'type'=>'raw',
					'name'=>UserModule::t("Last Name"),
					'value'=>'$data["lastname"]',
				),
				array(
					'type'=>'raw',
					'name'=>UserModule::t("E-mail"),
					'value'=>'$data["email"]',
				),
				/*array(
					'type'=>'raw',
					'name'=>UserModule::t("Phone"),
					'value'=>'$data["mob_tel"]',
				),*/
				array(
					'type'=>'raw',
					'name'=>UserModule::t("Cat name"),
					'value'=>'$data["cat_name"]',
				),
			),
		));
		break;
	default:
		echo '<h2>'.UserModule::t("List Customer User").'</h2>';
		$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$dataProvider,
			'columns'=>array(
				array(
					'type'=>'raw',
					'name'=>UserModule::t("First Name"),
					'value'=>'$data["profile"]->firstname',
				),
				array(
					'type'=>'raw',
					'name'=>UserModule::t("Last Name"),
					'value'=>'$data["profile"]->lastname',
				),
				array(
					'name' => UserModule::t("username"),
					'type'=>'raw',
					'value' => 'CHtml::link(CHtml::encode($data->username),array("admin/update","id"=>$data->id))',
				),
				'email',
				/*array(
					'type'=>'raw',
					'name'=>UserModule::t("Phone"),
					'value'=>'$data["profile"]->mob_tel	',
				),*/
			),
		));
		break;
}
