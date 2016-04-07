<?php
/* @var $this ZakazController */
/* @var $data Zakaz */
?>

<tr>
    <td>
	<?php echo CHtml::link(CHtml::encode($data->id), array('update', 'id'=>$data->id)); ?>
    </td>
    <td>
        <?php echo CHtml::encode($data->title); ?>
    </td>
    <td>
        <?php echo CHtml::encode(User::model()->findByPk($data->user_id)->username); ?>
    </td>
    <td>
        <?php echo $data->job_id > 0 ? CHtml::encode(Jobs::model()->findByPk($data->job_id)->job_name) : ''; ?>
    </td>
    <td>
        <?php echo CHtml::encode(Categories::model()->findByPk($data->category_id)->cat_name); ?>
    </td>
    <td>
        <?php echo CHtml::encode(date("Y-m-d H:i", $data->date)); ?>
    </td>
    <td>
        <?php echo CHtml::encode(date("Y-m-d H:i", $data->manager_informed)); ?>
    </td>
    <td>
        <?php echo CHtml::encode(date("Y-m-d H:i", $data->date_finish)); ?>
    </td>
</tr>