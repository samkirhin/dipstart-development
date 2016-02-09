<?php
class CompanyController extends Controller {
	public function actionEdit() {
		$model = Campaign::getCompany();
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
		$this->render('edit',array(
			'model'=>$model,
		));
	}
}
?>