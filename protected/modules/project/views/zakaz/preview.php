<?php
/**
 * Created by PhpStorm.
 * User: Emericanec
 * Date: 17.02.15
 * Time: 20:46
 */
$attributes = $model->attributeLabels();
;?>

<?php echo $attributes['title'];?>: <?php echo $model->title;?><br>
<?php echo $attributes['text'];?>: <?php echo $model->text;?><br>
<?php echo $attributes['date'];?>: <?php echo date("d.m.Y H:i:s", $event->timestamp);?><br>
<?php echo $attributes['category_id'];?>: <?php echo Categories::model()->findByPk($model->category_id)->cat_name;?><br>
<?php echo $attributes['job_id'];?>: <?php echo Jobs::model()->findByPk($model->job_id)->job_name;?><br>
<?php echo $attributes['max_exec_date'];?>: <?php echo $model->max_exec_date;?><br>
<?php echo $attributes['date_finish'];?>: <?php echo $model->date_finish;?><br>
<?php echo $attributes['pages'];?>: <?php echo $model->pages;?><br>
<?php echo $attributes['status'];?>: <?php echo $model->status;?><br>
<?php echo $attributes['notes'];?>: <?php echo $model->notes;?><br>
<form method="post"
      action="<?php echo Yii::app()->createUrl('project/zakaz/moderationAnswer', array('id' => $model->id, 'event_id' => $event->id, 'answer' => 1));?>"
      style="display: inline-block">
    <input type="submit" value="Одобрить">
</form>
<form method="post"
      action="<?php echo Yii::app()->createUrl('project/zakaz/moderationAnswer', array('id' => $model->id, 'event_id' => $event->id, 'answer' => 0));?>"
      style="display: inline-block">
    <input type="submit" value="Неодобрить">
</form>
