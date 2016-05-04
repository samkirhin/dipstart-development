<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $authMenu = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */

	public $breadcrumbs=array();

    public function init(){
		// --- Организации
		$c_id = Company::getId();
		if ($c_id) {
			if(Company::getCompany()->frozen) {
				echo 'Where is my money, dude ?!?!?!';
				die;
			}
			//Payment::$table_prefix = $c_id.'_';
			//Profile::$table_prefix = $c_id.'_';
			//ProfileField::$table_prefix = $c_id.'_';
			ProjectChanges::$table_prefix = $c_id.'_';
			ProjectChanges::$file_path = 'uploads/c'.$c_id.'/changes_documents';
			//ProjectMessages::$table_prefix = $c_id.'_';
			ProjectPayments::$table_prefix = $c_id.'_';
			Zakaz::$table_prefix = $c_id.'_';
			Zakaz::$files_folder = '/uploads/c'.$c_id.'/';
			Events::$table_prefix = $c_id.'_';
			ZakazParts::$table_prefix = $c_id.'_';
			//UpdateProfile::$table_prefix = $c_id.'_';
			ZakazPartsFiles::$table_prefix = $c_id.'_';
            //PaymentImage::$table_prefix = $c_id.'_';
			Emails::$table_prefix = $c_id.'_';
			
			Yii::app()->language = Company::getLanguage();
		} else {
			$tmp = explode('.',$_SERVER['SERVER_NAME']);
			if (array_shift($tmp)=='www') {
				$this->redirect('http://'.implode('.',$tmp));
			} else {
				echo 'Requested company not found.';
			}
			Yii::app()->end();
		}
		// ---
        if (!Yii::app()->user->isGuest)
            switch (User::model()->getUserRole()) {
                case ('Manager'):
                case ('Admin'):
				case ('root'):
                    Yii::app()->theme='admin';
                    break;
                case ('Author'):
                    $this->menu = array(
						array('label'=>Yii::t('site','My orders'), 'url'=>array('/project/zakaz/ownList')),
						array('label'=>Yii::t('site','New projects'), 'url'=>array('/project/zakaz/list')),
						array('label'=>Yii::t('site','User Agreement'), 'url'=>array('/site/agreement')),
                        //array('label'=>Yii::t('site','Personal account'), 'url'=>array('/user/profile/account')),
						array('label'=>Yii::t('site','Logout'), 'url'=>array('/user/logout')),// Даллее выводится в обратном порядке
						array('label'=>Yii::t('site','Profile'), 'url'=>array('/user/profile/edit')),
                    );
					$this->authMenu = array(
					    array('label'=>Yii::t('site','Logout'), 'url'=>array('/user/logout')),
					);
                    Yii::app()->theme='client';
                    break;
                case ('Customer'):
                    $this->menu = array(
						array('label'=>Yii::t('site','My orders'), 'url'=>array('/project/zakaz/customerOrderList')),
						array('label'=>Yii::t('site','Create order'), 'url'=>array('/project/zakaz/create')),
                        //array('label'=>Yii::t('site','Personal account'), 'url'=>array('/user/profile/account')),
						array('label'=>Yii::t('site','User Agreement'), 'url'=>array('/site/agreement')),
						array('label'=>Yii::t('site','Logout'), 'url'=>array('/user/logout')),// Даллее выводится в обратном порядке
						array('label'=>Yii::t('site','Profile'), 'url'=>array('/user/profile/edit')),
                    );
					$this->authMenu = array(
					    array('label'=>Yii::t('site','Logout'), 'url'=>array('/user/logout')),
					);
                    Yii::app()->theme='client';
                    break;
                case ('Webmaster'):
                    $this->menu = array(
						array('label'=>Yii::t('site','Stats'), 'url'=>array('/partner/stats')),
						array('label'=>Yii::t('site','Promo materials'), 'url'=>array('/partner/materials')),
						array('label'=>Yii::t('site','Logout'), 'url'=>array('/user/logout')),// Даллее выводится в обратном порядке
						array('label'=>Yii::t('site','Profile'), 'url'=>array('/user/profile/edit')),
                    );
					$this->authMenu = array(
					    array('label'=>Yii::t('site','Logout'), 'url'=>array('/user/logout')),
					);
                    Yii::app()->theme='client';
                    break;
            }

//		var_dump(Yii::app()->controller->module->id ,Yii::app()->controller->id, Yii::app()->controller->action->id);
//		die();
    }

    public function filters(){
        return array(
            'rights',
			//'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
        );
    }
}
