<table>
    <tr>
        <td>
            <a class="btn btn-default btn-block" href="#">Личный кабинет</a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="#">Личный счет</a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="#">Профиль</a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="/index.php?r=project/zakaz/list&status=2">Заказы</a>
        </td>
    </tr>
    <tr>
        <td>
            <a class="btn btn-default btn-block" href="/index.php?r=project/zakaz/list&status=2&executor=<?php echo Yii::app()->user->id;?>">Мои заказы</a>
        </td>
        <td>
            
        </td>
        <td>
            
        </td>
        <td>
            
        </td>
    </tr>
</table>
