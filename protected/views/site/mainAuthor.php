<table>
    <tr>
        <td>
            <a class="btn btn-default btn-block" href="#"><?= Yii::t('site','Personal area') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?= $this->createUrl('/user/profile/account') ?>"><?= Yii::t('site','Personal account') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?= $this->createUrl('/user/profile/edit') ?>"><?= Yii::t('site','Profile') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="/index.php?r=project/zakaz/list&status=2"><?= Yii::t('site','Orders') ?></a>
        </td>
    </tr>
    <tr>
        <td>
            <a class="btn btn-default btn-block" href="/index.php?r=project/zakaz/ownList"><?= Yii::t('site','My orders') ?></a>
        </td>
        <td>
            
        </td>
        <td>
            
        </td>
        <td>
            
        </td>
    </tr>
</table>
