<?php

class DefaultController extends Controller
{

    public function filters()
    {
        return CMap::mergeArray(parent::filters(),array(
            'accessControl', // perform access control for CRUD operations
        ));
    }
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('admin','manager'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    /**
	 * Lists all models.
	 */
	public function actionIndex()
	{
			switch ($_GET['s']) {
				case 'Author':
					$prof=Profile::model()->with('user','AuthAssignment')->findAll();
					$cat=Categories::model()->findAll();
					foreach($cat as $key=>$val) $rescat[$val->getAttributes()['id']]=$val->getAttributes()['cat_name'];
					foreach ($prof as $key=>$val) {
						$res=$val->getAttributes();
						$res1=$val->AuthAssignment->getAttributes();
						$resuser=$val->user->getAttributes();
						if ($res['discipline']!='') {
							$res['cat_name']=implode(',',array_intersect_key($rescat,array_flip(explode(',',$res['discipline']))));
						}
						if ($res1['itemname']=='Author') {
							$itog[$key]=array_merge($res,$resuser);
						}
					}
					$dataProviderAuthor=new CArrayDataProvider($itog, array(
						'pagination'=>array(
							'pageSize'=>Yii::app()->controller->module->user_page_size,
						),
					));
					break;
				default:
					$dataProviderCustomer=new CActiveDataProvider('User', array(
						'criteria'=>array(
							'condition'=>'status>'.User::STATUS_BANNED,
							'with' => array(
								'AuthAssignment' => array(
									'condition' => 'itemname="Customer"',
									'together' => true,
								),
							),
						),
						'pagination'=>array(
							'pageSize'=>Yii::app()->controller->module->user_page_size,
						),
					));
					break;
			}

		$this->render('/user/index',array(
			'dataProviderAuthor'=>$dataProviderAuthor,
			'dataProviderCustomer'=>$dataProviderCustomer,
		));
	}

}
