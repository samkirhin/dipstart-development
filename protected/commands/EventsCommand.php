<?php
class EventsCommand extends CConsoleCommand {
	
    public function run($args) {
		self::executor();
		self::manager();
    }
	
	// Событие у исполнителя - отправляет шаблон на емаил уведомление об этом (берем из справочника)
	public function executor() {
		$usersModel = User::findAllExecutors();
		if (is_array($usersModel))
			foreach ($usersModel as $user) {
				
				$profileModel = Profile::model()->findByPk($user->id);
				if ($profileModel===null) throw new CHttpException(404, 'Данные профиля пользователя не найдены.');
				
				if ($profileModel->notification == '1') {
					foreach ($user->zakaz as $zakaz) {
						$time = explode(';', $profileModel->notification_time); // время X, за которое надо уведомлять (количество часов и минут), формат "5;48"
						$date = date('Y-m-d H:i',strtotime($zakaz->author_informed));
						$date = strtotime($date)-(int)$time[0]*60*60-(int)$time[1]*60;
						if (strtotime(date('Y-m-d H:i',time())) == $date) {
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
	}
	
	//Создает событие у менеджера когда наступило время
	public function manager() {
		// Дата информирования менеджера
		$projectsModel = Zakaz::model()->findAll();
		foreach ($projectsModel as $project) 
			if (strtotime(date('Y-m-d H:i',strtotime($project->manager_informed))) == strtotime(date('Y-m-d H:i',time()))) {
				Yii::import('project.components.EventHelper');
				EventHelper::notification('description', $project->id);
			}
		
		// У части заказа незавершенного заказа
		$projectsPartsModel = ZakazParts::model()->findAllByAttributes(array('status_id'=>'1'));
		foreach ($projectsPartsModel as $project) 
			if (strtotime(date('Y-m-d H:i',strtotime($project->date))) == strtotime(date('Y-m-d H:i',time()))) {
				Yii::import('project.components.EventHelper');
				EventHelper::notification('description', $project->proj_id);
			}
	}
}