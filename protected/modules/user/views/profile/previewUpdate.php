<h1>Пользователь <?=$user->username?> запросил изменения.</h1>

<table class="table table-bordered">
	<tr>
		<th>Параметр для замены</th>
		<th>Старое значение</th>
		<th>Новое значение</th>
		<th>Дата изменения</th>
		<th>Сменить статус</th>
		
	</tr>

	<?php foreach ($models as $model):?>
		<tr>
			<td><?=Profile::model()->getAttributeLabel($model->attribute)?></td>
			<td><?=$model->from_data?></td>
			<td><?=$model->to_data?></td>
			<td><?=date('d.m.Y H:i',$model->date_update)?></td>
			<?php if ($model->status):?>
				<td>&emsp;</td>
			<?php else:?>
				<td><?=CHtml::link(
					'<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
					Yii::app()->createUrl('/user/profile/chStatus',array('id'=>$model->id,'status'=>'appove')),
					array(
						'class'=>'sendData'
					)
				);?>
				<?=CHtml::link(
					'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
					Yii::app()->createUrl('/user/profile/chStatus',array('id'=>$model->id,'status'=>'reject')),
					array(
						'class'=>'sendData'
					)
				);?>
				</td>
			<?php endif;?>
		</tr>
	<?php endforeach;?>
</table>
<?php
Yii::app()->clientScript->registerScript('updateStatus',"
	$('.sendData').click(function(){
		var url = $(this).attr('href'),
			el = this;
		$.post(
			url,
			null,
			function(data){
				console.log(data);
				$(el).parent('td').html('Изменен');
			});
		return false;
	});
");?>