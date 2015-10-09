<?php
$this->breadcrumbs=array(
	UserModule::t("Users"),
);
if(UserModule::isAdmin()) {
	$this->layout='//layouts/column2';
	$this->menu=array(
		array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
		array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
		array('label'=>UserModule::t('List Author User'), 'url'=>array('/user&s=Author')),
		array('label'=>UserModule::t('List Customer User'), 'url'=>array('/user&s=Customer')),
	);
}
?>
<table>
	<tr>
		<td>
			<?php echo CHtml::link(UserModule::t('Authors'),array('','s'=>'Author'),array('class'=>'btn btn-default btn-block'));?>
		</td>
		<td>
			<?php echo CHtml::link(UserModule::t('Customers'),array('','s'=>'Customer'),array('class'=>'btn btn-default btn-block'));?>
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
					'name' => 'username',
					'type'=>'raw',
					'value' => 'CHtml::link(CHtml::encode($data["username"]),array("/user/admin/update","id"=>$data["id"]))',
				),
				'firstname',
				'lastname',
				'email',
				'mob_tel',
				'cat_name',
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
					'name'=> UserModule::t('Name'),
					'value'=>'$data["profile"]->firstname',
				),
				array(
					'type'=>'raw',
					'name'=> UserModule::t('Surname'),
					'value'=>'$data["profile"]->lastname',
				),
				array(
					'name' => UserModule::t('username'),
					'type'=>'raw',
					'value' => 'CHtml::link(CHtml::encode($data->username),array("/user/admin/update","id"=>$data->id))',
				),
				array(
					'type'=>'raw',
					'name'=> UserModule::t('email'),
					'value'=>'$data["profile"]->email',
				),
				array(
					'type'=>'raw',
					'name'=> UserModule::t('Phone'),
					'value'=>'$data["profile"]->mob_tel	',
				),
			),
		));
		break;
}
