<?php

/**
 * Created by stixlink.
 * E-mail: stixlink@gmail.com
 * Skype: stixlink
 * Date: 19.12.14
 * Time: 16:39
 */

/**
 * Class ChangesWidget
 *
 * @property ProjectChanges $changes
 * @property Zakaz          $project
 */
class ChangesWidget extends CWidget {

    public $changes;
    public $project;
    protected $userObj;

    public function init() {

        $this->userObj = User::model();
        $isApprove = ProjectChanges::approveAllowed() ? 'true' : 'false';
        $isEditable = ($this->userObj->isManager() | $this->userObj->isCustomer() | $this->userObj->isAdmin()) ? 'true' : 'false';
        $this->changes = new ProjectChanges();
        Yii::app()->clientScript->registerScriptFile('/js/jQuery.form.js');
        Yii::app()->clientScript->registerScriptFile('/js/changes.js');
        Yii::app()->clientScript->registerScript('changes-script', "var changes = new ChangesController('{$this->project->id}', {$isEditable}, {$isApprove});
changes.init();", CClientScript::POS_END);
        Yii::app()->clientScript->registerCssFile('/css/changes.css');

    }

    public function run() {

        $this->render('default', array('changes' => $this->changes, 'project' => $this->project, 'user' => $this->userObj));
    }

}