<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 05.05.15
 * Time: 15:55
 */
if ($this->status_id > 2 || !User::model()->isCustomer()) {
	$readyToCustomerApprove = (User::model()->isOwner($data['proj_id']) && (int)$this->status_id == 3);
?>
<div class="col-xs-12 stage-block">
	<div class="row zero-edge">
		<div class="panel-group" id="stage-<?php echo $data['id']; ?>">
			<div class="panel panel-default">
				<div class="panel-heading  panel-heading-white">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#stage-<?php echo $data['id']; ?>" href="#collapseOne<?php echo $data['id']; ?>">
							<?= $data['title']; ?>
						</a>
					</h4>
					<?php if (User::model()->isAuthor()) { ?>
					<div class="partStatus">
						<div class="partStatus-half"><?=ProjectModule::t("Status").':' ?><br><span id="partStatus-status-<?= $this->record_id ?>"><?= $this->status ?></span></div>
						<div class="partStatus-half"><?= ProjectModule::t('Stage deadline').':' ?><br><?= $data['dbdate']; ?></div>
						<div class="clear"></div>
					</div>
					<?php } else { ?>
					<div class="partStatus"<?php if ($readyToCustomerApprove) echo ' style="display: none;"'; ?>>
						<div class="partStatus-header"><?=ProjectModule::t("Status").':' ?></div>
						<div class="partStatus-status" id="partStatus-status-<?= $this->record_id ?>"><?= $this->status ?></div>
						<div class="clear"></div>
					</div>
					<?php } ?>
				</div>

				<?php if ((User::model()->isExecutor($data['proj_id']) && (int)$this->status_id < 2) || $readyToCustomerApprove){
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
							echo '<p>'.$data['comment'].'</p>';
						}
						
						$uploaded_files = '';
						foreach ($data['files'] as $k => $v){
							if (User::model()->isAuthor() || $v['approved']) {
								$class = $v['approved'] ? '' : ' class="gray"';
								$uploaded_files .= '<li>'.
									'<a'.$class.' target="_blank" href="'.
										ZakazPartsFiles::model()->folder(). $v['part_id'] . '/' . $v['file_name'] .
										'" title="'.$v['orig_name'].'" data-part="' . $data['id'] . '">'.$v['orig_name'].
									'</a>'.
									'</li>';
							}
						} ?>
						<?php if (User::model()->isExecutor($data['proj_id'])) $this->widget('ext.EAjaxUpload.EAjaxUpload',
							array(
								'id' => 'EAjaxUpload' . $data['id'],
								'config' => array(
									'action' => Yii::app()->createUrl('/project/zakazParts/upload', array('proj_id' => $data['proj_id'], 'id' => $data['id'])),
									'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>'. ProjectModule::t('Drag and drop files here') .'</span><div class="qq-upload-button">'. ProjectModule::t('Attach materials to the order') .'</div><ul class="qq-upload-list">'.$uploaded_files.'</ul></div></div>',
									'disAllowedExtensions' => array('exe'),
									'sizeLimit' => Tools::maxFileSize(),// maximum file size in bytes
									'minSizeLimit' => 1,// minimum file size in bytes
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
