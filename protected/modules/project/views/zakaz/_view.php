<?php
/* @var $this ZakazController */
/* @var $data Zakaz */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode(User::model()->findByPk($data->user_id)->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode(Categories::model()->findByPk($data->category_id)->cat_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_id')); ?>:</b>
	<?php echo CHtml::encode(Jobs::model()->findByPk($data->job_id)->job_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('add_demands')); ?>:</b>
	<?php echo CHtml::encode($data->add_demands); ?>
	<br />



    <b><?php echo CHtml::encode($data->getAttributeLabel('max_exec_date')); ?>:</b>
	<?php echo CHtml::encode($data->max_exec_date); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('pages')); ?>:</b>
	<?php echo CHtml::encode($data->pages); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('budget')); ?>:</b>
	<?php echo CHtml::encode($data->budget); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('file')); ?>:</b>
    <?php
        $filelist = Yii::app()->fileman->list_files($data->id);
        foreach ($filelist as $fd) {
          $real_path = Yii::app()->fileman->get_file_path($fd['id'], $fd['file_id']);
          echo CHtml::link(CHtml::encode($fd['filename']), array('zakaz/download', 'path' => $real_path)).'&nbsp;&nbsp;';
          //echo EDownloadHelper::download($real_path);
        }
    ?>
    <?php echo CHtml::encode($data->file); ?>
	<br />
    <p><a href="<?php echo Yii::app()->createUrl('project/chat', array('orderId' => $data->id)); ?>">Чат</a></p>
    <?php /*


	<b><?php echo CHtml::encode($data->getAttributeLabel('date_finish')); ?>:</b>
	<?php echo CHtml::encode($data->date_finish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_payed')); ?>:</b>
	<?php echo CHtml::encode($data->is_payed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('with_prepayment')); ?>:</b>
	<?php echo CHtml::encode($data->with_prepayment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('executor')); ?>:</b>
	<?php echo CHtml::encode($data->executor); ?>
	<br />

	*/ ?>

</div>