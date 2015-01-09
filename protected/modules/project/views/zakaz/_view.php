<?php
/* @var $this ZakazController */
/* @var $data Zakaz */
?>

<tr>
    <td>
	<?php echo CHtml::link(CHtml::encode($data->id), array('update', 'id'=>$data->id)); ?>
    </td>
    <td>   
        <?php echo CHtml::encode(User::model()->findByPk($data->user_id)->username); ?>
    </td>
    <td>   
        <?php echo CHtml::encode(Categories::model()->findByPk($data->category_id)->cat_name); ?>
    </td>
    <td>   
        <?php echo CHtml::encode(Jobs::model()->findByPk($data->job_id)->job_name); ?>
    </td>
    <td>   
        <?php echo CHtml::encode($data->title); ?>
    </td>
    <td>   
        <?php echo CHtml::encode(date("Y-m-d H:i", $model->date)); ?>
    </td>
    <td>   
        <?php echo CHtml::encode(date("Y-m-d H:i", $model->max_exec_date)); ?>
    </td>
    <td>   
        <p><a href="<?php echo Yii::app()->createUrl('project/chat', array('orderId' => $data->id)); ?>">Чат</a></p>
    </td>
</tr>