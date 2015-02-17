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
        <? foreach ($events as $event) {?>
         <tr>
            <td><?=$event->id?></td>
            <td><?=$event->description?></td>
            <td>
                <? if($event->type == EventHelper::TYPE_CREATE_ORDER) {?>
                    <a href="<?=Yii::app()->createUrl('project/zakaz/preview', array('id' => $event->id))?>">Посмотреть</a>
                <?}?>

                <?
                // пока так потом будет как я понял своя реализация для каждого типа
                if(
                    $event->type == EventHelper::TYPE_EDIT_ORDER ||
                    $event->type == EventHelper::TYPE_ADD_CHANGES ||
                    $event->type == EventHelper::TYPE_MESSAGE
                ) {?>
                    <a href="<?=Yii::app()->createUrl('project/zakaz/update', array('id' => $event->event_id))?>">Заказ</a>
                <?}?>

                <? if($event->type == EventHelper::TYPE_NOTIFICATION) {?>
                    <td> Ссылка отсутствует</td>
                <?}?>
            </td>
            <td><?=date("Y-m-d H:i", $event->timestamp)?></td>
         </tr>
        <?}?>
    </table>
</div>