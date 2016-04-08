<div class="col-xs-12 tips-content">
	<h4><?=ProjectModule::t('Tips')?></h4>
	<div class="tips-list">
	<?php foreach ($tips as $tip) { ?>
		<div class="tips-item">
			<div class="tips-item_title"><?php echo CHtml::link(CHtml::encode($tip->title), array('tips/view', 'id'=>$tip->id)); ?></div>
			<div class="tips-item_text"><?=$tip->text?></div>
		</div>
	<?php } ?>
	</div>
</div>