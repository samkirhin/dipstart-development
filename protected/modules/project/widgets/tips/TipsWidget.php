<?php

class TipsWidget extends CWidget{

    public $project;
    protected $statusArr = [
        'is_just_enter', // Заказ только поступил
        'is_wait_customer_decision_without_cash', // Ждем решения заказчика (если нет предоплаты еще)
        'is_wait_customer_decision_about_stage', // Ждем решения заказчика (по утверждению этапа)
        'is_wait_customer_decision_about_all', // Ждем решения заказчика (по утврждению всей работы)
        'is_enter_prepayments', // Внесение предполаты заказчиком
        'is_no_author_after_mail', // Нет ни одного автора спустя сутки после рассылки
        'is_enter_cost', // Исполнитель написал свое предложение на новый заказ
        'is_sent_stage', // Исполнитель выслал этап работы
        'is_not_sent_stage_on_time', // Исполнитель не выслал этап в срок
        'is_not_sent_all_on_time', // Исполнитель не выслал в срок работу
        'is_set_new_executors', // Назначение нового автора (после снятия предыдущего)
        'is_new_message', // Сообщение в чате
        'is_new_changes', // Появились доработки к работе
        'is_time_passed', // Дата и время выполнения прошли (от заказчика)
    ];

    public function init() {
    }

    public function checkStatus($statusId) {
        switch ($statusId) {
            case 'is_just_enter':
                return true;
                break;

            case 'is_wait_customer_decision_without_cash':
                return true;
                break;

            case 'is_wait_customer_decision_about_stage':
                return true;
                break;

            case 'is_wait_customer_decision_about_all':
                return true;
                break;

            case 'is_enter_prepayments':
                return true;
                break;

            case 'is_no_author_after_mail':
                return true;
                break;

            case 'is_enter_cost':
                return true;
                break;

            case 'is_sent_stage':
                return true;
                break;

            case 'is_not_sent_stage_on_time':
                return true;
                break;

            case 'is_not_sent_all_on_time':
                return true;
                break;

            case 'is_set_new_executors':
                return true;
                break;

            case 'is_new_message':
                return true;
                break;

            case 'is_new_changes':
                return true;
                break;

            case 'is_time_passed':
                return true;
                break;
        }
    }

    public function getStatus() {
        $currentStatus = array();
        foreach ($this->statusArr as $item)
        {
            if ($this->checkStatus($item))
                $currentStatus[] = $item;
        }
        return $currentStatus;
    }

    public function run() {
    	$statuses = $this->getStatus();
        $tips = array();
        foreach ($statuses as $item)
        {
            $tip = Templates::model()->findByAttributes([
                'type_id' => 5,
                'name' => $item,
            ]);
            if ($tip)
                $tips[] = $tip;
        }

    	$this->render('view', array(
            'tips' => $tips
        ));
    }
}
