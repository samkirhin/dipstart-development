<?php
class CompanyController extends Controller {
	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('edit'),
				'users'=>UserModule::getAdminsAndRoot(),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('list','create'),
				'users'=>array('root'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionList() {
		$model = new Campaign('search');
		$model->unsetAttributes();
		if(Yii::app()->request->isAjaxRequest) {
			$params = Yii::app()->request->getParam('Campaign');
			$model->setAttributes($params);
			Yii::app()->user->setState('CampaignFilterState', $params);
		}
		$this->render('list',array(
			'model'=>$model,
		));
	}
	
	public function actionEdit($id = false) {
		if($id) {
			$model = Campaign::model()->findByPk($id);
		} else {
			$model = Campaign::getCompany();
		}
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-form') {
			echo UActiveForm::validate(array($model));
			Yii::app()->end();
		}
		if(isset($_POST['Campaign'])) {
			$model->attributes = $_POST['Campaign'];
			$model->fileupload = CUploadedFile::getInstance($model, 'fileupload');
			if($model->validate()) {
				$model->save();
				Yii::app()->user->setFlash('companySuccessMessage',ProjectModule::t('Successfully updated'));
				//$this->redirect(array('/user/profile'));
			} else {
				Yii::app()->user->setFlash('companyErrorMessage',ProjectModule::t('Something wrong'));
			};	
		}
		//Yii::app()->theme = 'admin';
		$this->render('edit',array(
			'model'=>$model,
			'root'=>(User::model()->getUserRole()=='root'),
		));
	}
	public function actionCreate() {
		if(isset($_POST['company_to_copy']) && $_POST['company_to_copy']) {
			$copy_data_list = array('Templates', 'Сatalog','ProjectStatus','PartStatus','ProjectFields','ProfilesFields');
			$prefix = intval($_POST['company_to_copy']).'_';
			$model = new Campaign();
			$model->organization = 1;
			$model->name = 'New company';
			$model->domains = 'new.company.admintrix.com';
			$model->language = 'en';
			$model->supportEmail = 'support@new.company.admintrix.com';
			$model->save();
			$new_prefix = $model->id.'_';
			$s = strlen($prefix);
			$result = Yii::app()->db->createCommand('SHOW TABLES;')->queryAll();
			foreach($result as $item){
				if(strpos($item['Tables_in_project'],$prefix)===0) $list[] = substr($item['Tables_in_project'],$s);
			}
			foreach($list as $table){
				$sql = 'CREATE TABLE `'.$new_prefix.$table.'` LIKE `'.$prefix.$table.'`;';
				Yii::app()->db->createCommand($sql)->execute();
				if (in_array($table,$copy_data_list)) {
					$sql = 'INSERT `'.$new_prefix.$table.'` SELECT * FROM `'.$prefix.$table.'`;';
					Yii::app()->db->createCommand($sql)->execute();
				}
			}
			/*
			$sql = 'CREATE TABLE `'.$new_prefix.'Users'.'` LIKE `'.$prefix.'Users'.'`;';
			Yii::app()->db->createCommand($sql)->execute();
			$sql = 'CREATE TABLE `'.$new_prefix.'AuthAssignment'.'` LIKE `'.$prefix.'AuthAssignment'.'`;';
			Yii::app()->db->createCommand($sql)->execute();
			*/
			$sql = 'INSERT INTO `'.$new_prefix.'Users` (`username`,`password`,`email`,`superuser`,`status`) VALUES ("admin","'.UserModule::encrypting('admin').'","admin@new.company.admintrix.com",1,1);';
			Yii::app()->db->createCommand($sql)->execute();
			$sql = 'INSERT INTO `'.$new_prefix.'AuthAssignment` (`itemname`,`userid`) VALUES ("Admin",1);';
			Yii::app()->db->createCommand($sql)->execute();
			
			$this->redirect(array('edit','id'=>$model->id));
		}
		$companies = Campaign::getList();
		//Yii::app()->theme = 'admin';
		$this->render('create',array(
			'companies'=>$companies,
		));
	}
}
?>