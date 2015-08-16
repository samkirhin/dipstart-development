<?php
/**
 * Created by PhpStorm.
 * User: Emericanec
 * Date: 17.02.15
 * Time: 20:46
 */
$attributes = $model->attributeLabels();
?>
<br><br>
<?php echo 'Пользователь '.$profile->lastname.' '.$profile->firstname.' ('.$profile->user->email.', '.$profile->mob_tel.') разместил заказ:'; ?><br>
<?php if(Campaign::getId()){ 
	$columns = array('id', [
			'name' => 'author_informed',
			'value' => Yii::app()->dateFormatter->formatDateTime($model->author_informed),
		]);
	$projectFields = $model->getFields();
	if ($projectFields) {
		foreach($projectFields as $field) {
			if (isset($field->field_id)){
				$tmp = $field->varname;
				$columns[] = [
					'name' => $field->title,
					'type' => 'raw',
					'value' => Catalog::model()->findByPk($model->$tmp)->cat_name,
					];
			} else {
				$tmp = $field->varname;
				$columns[] = [
					'name' => $field->title,
					'value' => $model->$tmp
					];
			}
		}
	}
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'attributes' => $columns));
} else {
?>
<?php echo $attributes['title'];?>: <?php echo $model->title;?><br>
<?php echo $attributes['text'];?>: <?php echo $model->text;?><br>
<?php echo $attributes['date'];?>: <?php echo date("d.m.Y H:i:s", $event->timestamp);?><br>
<?php echo $attributes['category_id'];?>: <?php echo Categories::model()->findByPk($model->category_id)->cat_name;?><br>
<?php echo $attributes['job_id'];?>: <?php echo Jobs::model()->findByPk($model->job_id)->job_name;?><br>
<?php echo $attributes['max_exec_date'];?>: <?php echo $model->dbmax_exec_date;?><br>
<?php echo $attributes['date_finish'];?>: <?php echo $model->dbdate_finish;?><br>
<?php echo $attributes['author_informed'];?>: <?php echo $model->dbauthor_informed;?><br>
<?php echo $attributes['pages'];?>: <?php echo $model->pages;?><br>
<?php echo $attributes['add_demands'];?>: <?php echo $model->add_demands;?><br>
<?php echo $attributes['time_for_call'];?>: <?php echo $model->time_for_call;?><br>
<?php echo $attributes['edu_dep'];?>: <?php echo $model->edu_dep;?><br>
<!--<?php //echo $attributes['notes'];?>: <?php //echo $model->notes;?><br>-->
<?php } ?>
<form method="post"
      action="<?php echo Yii::app()->createUrl('project/zakaz/moderationAnswer', array('id' => $model->id, 'event_id' => $event->id, 'answer' => 1));?>"
      style="display: inline-block">
    <input type="submit" value="Одобрить">
</form>
<form method="post"
      action="<?php echo Yii::app()->createUrl('project/zakaz/moderationAnswer', array('id' => $model->id, 'event_id' => $event->id, 'answer' => 0));?>"
      style="display: inline-block">
    <input type="submit" value="Отклонить">
</form>
