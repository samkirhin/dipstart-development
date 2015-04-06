<table>
    <tr>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('project/zakaz'); ?>">Заказы</a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('user'); ?>">Пользователи</a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('categories/index'); ?>">Категории</a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('jobs/index'); ?>">Виды работ</a>
        </td>
    </tr>
    <tr>
        <td>
            <a class="btn btn-default btn-block" href="/index.php?r=projectStatus/index">Статусы заказов</a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('project/event'); ?>">События</a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('project/sms/send'); ?>">Отправить смс</a>
        </td>
        <td>
            
        </td>
    </tr>
</table>