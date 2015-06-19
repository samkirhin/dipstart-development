<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>
<?
/**
 * @author Emericanec
 */
?>
<div class="events">
    
    <h2>События</h2>
   <div class="row white-block">
       <div class="col-xs-12">
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
                <?php switch ($event->type) {
                    case EventHelper::TYPE_UPDATE_PROFILE:
                        echo CHtml::link(
                                'Посмотреть',
                                Yii::app()->createUrl('user/profile/previewUpdate', ['id' => $event->event_id])    
                            );
                    break;
                    case EventHelper::TYPE_NOTIFICATION:
                        echo '<td> Ссылка отсутствует</td>';
                    break;
                    default:
                        echo CHtml::link('Посмотреть', ['/project/zakaz/preview', 'id' => $event->id]); 
                    break;
                }?>
            </td>
            <td><?php echo date("Y-m-d H:i", $event->timestamp); ?></td>
         </tr>
        <?php } ?>
    </table>
    </div>
   </div>
</div>