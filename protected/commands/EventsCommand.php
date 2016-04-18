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
				if ($user->profile->notification == '1') {
					foreach ($user->zakaz as $zakaz) {
						$time = explode(';', $user->profile->notification_time); // время X, за которое надо уведомлять (количество часов и минут), формат "5;48"
						$date = date('Y-m-d H:i',strtotime($zakaz->author_informed));
						$date = strtotime($date)-(int)$time[0]*60*60-(int)$time[1]*60;
						if (strtotime(date('Y-m-d H:i',time())) == $date) {
							$templatesModel = Templates::model()->findByPk(21);
							// Отправляем письмо
						}
					}
				}
			}
	}
	
	//Создает событие у менеджера когда наступило время
	public function manager() {
		// Дата информирования менеджера
		$projectsModel = Zakaz::model()->findAll();
		foreach ($projectsModel as $project) {
			if (strtotime(date('Y-m-d H:i',strtotime($project->manager_informed))) == strtotime(date('Y-m-d H:i',time()))) {
				$eventsModel = new Events();
				$eventsModel->type = '000';
				$eventsModel->event_id = $project->id;
				$eventsModel->timestamp = time();
				$eventsModel->status = '000';
				$eventsModel->save();
			}
		}
		
		// У части заказа незавершенного заказа
		$projectsPartsModel = ZakazParts::model()->findAllByAttributes(array('status_id'=>'1'));
		foreach ($projectsPartsModel as $project) {
			if (strtotime(date('Y-m-d H:i',strtotime($project->date))) == strtotime(date('Y-m-d H:i',time()))) {
				$eventsModel = new Events();
				$eventsModel->type = '000';
				$eventsModel->event_id = $project->proj_id;
				$eventsModel->timestamp = time();
				$eventsModel->status = '000';
				$eventsModel->save();
			}
		}
	
	}
}