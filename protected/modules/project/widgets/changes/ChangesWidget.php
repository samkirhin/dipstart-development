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
class ChangesWidget extends CWidget
{

    public $changes;
    public $project;
    protected $userObj;

    public function init()
    {

        $this->userObj = User::model();
        $this->changes = new CArrayDataProvider(Yii::app()->db->createCommand()
            ->select('CONCAT("/' . 'uploads/changes_documents' . '/",file)  as `file`, file as `filename`, comment, id, moderate, date_create')
            ->from('ProjectChanges')
            ->where('project_id =' . (int)$this->project->id . ($this->userObj->isAuthor() ? ' AND moderate=1' : ''))
            ->queryAll(),
            array(
                'pagination' => false,
            ));
    }

    public function run()
    {
        if (count($this->changes->rawData) > 0 || User::model()->isCustomer())
            $this->render('default', array('changes' => $this->changes, 'project' => $this->project, 'user' => $this->userObj));
    }

}