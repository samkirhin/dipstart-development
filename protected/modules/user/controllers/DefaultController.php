<?php

class DefaultController extends Controller
{
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if (isset($_GET['s']))
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
				case 'Customer':
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
		else $dataProviderAuthor='nos';

		$this->render('/user/index',array(
			'dataProviderAuthor'=>$dataProviderAuthor,
			'dataProviderCustomer'=>$dataProviderCustomer,
		));
	}

}
