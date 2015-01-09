<div class="events">
    
    <h2>События</h2>
   
    <table class="table table-striped" style="text-align: justify; width: 100%;">
        <thead>
            <th>
                id
            </th>
            <th>
                description
            </th>
            <th>
                eventLink
            </th>
            <th>
                time
            </th>
        </thead>
        <?php 
        
            foreach ($events as $event) {
                echo '<tr>';
                echo '<td>'.$event->id.'</td>';
                echo '<td>'.$event->description.'</td>';
                $href = Yii::app()->createUrl('project/zakaz/update', array('id' => $event->event_id));
                switch ($event->type) {
                    case EventHelper::TYPE_CREATE_ORDER:
                    case EventHelper::TYPE_EDIT_ORDER:
                    case EventHelper::TYPE_ADD_CHANGES:
                    case EventHelper::TYPE_MESSAGE:
                        echo '<td><a href="'.$href.'">Заказ</a></td>';
                        break;
                    case EventHelper::TYPE_NOTIFICATION:
                        echo '<td> Ссылка отсутствует</td>';
                }
                echo '<td>'.date("Y-m-d H:i", $event->timestamp).'</td>';
                
                echo '</tr>';
            }
        
        ?>
    </table>
</div>