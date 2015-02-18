<?
/**
 * @author Emericanec
 */
?>
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
        <?php foreach ($events as $event) {?>
         <tr>
            <td><?php echo $event->id?></td>
            <td><?php echo $event->description?></td>
            <td>
                <?php if($event->type == EventHelper::TYPE_CREATE_ORDER) {?>
                    <a href="<?php echo Yii::app()->createUrl('project/zakaz/preview', array('id' => $event->id)); ?>">Посмотреть</a>
                <?php } ?>

                <?php
                // пока так потом будет как я понял своя реализация для каждого типа
                if(
                    $event->type == EventHelper::TYPE_EDIT_ORDER ||
                    $event->type == EventHelper::TYPE_ADD_CHANGES ||
                    $event->type == EventHelper::TYPE_MESSAGE
                ) {?>
                    <a href="<?php echo Yii::app()->createUrl('project/zakaz/update', array('id' => $event->event_id));?>">Заказ</a>
                <?php } ?>

                <?php if($event->type == EventHelper::TYPE_NOTIFICATION) {?>
                    <td> Ссылка отсутствует</td>
                <?php } ?>
            </td>
            <td><?php echo date("Y-m-d H:i", $event->timestamp); ?></td>
         </tr>
        <?php } ?>
    </table>
</div>