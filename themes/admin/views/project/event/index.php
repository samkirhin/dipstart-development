<?php
    Yii::app()->clientScript->registerScriptFile('/js/event.js');
    Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>
<?
/**
 * @author Emericanec
 */
?>
<div class="events">
    <h2><?=ProjectModule::t('Events')?></h2>
   <div class="row white-block">
<!--<<<<<<< HEAD
       <div class="col-xs-12">
    <table class="table table-striped" style="text-align: justify; width: 100%;">
        <thead>
            <th>
                <?=ProjectModule::t('id')?>
            </th>
            <th>
                <?=ProjectModule::t('Description')?>
            </th>
            <th>
                <?=ProjectModule::t('Link')?>
            </th>
            <th>
                <?=ProjectModule::t('Date and time')?>
            </th>
        </thead>
        <?php foreach ($events as $event) {?>
         <tr>
            <td><?php echo $event->id?></td>
            <td><?php echo ProjectModule::t($event->description).' '?><a href="http://<?= $_SERVER['SERVER_NAME'] ?>/project/zakaz/update/id/<?= $event->event_id ?>"><?= '#'.$event->event_id ?></a></td>
            <td>
				<?php 
				echo CHtml::button(Yii::t('site','Delete'),array('onclick'=>'this.parentNode.parentNode.style.display=\'none\';$.post("'.Yii::app()->createUrl('project/event/delete',array('id'=>$event->id)).'",function(xhr,data,msg){ /*alert(xhr.msg);*/},"json");'));
                switch ($event->type) {
                    case EventHelper::TYPE_EDIT_ORDER:
                    case EventHelper::TYPE_UPDATE_PROFILE:
                        echo CHtml::link(
                                Yii::t('site','Show'),
                                Yii::app()->createUrl('moderate/index', ['id' => $event->id])
                            );
                    break;
                    case EventHelper::TYPE_NOTIFICATION:
                        //echo '<td>'.Yii::t('site','Link is absent').'</td>';
                    //break;
                    case EventHelper::TYPE_MESSAGE:
					case EventHelper::TYPE_ORDER_MANAGER_INFORMED:
					case EventHelper::TYPE_ORDER_STAGE_EXPIRED:
                    default:
                        echo CHtml::link(Yii::t('site', 'Show'), ['/project/zakaz/preview', 'id' => $event->id]);
                    break;
                }?>
            </td>
            <td><?php echo date("Y-m-d H:i", $event->timestamp); ?></td>
         </tr>
        <?php } ?>
    </table>
    </div>
=======-->
        <div class="col-xs-12 events-list">
            <?php $this->renderPartial('list',array('events'=>$events));?>
        </div>
   </div>
</div>  

<audio id="is-new-event" src="/audio/new_event.wav"></audio>
<audio id="is-new-order" src="/audio/new_order.wav"></audio>
