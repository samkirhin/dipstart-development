<?php

class ModerationHelper {

	public static function saveToModerate($model, $data, $time) {

		$data[date] = $time[date];
		$data[date_finish] = $time[date_finish];
		$data[max_exec_date] = $time[max_exec_date];
		$data[manager_informed] = $time[manager_informed];
		$data[author_informed] = $time[author_informed];

		$moderData = new Moderation;
		foreach ($model->attributes as $key=>$val) {
			if ($key == 'id') {
				$moderData->order_id = $val;
			} else {
				$moderData->$key = $val;
			}
		}
		$changed = false;
		foreach ($data as $name=>$value) {
			if (($value != $moderData->$name) && ($name != 'id')) {
				$moderData->$name = $value;
				$changed = true;
			}
		}
		if ($changed) {
			$moderData->event_creator_id = Yii::app()->user->id;
			$moderData->timestamp = time();
			$moderData->save();
		}

		return true;
	}

	public static function isOrderChanged($id) {

		$model = Moderation::model()->find('`order_id` = :ID', array(
				'ID'=>$id
			));
		if ($model) {
			return true;
		} else {
			return false;
		}
	}

	public static function clear($id) {
		$model = Moderation::model()->deleteAll('`order_id` = :ID', array(
				'ID'=>$id
			));
	}

}
