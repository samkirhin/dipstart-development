<?php

class ZakazPartsController extends Controller
{
    
    protected $_request;
    protected $_response;
    
    /*Вызов методов для работы с json*/
    protected function _prepairJson() {
        $this->_request = Yii::app()->jsonRequest;
        $this->_response = new JsonHttpResponse();
    }
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Performs the AJAX validation.
	 * @param ZakazParts $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='zakaz-parts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        /* Получение списка частей для заказа по ИД*/
        public function actionApiGetAll() {
            $this->_prepairJson();
            $zakazId = $this->_request->getParam('orderId');
            if (User::model()->isAdmin() || User::model()->isManager()) {
                $models = ZakazParts::model()->findAll('proj_id = :PROJ_ID',
                    array(":PROJ_ID"=>$zakazId)
                );
                $parts = array();
                foreach ($models as $model) {
                    $part['id'] = $model->id;
                    $part['proj_id'] = $model->proj_id;
                    $part['title'] = $model->title;
                    $part['date'] = Yii::app()->dateFormatter->formatDateTime($model->date, 'medium' ,'');
                    $part['author_id'] = $model->author_id;
                    $part['author'] = $model->getRelated('author')->username;
                    $part['show'] = $model->show;
                    $part['comment'] = $model->comment;
                    $part['file'] = ZakazPartsFiles::model()->findAll('part_id = :PART_ID',
                        array("PART_ID"=>$model->id)
                    );
                    $for_moderation = array_diff(scandir(YiiBase::getPathOfAlias('webroot').'/uploads/additions/temp'), array('..', '.'));
                    foreach ($for_moderation as $k=>$v)
                        if(preg_match('/_'.$model->id.'./i',$v)){
                            $for_moderation[$k]=array(
                                'comment'=>0,
                                'file_name'=>0,
                                'id'=>0,
                                'orig_name'=>preg_replace('/_'.$model->id.'/i','',$v),
                                'part_id'=>$model->id,
                                'for_approved'=>'Must approved',
                            );
                        } else unset($for_moderation[$k]);
                    $part['file'] = array_merge($part['file'],$for_moderation);
                    $parts[] = $part;
                }
                $this->_response->setData(array(
                    'parts'=>$parts
                ));
                $this->_response->send();
            } elseif (User::model()->isCustomer() || User::model()->isAuthor()) {
                $model = ZakazParts::model()->findAll('proj_id = :PROJ_ID AND `show` IN (1'.(User::model()->isAuthor()?',0)':')'),
                    array(':PROJ_ID'=>$zakazId)
                );
                $parts = array();
                foreach ($model as $k => $part) {
                    foreach ($part as $kk => $vv) {
                        $parts[$k][$kk]=$vv;
                    }
                    $parts[$k]['file'] = $part->getRelated('files');
                    $parts[$k]['author'] = $part->getRelated('author')->username;
                }
                $this->_response->setData(array('parts'=>$parts));
                $this->_response->send();
            }
        }
        public function actionApiApprove() {
            $this->_prepairJson();
            $data = $this->_request->getParam('data');
            $path = 'uploads/additions/'.$data['id'].'/';
            $list = explode('.', $data['orig_name']);
            $newName = $this->getGuid();
            $filePath = $_SERVER['DOCUMENT_ROOT'].'/uploads/additions/temp/'.$list[0].'_'.$data['id'].'.'.$list[1];
            $fileNewPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/additions/'.$data['id'].'/'.$newName.".".$list['1'];
            if (rename($filePath, $fileNewPath)) {
                $fileModel = new ZakazPartsFiles();
                $fileModel->part_id = $data['id'];
                $fileModel->orig_name = $data['orig_name'];
                $fileModel->file_name = $newName . "." . $list['1'];
                $fileModel->comment = '';
                $fileModel->save();
                $this->_response->setData(true);
            } else $this->_response->setData(false);
            $this->_response->send();
        }
        public function actionApiEditPart() {
            $this->_prepairJson();
            $partId = $this->_request->getParam('id');
            $model = ZakazParts::model()->findByPk($partId);
            $model->comment = $this->_request->getParam('comment');
            $model->date = $this->_request->getParam('date');
            $model->title = $this->_request->getParam('title');
            $files = $this->_request->getParam('files');
            $path = 'uploads/additions/'.$partId.'/';
            $this->checkDir($path);
            foreach($files as $file) {
                $list = explode('.', $file);
                $newName = $this->getGuid();
                $filePath = $_SERVER['DOCUMENT_ROOT'].'/uploads/additions/temp/'.$file;
                $fileNewPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/additions/'.$partId.'/'.$newName.".".$list['1'];
                $probe = rename($filePath, $fileNewPath);
                $fileModel = new ZakazPartsFiles();
                $fileModel->part_id = $model->id;
                $fileModel->orig_name = $file;
                $fileModel->file_name = $newName.".".$list['1'];
                $fileModel->comment = '';
                $fileModel->save();
            }
            $model->save();
            $this->_response->setData(array(
                'result' => true
            ));
            $this->_response->send();
        }
        
        private function checkDir($path) {
            if (!file_exists($path)){
                mkdir($path, 0777, true);
            }
        }
        
        protected function getGuid(){
            if (function_exists('com_create_guid')){
                return com_create_guid();
            }else{
                mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
                $charid = strtoupper(md5(uniqid(rand(), true)));
                $hyphen = chr(45);// "-"
                $uuid = substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12);// "}"
                return $uuid;
            }
        }
        
        public function actionApiEditFilesComment() {
            $this->_prepairJson();
            $fileid = $this->_request->getParam('id');
            $file = new ZakazPartsFiles;
            $id = $file->changeComment($fileid, $this->_request->getParam('comment'));
            $this->_response->setData(array(
                'id' => $id
            ));
            $this->_response->send();
        }
        
        public function actionApiChangeIsShowed() {
            $this->_prepairJson();
            $partId = $this->_request->getParam('id');
            $part = ZakazParts::model()->findByPk($partId);
            if ($part->show == 1) {
                $part->show = 0;
            } else {
                $part->show = 1;
            }
            $part->save();
            $this->_response->setData(array(
                'result' => true
            ));
            $this->_response->send();
        }
        
        public function actionApiDeleteFile() {
            $this->_prepairJson();
            $fileid = $this->_request->getParam('id');
            $file = new ZakazPartsFiles;
            $result = $file->deleteFile($fileId);
            unlink($_SERVER['DOCUMENT_ROOT'].'uploads/additions/'.$result['part'].'/'.$result['file']);
            $this->_response->setData(array(
                'id' => $result['part']
            ));
            $this->_response->send();
        }
        
        /*Создание новой части на основе имени и ИД-заказа*/
        public function actionApiCreate() {
            $this->_prepairJson();
            $zakazId = $this->_request->getParam('orderId');
            $zakaz = Zakaz::model()->findByPk($zakazId);
            $model = new ZakazParts;
            $model->proj_id = $zakaz->id;
            $model->title = $this->_request->getParam('name');
            $model->author_id = $zakaz->executor;
            if ( $model->save() ) {
                $this->_response-> setData(array(
                    'result'=>$model->id
                ));
                $this->_response->send();
            } else {
                $this->_response->setData(array(
                    'result'=>false
                ));
                $this->_response->send();
            }
        }
        
        /*Удаление части по ИД*/
        public function actionApiDelete() {
            $this->_prepairJson();
            $id = $this->_request->getParam('id');
            $part =  ZakazParts::model()->findByPk($id);
            
            if ($part->delete()) {
                $this->_response->setData(array(
                    'result'=>true
                ));
                $this->_response->send();
            } else {
                $this->_response->setData(array(
                    'result'=>false
                ));
                $this->_response->send();
            }
        }
        
        /*Получение данных части по ИД для дальнейшего редактирования*/
        public function actionApiGetPart() {
            $this->_prepairJson();
            $id = $this->_request->getParam('id');
            $model = ZakazParts::model()->findByPk($id);
            $files = ZakazPartsFiles::model()->findAll('part_id = :PART_ID',
                        array("PART_ID"=>$model->id)
                    );
            $this->_response->setData(array(
                    'part' => $model,
                    'files' => $files
                ));
            $this->_response->send();
        }
        
        public function actionUpload()
        {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            $folder='uploads/additions/temp/';// folder for uploaded files
            $allowedExtensions = array('jpg', 'gif', 'txt', 'doc', 'docx');//array("jpg","jpeg","gif","exe","mov" and etc...
            $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
            $pi = pathinfo($_GET['qqfile']);
            $_GET['qqfile']=$pi['filename'].'_'.$_GET['id'].'.'.$pi['extension'];
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder,true);
            if ($result['success']) {
                EventHelper::addChanges($_GET['proj_id']);
            }
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
            $fileName=$result['filename'];//GETTING FILE NAME
            echo $return;// it's array
        }
}
