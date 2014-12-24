<?php

class ChangesController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {

        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules() {

        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                  'actions' => array('add', 'edit', 'list', 'delete', 'item'),
                  'users' => array('@'),
            ),
            array('deny',  // deny all users
                  'users' => array('*'),
            ),
        );
    }

    public function actionList($project) {

        /**
         * @var $projects ProjectChanges[]
         */
        if (!Yii::app()->request->isAjaxRequest) {
            return false;
        }

        $projects = ProjectChanges::model()->getListChanges((int)$project);

        echo CJSON::encode(array('success' => true, 'data' => $projects));
        Yii::app()->end();

    }

    public function actionItem($id) {

        /**
         * @var $projects ProjectChanges[]
         */
        if (!Yii::app()->request->isAjaxRequest) {
            return false;
        }

        $project = ProjectChanges::model()->getItem((int)$id);

        echo CJSON::encode(array('data' => $project));
        Yii::app()->end();

    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionAdd($ctr) {

        if (!Yii::app()->request->isAjaxRequest) {
            return false;
        }
        $model = new ProjectChanges();
        $model->scenario = 'add';
        $model->project_id = (int)$ctr;


        if (isset($_POST['ProjectChanges'])) {
            $model->attributes = $_POST['ProjectChanges'];
            $model->fileupload = CUploadedFile::getInstance($model, 'fileupload');
            if (!empty($model->fileupload)) {
                $model->file = 'no';
            }
            if (User::model()->isManager()) {
                $model->moderate = isset($_POST['ProjectChanges']['moderate']) ? (int)$_POST['ProjectChanges']['moderate'] : 0;
            }

            if (!$model->validate()) {
                echo CJSON::encode(array('error' => CJSON::decode(CActiveForm::validate($model))));
                Yii::app()->end();
            }
            try {
                if ($model->isAllowedAdd() && $model->save(false)) {
                    echo CJSON::encode(array('success' => true));
                    Yii::app()->end();
                } else {
                    echo CJSON::encode(array('error' => array('text' => 'Вы не можете внести правки к этому проекту!')));
                    Yii::app()->end();
                }
            } catch (CException $e) {
                echo YII_DEBUG ? CJSON::encode(array('error' => array('text' => $e->getMessage()))) :
                    CJSON::encode(array('error' => array('text' => 'Ошибка добавления!')));
                Yii::app()->end();
            }
        }

    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionEdit($id) {

        if (!Yii::app()->request->isAjaxRequest) {
            return false;
        }
        $model = $this->loadModel($id);
        $model->scenario = 'edit';
        if (!$model->isAllowedAdd()) {
            echo CJSON::encode(array('error' => array('text' => array(ProjectModule::t('You are not allowed to change!')))));
            Yii::app()->end();
        }
        if (isset($_POST['ProjectChanges'])) {
            $model->date_update = date('Y-m-d H:i:s');
            $model->attributes = $_POST['ProjectChanges'];
            $model->fileupload = CUploadedFile::getInstance($model, 'fileupload');
            if (User::model()->isManager()) {
                $model->date_moderate = date('Y-m-d H:i:s');
            }
            if (!$model->validate()) {
                echo CJSON::encode(array('error' => CJSON::decode(CActiveForm::validate($model))));
                Yii::app()->end();
            }
            if ($model->save(false)) {
                echo CJSON::encode(array('success' => true));
                Yii::app()->end();
            }
        }
        echo CJSON::encode(array('error' => array('text' => array('Данные не переданы!'))));
        Yii::app()->end();
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {

        $changes = $this->loadModel($id);

        if ($changes->isAllowedAdd()) {
            $changes->delete();
        } else {
            //TODO сделать оповещение пользователя, о том что ему запрещено удалять доработки
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else {
            echo CJSON::encode(array('success' => true));
            Yii::app()->end();
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer $id the ID of the model to be loaded
     *
     * @return ProjectChanges the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {

        $model = ProjectChanges::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }


}