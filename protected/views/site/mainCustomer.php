<table>
    <tr>
        <td>
            <a class="btn btn-default btn-block" href="#"><?= Yii::t('site','Personal area') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?= $this->createUrl('/user/profile/account') ?><?= Yii::t('site','Personal account') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?= $this->createUrl('/user/profile/edit') ?>"><?= Yii::t('site','Profile') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="/index.php?r=project/zakaz/create"><?= Yii::t('site','Create Zakaz') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?= $this->createUrl('/project/zakaz/customerOrderList') ?>"><?= Yii::t('site','My orders') ?></a>
        </td>
    </tr>
    <tr>
        <td>
            
        </td>
        <td>
            
        </td>
        <td>
            
        </td>
        <td>
            
        </td>
    </tr>
</table>
