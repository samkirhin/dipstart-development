<?php

/**
 * поведение для сохранения изменений у сущности
 */
class ModerateBehavior extends CActiveRecordBehavior
{
    private $old_attributes;
    
    public function afterFind($event)
    {
        $this->old_attributes = $this->owner->attributes;
    }
    
    public function beforeSave($event)
    {
        
        $tmp_event_id = 0;
        $is_change = false;
        
        $role = User::model()->getUserRole();
        
        if (!$this->owner->isNewRecord && $role != 'Manager' && $role != 'Admin') {
        
            $tmp_event_id = time();
            
            foreach ($this->old_attributes as $key => $value) {
                
                if ($key == 'max_exec_date') {
                    
                    $old_value = Yii::app()->dateFormatter->format($this->owner->dateTimeOutcomeFormat, strtotime($value));
                    $new_value = Yii::app()->dateFormatter->format($this->owner->dateTimeOutcomeFormat, strtotime($this->owner->max_exec_date));
                    
                    if ($old_value === $new_value) {
                        continue;
                    }
                    
                } else {
                    $old_value = $value;
                    $new_value = $this->owner->$key;
                }

                if ($old_value != $new_value && !(User::model()->isCorrector() && $key == 'technicalspec')) {
                    
                    $is_change = true;

                    $moderate = new Moderate;
                    $moderate->event_id = $tmp_event_id;
                    $moderate->class_name = get_class($this->owner);
                    $moderate->id_record = $this->owner->primaryKey;
                    $moderate->attribute = $key;
                    $moderate->old_value = $old_value;
                    $moderate->new_value = $new_value;
                    $moderate->save(false);

                }

            }
            
            if ($is_change) {
                
                Yii::import('application.modules.project.components.EventHelper');
                
                switch (get_class($this->owner))
                {
                    case 'Profile':
                        $event_id = EventHelper::updateProfile();
                        break;
                    case 'Zakaz':
                        $event_id = EventHelper::editOrder($this->owner->primaryKey);
                        break;
                }
                
                Moderate::model()->updateAll(['event_id'=>$event_id], 'event_id=:event_id', [':event_id'=>$tmp_event_id]);
            }

            if (User::model()->isCorrector() && ($this->owner->attributes['technicalspec'] != $this->old_attributes['technicalspec']))
                $this->old_attributes['technicalspec'] = $this->owner->attributes['technicalspec'];

            $this->owner->attributes = $this->old_attributes;
        }
    }
}