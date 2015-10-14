<div id="list-changes-block" class="list-changes-block">
    <div class="list-changes-filename">
        <a href="<?php echo $data['file'];?>"><?php echo $data['filename']; ?></a>
    </div>
    <div class="list-changes-comment">
        <?php echo $data['comment']; ?>
    </div>
<?php if (ProjectChanges::approveAllowed()) { ?>
    <div class="list-changes-moderate">
        <?= Yii::t('project','Moderation') ?>
        <?php
		echo CHtml::dropDownList(
            'moderate',
            $data['moderate'],
            array('1' => ProjectModule::t('Approved'), '0' => ProjectModule::t('Not approved')),
            array('onchange' => 'changes_approve('.$data['id'].', '.$data['moderate'].')'));
        ?>
    </div>
<?php } ?>
</div>