<?php
/**
 * @var array $types
 */
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h4><?= ProjectModule::t('Please select template'); ?></h4>
</div>
<div class="modal-body">
    <?php foreach ($types as $type):
        $templates = Templates::model()->findAllByAttributes(['type_id' => $type]);
        $templateNames = array_unique(array_column($templates, 'name'));
        ?>
        <div class="chat_templates_wrapper template_type_<?= $type ?> hidden">
            <?= $this->render('_templates', compact('templates', 'templateNames', 'type')) ?>
        </div>
        <br/>
    <?php endforeach ?>
</div>
<div class="modal-footer">
    <?php
    $this->widget('application.extensions.booster.widgets.TbButton', [
        'buttonType' => 'submit',
        'label' => 'Выбрать',
        'htmlOptions' => ['data-dismiss' => 'modal', 'class' => 'template-submit'],
    ]);
    ?>
</div>
