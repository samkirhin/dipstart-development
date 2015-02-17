<?php
/**
 * Created by PhpStorm.
 * User: Emericanec
 * Date: 17.02.15
 * Time: 20:46
 */
$attributes = $model->attributeLabels();
?>

<?=$attributes['title']?>: <?=$model->title?><br>
<?=$attributes['text']?>: <?=$model->text?><br>
<?=$attributes['date']?>: <?=date("d.m.Y H:i:s", $event->timestamp)?><br>
<?=$attributes['category_id']?>: <?=Categories::model()->findByPk($model->category_id)->cat_name?><br>
<?=$attributes['job_id']?>: <?=Jobs::model()->findByPk($model->job_id)->job_name?><br>
<?=$attributes['max_exec_date']?>: <?=$model->max_exec_date?><br>
<?=$attributes['date_finish']?>: <?=$model->date_finish?><br>
<?=$attributes['pages']?>: <?=$model->pages?><br>
<?=$attributes['status']?>: <?=$model->status?><br>
<?=$attributes['notes']?>: <?=$model->notes?><br>
<form method="post"
      action="<?=Yii::app()->createUrl('project/zakaz/moderationAnswer', array('id' => $model->id, 'event_id' => $event->id, 'answer' => 1))?>"
      style="display: inline-block">
    <input type="submit" value="Одобрить">
</form>
<form method="post"
      action="<?=Yii::app()->createUrl('project/zakaz/moderationAnswer', array('id' => $model->id, 'event_id' => $event->id, 'answer' => 0))?>"
      style="display: inline-block">
    <input type="submit" value="Неодобрить">
</form>
