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
		<?=ProjectModule::t('Deadline');?>:
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
			//echo '<div class="row">';
			if ($v['id']!=0) echo '<a href="' . $v['file_name'] . '" id="parts_file" data-part="' . $data['id'] . '">';
			if (User::model()->isAuthor() || ($v['id']!=0)) echo $v['orig_name'];
			if ($v['id']!=0) echo '</a>';
			//echo '</div>';
			echo '<br>';
		} ?>
	</div>
	<div class="clear"></div>
</div>