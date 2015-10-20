<table>
    <tr>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('project/zakaz'); ?>"><?= Yii::t('site','Zakazs') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('user'); ?>"><?= Yii::t('site','Users') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('categories/index'); ?>"><?= Yii::t('site','Categories') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('jobs/index'); ?>"><?= Yii::t('site','Jobs') ?></a>
        </td>
    </tr>
    <tr>
        <td>
            <a class="btn btn-default btn-block" href="/index.php?r=projectStatus/index"><?= Yii::t('site','Projects statuses') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('project/event'); ?>"><?= Yii::t('site','Events') ?></a>
        </td>
        <td>
            <a class="btn btn-default btn-block" href="<?php echo Yii::app()->createUrl('project/sms/send'); ?>"><?= Yii::t('site','Send SMS') ?></a>
        </td>
        <td>
            
        </td>
    </tr>
</table>