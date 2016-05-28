<div class="stage">
	<div class="stage-number">
		<?=$this->number;?>
	</div>
	<div class="stage-first-column">
		<?=ProjectModule::t('Title');?>:
	</div>
	<div class="stage-second-column">
		<?=$data['title'];?>
	</div>
	<div class="stage-first-column">
		<?=ProjectModule::t('Status');?>:
	</div>
	<div class="stage-second-column">
		<?=$this->status;?>
	</div>
	<div class="stage-first-column">
		<?=ProjectModule::t('Stage deadline');?>:
	</div>
	<div class="stage-second-column">
		<?=$data['dbdate'];?>
	</div>
	<div class="stage-first-column">
		<?=ProjectModule::t('Comment');?>:
	</div>
	<div class="stage-second-column">
		<?=$data['comment'];?>
	</div>
	<div class="stage-first-column">
		<?=ProjectModule::t('Files');?>:
	</div>
	<div class="stage-second-column">
		<?php foreach ($data['files'] as $k => $v){
			if ($v['approved']) {
				echo '<div class="stage-file">';
				echo '<a target="_blank" href="'.
					ZakazPartsFiles::model()->folder(). $v['part_id'] . '/' . $v['file_name'] .
					'" title="'.$v['orig_name'].'" data-part="' . $data['id'] . '">'.$v['orig_name'].
				'</a>';
				echo '</div>';
				echo '<br>';
			}
		} ?>
	</div>
	<div class="clear"></div>
</div>