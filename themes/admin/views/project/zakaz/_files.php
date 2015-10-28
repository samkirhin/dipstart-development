<?php if(!Yii::app()->user->isGuest):?>
<div><?=Yii::t('site','Select a Background image')?> <a href='#' id='file-picker'><?=Yii::t('site','click here')?></a></div>
<div id='file-picker-viewer'>
    <div class='body'></div>
    <hr/>
    <div id='myuploader'>
    <label rel='pin'><b><?=Yii::t('site','Upload Files')?> <img style='float: left;' src='images/pin.png'></b></label>
    <br/>
    <div class='files'></div>
    <div class='progressbar'>
    	<div style='float: left;'><?=Yii::t('site','Uploading your file(s), please wait...')?></div>
    	<img style='float: left;' src='images/progressbar.gif' />
    	<div style='float: left; margin-right: 10px;'class='progress'></div>
    	<img style='float: left;' class='canceljob' src='images/delete.png' title="<?=Yii::t('site','cancel the upload')?>"/>
    </div>
    </div>
    <hr/>
    <button id='select_file' class='ok_button'><?=Yii::t('site','Select File(s)')?></button>
    <button id='delete_file' class='delete_button'><?=Yii::t('site','Delete Selected File(s)')?></button>
    <button id='close_window' class='cancel_button'><?=Yii::t('site','Close Window')?></button>
</div>
<?php
        $filelist = Yii::app()->fileman->list_files(Yii::app()->session['project_id']);
        foreach ($filelist as $fd) {
          $real_path = Yii::app()->fileman->get_file_path($fd['id'], $fd['file_id']);
          echo CHtml::link($fd['filename'],  array('zakaz/download','path' => $real_path)).'&nbsp;&nbsp;';
          //echo EDownloadHelper::download($real_path);
        }
// the widget
//
$this->widget('application.components.MyYiiFileManViewer'
    ,array(
        // layout selectors:
        'launch_selector'=>'#file-picker',
        'list_selector'=>'#file-picker-viewer',
        'uploader_selector' => '#myuploader',
        // messages:
        'delete_confirm_message' => 'Confirm deletion ?',
        'select_confirm_message' => 'Confirm selected items ?',
        'no_selection_message' => 'You are required to select some file',
        // events:
        'onBeforeAction'=>"function(viewer,action,file_ids) { return true; }",
        'onAfterAction'=>"function(viewer,action,file_ids, ok, response) {}",
        // 'onBeforeLaunch'=>"function(_viewer){ }",
        'onClientSideUploaderError'=>
        	"function(messages){
        		$(messages).each(function(i,m){
        			alert('error '+m);
        		});
        	}
        ",
        'onClientUploaderProgress'=>"function(status, progress){
        	// $('#logger').append('progress: '+status+' '+progress+'%<br/>');
    }",
));?>
<?php endif; ?>