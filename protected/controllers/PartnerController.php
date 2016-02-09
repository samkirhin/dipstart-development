<?php

class PartnerController extends Controller {

	public function actionRedirect() {
		
		$pid = $_GET['pid'];
		setcookie('partner', $pid, time()+60*60*24*30*3);
		$model = new WebmasterLog();
		$model->pid = $pid;
		$model->date = date("Y-m-d"); 
		if ( isset($_COOKIE['partner']))
			$model->action =  WebmasterLog::PARTNER_REPEAT;
		else
			$model->action =  WebmasterLog::PARTNER_UNIQUE;
		$model->save();
		
		$fp = Campaign::getFrontPage();
		if ($fp) $this->redirect($fp);
		else $this->redirect($this->createUrl('user/registration'));
	}
	
	public function actionMaterials() {
		$this->render('materials');
	}
	
	public function actionStats() {
		//$numrber = cal_days_in_month(CAL_GREGORIAN, 8, 2003); // 31
		$user = User::model()->findByPk(Yii::app()->user->id);
		$registration_month = date ('n',$user->create_at);
		$registration_year = date('Y',$user->create_at);
		$current_month = date ('n');
		$current_year = date ('Y');
		$month_array = array();
		for ($year = $registration_year ; $year <= $current_year; $year++) {
			$first_month = 1;
			$last_month = 12;
			if($year == $registration_year) $first_month = $registration_month;
			if($year == $current_year) $last_month = $current_month;
			for ($month = $first_month; $month <= $last_month; $month++) {
				$month_array[] = array('m' => $month, 'y' => $year);
			}
		}
		$data = WebmasterLog::getLogsSumm($user->id, '2016-01-10', '2016-01-15');
		print_r($data);
		$this->render('stats');
		
	}
	
}
