<?
/**
 * @author Emericanec
 */
?>
<div class="events">
    
    <h2><?= ProjectModule::t('Events') ?></h2>
   
    <table class="table table-striped" style="text-align: justify; width: 100%;">
        <thead>
            <th>
                id
            </th>
            <th>
                <?= ProjectModule::t('description') ?>
            </th>
            <th>
                <?= ProjectModule::t('eventLink') ?>
            </th>
            <th>
                <?= ProjectModule::t('time') ?>
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
                                ProjectModule::t('View'),
                                Yii::app()->createUrl('user/profile/previewUpdate', ['id' => $event->event_id])    
                            );
                    break;
                    case EventHelper::TYPE_NOTIFICATION:
                        echo '<td>'.ProjectModule::t('Reference is absent').'</td>';
                    break;
                    default:
                        echo CHtml::link(ProjectModule::t('View'), ['/project/zakaz/preview', 'id' => $event->id]); 
                    break;
                }?>
            </td>
            <td><?php echo date("Y-m-d H:i", $event->timestamp); ?></td>
         </tr>
        <?php } ?>
    </table>
</div>