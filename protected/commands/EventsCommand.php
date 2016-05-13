<?php
class EventsCommand extends CConsoleCommand {
	
	const INTERVAL = 60; // Интервал запуска скрипта в минутах
	
    public function run($args) {
		//echo 'echo: '.get_class(Yii::app())."\n";
		$companies = Company::model()->findAll('frozen=:p',array(':p'=>'0'));
		
		foreach($companies as $company) {
			Company::setActive($company);
			Yii::app()->language = Company::getLanguage();
			self::executor();
			self::manager();
		}
    }
	
	// Событие у исполнителя - отправляет шаблон на емаил уведомление об этом (берем из справочника)
	public function executor() {
		$usersModel = User::model()->findAllNotificationExecutors();
		if (is_array($usersModel))
			foreach ($usersModel as $user) {
				foreach ($user->zakaz_executor as $zakaz) {
					$time = explode(':', $user->profile->notification_time); // время X, за которое надо уведомлять (количество часов и минут), формат "5:48"
					if (count($time)<2) $time[1] = 0;
					$date = date('Y-m-d H:i',strtotime($zakaz->author_informed));
					$date = strtotime($date)-(int)$time[0]*60*60-(int)$time[1]*60;
					$dateStart = strtotime(date('Y-m-d H:i',time())) - (self::INTERVAL * 60);
		
					if ($date >= $dateStart && $date < strtotime(date('Y-m-d H:i',time()))) {
					//if (strtotime(date('Y-m-d H:i',time())) == $date) {
						echo 'Email zakaz #'.$zakaz->id."\n";
						$templatesModel = Templates::model()->findByPk(21);
						
						$email = new Emails;
						$email->from_id	= 1;
						$email->to_id 	= $user->id;
						$email->name 	= $user->full_name;
						$email->sendTo($user->email, $templatesModel->title, $templatesModel->text);
					}
				}
			}
	}
	
	//Создает событие у менеджера когда наступило время
	public function manager() {
		// Дата информирования менеджера
		$projectsModel = Zakaz::model()->findAll();
		foreach ($projectsModel as $project) {
			$dateStart = strtotime(date('Y-m-d H:i',time())) - (self::INTERVAL * 60);
			if (strtotime(date('Y-m-d H:i',strtotime($project->manager_informed))) >= $dateStart && strtotime(date('Y-m-d H:i',strtotime($project->manager_informed))) < strtotime(date('Y-m-d H:i',time()))) {
			//if (strtotime(date('Y-m-d H:i',strtotime($project->manager_informed))) == strtotime(date('Y-m-d H:i',time()))) {
				Yii::import('application.modules.project.components.EventHelper');
				EventHelper::managerInformed($project->id);
			}
		}
		
		// У части заказа незавершенного заказа
		$projectsPartsModel = ZakazParts::model()->findAllByAttributes(array('status_id'=>'1'));
		foreach ($projectsPartsModel as $projectStage) {
			$dateStart = strtotime(date('Y-m-d H:i',time())) - (self::INTERVAL * 60);
			if (strtotime(date('Y-m-d H:i',strtotime($projectStage->date))) >= $dateStart && strtotime(date('Y-m-d H:i',strtotime($projectStage->date))) < strtotime(date('Y-m-d H:i',time()))) {
			//if (strtotime(date('Y-m-d H:i',strtotime($projectStage->date))) == strtotime(date('Y-m-d H:i',time()))) {
				Yii::import('application.modules.project.components.EventHelper');
				EventHelper::stageExpired($projectStage->proj_id);
			}
		}
	}
}