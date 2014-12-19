<?php

if($this->getAction()->getId()!='inbox') 
$this->breadcrumbs=array(
		ucfirst(Yii::t('MailboxModule.mailbox', 'Mailbox'))=>array('inbox'),
		ucfirst($this->getAction()->getId()) 
);
else
	$this->breadcrumbs=array($this->module->id);

$this->renderpartial('_menu');

if(isset($_GET['Message_sort']))
	$sortby = $_GET['Message_sort'];
elseif(isset($_GET['Mailbox_sort']))
	$sortby = $_GET['Mailbox_sort'];
else
	$sortby = '';
$ie6br = <<<EOD
<!--[if lt IE 6]>
<br clear="all" />
<![endif]-->
EOD;
echo '<div id="mailbox-list" class="mailbox-list ui-helper-clearfix" sortby="'.$sortby.'">';

$this->renderpartial('_flash');

if($dataProvider->getItemCount() > 0) {
?>
<form id="message-list-form" action="<?php echo $this->createUrl($this->getId().'/'.$this->getAction()->getId()); ?>" method="post">
	<input type="hidden" class="mailbox-count" name="ui[]" value="<?php echo $dataProvider->getItemCount(); ?>" />
	<input type="hidden" class="mailbox-sortby" name="ui[]" value="<?php echo $sortby; ?>" />
	<div class="mailbox-clistview-container ui-helper-clearfix">
	<?php
	if($dataProvider->getItemCount() > 1 && $this->getAction()->getId() != 'sent') : ?>
		<div class="btn-group mailbox-checkall-buttons">
			<button class="checkall" /><?=Yii::t('MailboxModule.mailbox', 'Check All')?></button>
			<button class="uncheckall" /><?=Yii::t('MailboxModule.mailbox', 'Uncheck All')?></button>
		</div>
	<?php
	endif;

$this->widget('zii.widgets.CListView', array(
    'id'=>'mailbox',
    'dataProvider'=>$dataProvider,
    'itemView'=>'_list',
    'itemsTagName'=>'table',
    'template'=>'<div class="mailbox-summary">{summary}</div>{sorter}'.$ie6br.'<div id="mailbox-items" class="ui-helper-clearfix">{items}</div>{pager}',
    'sortableAttributes'=>$this->getAction()->getId()=='sent'?
	array('created'=>Yii::t('MailboxModule.mailbox', 'Date Sent')) :
	array('modified'=>Yii::t('MailboxModule.mailbox', 'Date Received')),
    'loadingCssClass'=>'mailbox-loading',
    'ajaxUpdate'=>'mailbox-list',
    'afterAjaxUpdate'=>'$.yiimailbox.updateMailbox',
    'emptyText'=>'<div style="width:100%"><h3>'.Yii::t('MailboxModule.mailbox', 'You have no mail in your folder ').$this->getAction()->getId().'.</h3></div>',
    //'htmlOptions'=>array('class'=>'ui-helper-clearfix'),
    'sorterHeader'=>'',
    'sorterCssClass'=>'mailbox-sorter',
    'itemsCssClass'=>'mailbox-items-tbl ui-helper-clearfix',
    'pagerCssClass'=>'mailbox-pager',
    //'updateSelector'=>'.inbox',
));
?>
	<?php if($this->getAction()->getId()!='sent') : ?>
<div style="clear:left"> <span class="mailbox-buttons-label"><?=Yii::t('MailboxModule.mailbox', 'With selected:')?></span>
		<?php if($this->getAction()->getId()=='trash') : ?>
	<input type="submit" id="mailbox-action-restore" class="btn mailbox-button" name="button[restore]" value="<?=Yii::t('MailboxModule.mailbox', 'restore')?>" />
	<input type="submit" id="mailbox-action-delete" class="btn mailbox-button" name="button[delete]" value="<?=Yii::t('MailboxModule.mailbox', 'delete forever')?>" />
		<?php else: ?>
			<?php if(!$this->module->readOnly || ( $this->module->readOnly && !$this->module->isAdmin()) ): ?>
	<input type="submit" id="mailbox-action-delete" class="btn mailbox-button" name="button[delete]" value="<?=Yii::t('MailboxModule.mailbox', 'delete')?>" />
			<?php endif; ?>
	<input type="submit" id="mailbox-action-read" class="btn mailbox-button" name="button[read]" value="<?=Yii::t('MailboxModule.mailbox', 'read')?>" />
	<input type="submit" id="mailbox-action-unread" class="btn mailbox-button" name="button[unread]" value="<?=Yii::t('MailboxModule.mailbox', 'unread')?>" />
		<?php endif; ?>
</div>
	<?php endif; ?>
	</div>
</form>

<?php

}
else {
	$this->renderpartial('_empty');
} 
?>
</div>

<script type="text/javascript">
/*<![CDATA[*/
jQuery(function($) {
	$('.message-subject').hide();
});
/*]]>*/
</script>