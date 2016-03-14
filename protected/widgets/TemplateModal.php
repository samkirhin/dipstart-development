<?php

Yii::import('application.extensions.booster.widgets.TbModal');

class TemplateModal extends TbModal
{
    public $types;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->render('template_modal', ['types' => $this->types]);
        parent::run();
    }
}