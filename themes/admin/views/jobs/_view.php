<?php
/* @var $this JobsController */
/* @var $data Jobs */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('job_name')); ?>:</b>
	<?php echo CHtml::encode($data->job_name); ?>
	<br />


</div>