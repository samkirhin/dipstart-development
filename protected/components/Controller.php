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
	public $campaign_id;
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */

	public $breadcrumbs=array();

    public function init(){
		// --- Организации
		$campaign = Campaign::search_by_domain($_SERVER['SERVER_NAME']);
		$this->campaign_id = $campaign->id;
		if ($this->campaign_id) {
			Zakaz::$table_prefix = $this->campaign_id.'_';
		}
		// ---
        if (!Yii::app()->user->isGuest)
            switch (User::model()->getUserRole()) {
                case ('Manager'):
                case ('Admin'):
                    Yii::app()->theme='admin';
                    break;
                case ('Author'):
                    $this->menu = array(
						array('label'=>Yii::t('site','My orders'), 'url'=>array('/project/zakaz/ownList')),
						array('label'=>Yii::t('site','New orders'), 'url'=>array('/project/zakaz/list','status'=>'2')),
						array('label'=>Yii::t('site','Profile'), 'url'=>array('/user/profile/edit')),
                        array('label'=>Yii::t('site','Personal account'), 'url'=>array('/user/profile/account')),
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
						array('label'=>Yii::t('site','Profile'), 'url'=>array('/user/profile/edit')),
                        array('label'=>Yii::t('site','Personal account'), 'url'=>array('/user/profile/account')),  
                    );
					$this->authMenu = array(
					    array('label'=>Yii::t('site','Logout'), 'url'=>array('/user/logout')),
					);
                    Yii::app()->theme='client';
                    break;
            }
    }

    public function filters(){
        return array(
            'rights',
			//'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
        );
    }
}
