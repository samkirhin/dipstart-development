<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 05.05.15
 * Time: 15:55
 */
if ($this->status_id > 2 || !User::model()->isCustomer()) {
?>
<div class="col-xs-12">
	<div class="row zero-edge">
		<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="partStatus">
						<div class="partStatus-header"><?=ProjectModule::t("Status").':' ?></div>
						<div class="partStatus-status" id="partStatus-status-<?= $this->record_id ?>"><?= $this->status ?></div>
					</div>	
					<div class="partStatus-bottom"></div>
					<div class="title-name">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion"
							   href="#collapseOne<?php echo $data['id']; ?>" id="part_title_<?php echo $data['id']; ?>">
								<?php echo $data['title']; ?>
							</a>
						</h4>
					</div>
					<?php if (User::model()->isAuthor()) { ?>
					<div class="title-time"><?= ProjectModule::t("Date Finish").':' ?><br />
						<?php echo $data['dbdate']; ?>
					</div>
					<?php } ?>
				</div>

				<?php if ((User::model()->isExecutor($data['proj_id']) && (int)$this->status_id < 2)
						|| (User::model()->isOwner($data['proj_id']) && (int)$this->status_id == 3)){
						if (User::model()->isCustomer()) $buttonValue = ProjectModule::t('Approve stage');
						else $buttonValue = ProjectModule::t('Stage ready');?>
				<input id="zakaz-done-<?= $this->record_id ?>" name="zakaz-done-<?= $this->record_id ?>" class="btn btn-primary btn-block" value="<?=$buttonValue?>" type="button" onclick="zakaz_done(<?= $this->record_id ?>); return false;">
				<input id="zakaz-done-hidden-<?= $this->record_id ?>" name="zakaz-done-hidden-<?= $this->record_id ?>" class="btn btn-primary btn-block" type="hidden" value="<?= (int)$this->status_id ?>">
				<?php }
				if (User::model()->isAuthor() || (User::model()->isCustomer() && (int)$this->status_id > 2)){
				?>
				<div id="collapseOne<?php echo $data['id']; ?>" class="panel-collapse collapse in">
					<div class="panel-body">
						<?php
						if (User::model()->isAuthor()) {
							?>
							<p><?php echo $data['comment']; ?></p>
						<?php }	?>
						<div class="part_files">
							<?php foreach ($data['files'] as $k => $v){
								if (User::model()->isAuthor() || $v['approved']) {
									$class = $v['approved'] ? '' : ' class="gray"';
									echo '<div class="row">'.
										'<a'.$class.' target="_blank" href="'.
											ZakazPartsFiles::model()->folder(). $v['part_id'] . '/' . $v['file_name'] .
											'" title="'.$v['orig_name'].'" data-part="' . $data['id'] . '">'.$v['orig_name'].
										'</a>'.
										'</div>';
								}
							} ?>
						</div>
						<?php if (User::model()->isExecutor($data['proj_id'])) $this->widget('ext.EAjaxUpload.EAjaxUpload',
							array(
								'id' => 'EAjaxUpload' . $data['id'],
								'config' => array(
									'action' => Yii::app()->createUrl('/project/zakazParts/upload', array('proj_id' => $data['proj_id'], 'id' => $data['id'])),
									'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>'.ProjectModule::t('Drag and drop files here').'</span></div><div class="qq-upload-button">'.ProjectModule::t("Upload material").':</div><ul class="qq-upload-list"></ul></div>',
									'disAllowedExtensions' => array('exe'),
									'sizeLimit' => 10 * 1024 * 1024,// maximum file size in bytes
									'minSizeLimit' => 10,// minimum file size in bytes
									'onComplete' => "js:function(id, fileName, responseJSON){}"
								)
							)
						);
						?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>
