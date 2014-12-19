#YiiFileManagerFilePicker

is a widget for Yii Framework based web applications, allows your web users to manage their files online. 

##Author

- Christian Salazar <christiansalazarh@gmail.com> @salazarchris74  (bluyell yii forum profile)
- [Google+ Profile](http://goo.gl/RDWjdG)

##License

- [Free BSD](http://opensource.org/licenses/bsd-license.php)

##Requirements

- Yii 1.1.13 (use CJavaScriptExpression to handle javascript events)
- PHP 5.3.3-7 (not tested in lower php versions)

##Features

- File Browser (pictures, non-pictures)
- Rename Files
- Delete Files
- Automatic Picture Thumbnail (no large files crunched)
- Ajax based.
- Multiple File Uploader with Progress bar (ajax based)
- Css Customizable
- Html Customizable
- Extensible
- Event handlers  (client-side / server-side)

##Dependencies

This widget depends on [YiiFileManager Extension](http://www.yiiframework/extensions/yiifilemanager) in order
to handle the user's files. You must first install it.


##Screenshots

![Pure Yii example][1]

##Installation

- Install it in your protected/extensions/ folder

		cd yourapp\protected\extensions
		git clone https://bitbucket.org/christiansalazarh/yiifilemanagerfilepicker.git

- Register the extension path in your config/main file

		'import'=>array(
			'application.models.*',
			'application.components.*',
			'application.extensions.yiifilemanager.*',  // (this must exists if you realize the dependencies)
			'application.extensions.yiifilemanagerfilepicker.*',  // <<< HERE *****
		),

- install a static action in any controller:

		class SiteController extends Controller
		{
			public function actions()
			{
				return array(
					'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
					),
					'page'=>array(
						'class'=>'CViewAction',
					),
					'yiifilemanagerfilepicker'=>
						array('class'=>
							'ext.yiifilemanagerfilepicker.YiiFileManagerFilePickerAction'),
				);
			}
		 }

	please note: if you're not using the default siteController as default for your static action
	then provide the controller name (and/or action name) in your class: yiifileman_data(), see below.


- copy the provided client class 

		'protected/extensions/yiifilemanagerfilepicker/demo-component/MyYiiFileManViewer.php'  (full documented)

	into your own:

		'protected/components/MyYiiFileManViewer.php'

	(the method documentation has been removed here for clarification. Be carefull with
	Yii::app()->fileman, this is the this file manager previously installed, see about Dependencies.)

		<?php
		class MyYiiFileManViewer extends YiiFileManagerFilePicker
				implements IYiiFileManagerFilePicker
		{
			public function yiifileman_classname(){
				return __CLASS__;
			}

			public function yiifileman_data(){
				return array(
					'gallery_size'=>array(160,120),
					// for demostration:	
						'identity'=>'123456', 
					// USE IN A REAL SITUATION: 
						//	'identity'=>Yii::app()->user->id,
					'fileman'=>Yii::app()->fileman,		// <-- BE CAREFULL
					'allow_multiple_selection'=>true,
					'allow_rename_files'=>true,
					'allow_delete_files'=>true,
					'allow_file_uploads'=>true,
					// optionals:
					// 'controller'=>'site',
					// 'action'=>'yiifilemanagerfilepicker' 
				);	
			}

			public function build_file_viewer_url($file_id){
				return parent::build_file_viewer_url($file_id);
			}

			public function yiifileman_filter_file_list($list, $extra=array()){
				return $list;
			}

			public function yiifileman_get_image_substitution($file_info, $local_path, $mimetype){
				return parent::yiifileman_get_image_substitution($file_info, $local_path, $mimetype);
			}

			public function yiifileman_on_action($action, $file_ids){
				// call parent to perform default stuff
				return parent::yiifileman_on_action($action, $file_ids);
			}

			public function yiifileman_accept_file($filename,$filesize, $mimetype,
				$is_server_side, &$reason){
				return true;
			}

			public function yiifileman_on_file_saved($file_id){
			}
		}

##Using the widget

Once you have installed the required class (see installation steps) now you can insert the widget in any view. Because 
the component is extensible, then you must provide the required html layout for your file picker

Suppose you require your user to click an icon in order to display the widget, so simply: create a link or 
anything else and pass its jquery selector to the widget:  'launch_selector'=>'#file-picker',
	
Now, suppose you doesnt require a launch icon, so put Nothing in the 'launch_selector' widget attribute, this cause the 
widget to display it's content inmediatly in the 'list_selector' (ie: #file-picker-view)

the layout pointed by the selector '#file-picker-viewer' will be used to render the file picker. later you'll find a jQueryUI example using this widget.

- copy the demo icons in order to make this demo works: (demo icons are not a dependency)

		'yourapp/protected/extensions/yiifilemanagerfilepicker/demo-images'  (demo icons)

to:

		'yourapp/images/'

- copy this content into any view, as demo use: 'protected/views/site/index.php'

		<!-- using protected/views/site/index.php AS DEMO, you can use any view -->

		<div>Select a Background image: <a href='#' id='file-picker'>click here</a>
			<img src='' width='50%' id='selected-image' />
		</div>

		<!-- required div layout begins - 
			DO NOT INSERT NESTED INTO AN EXISTING FORM TAG. 
				ie: <FORM>..here?NO..</FORM> -->
		<div id='file-picker-viewer'>
			<div class='body'></div>
			<hr/>
			<div id='myuploader'>
				<label rel='pin'><b>Upload Files <img style='float: left;' src='images/pin.png'></b></label>
				<br/>
				<div class='files'></div>
				<div class='progressbar'>
					<div style='float: left;'>Uploading your file(s), please wait...</div>
					<img style='float: left;' src='images/progressbar.gif' />
					<div style='float: left; margin-right: 10px;'class='progress'></div>
					<img style='float: left;' class='canceljob' src='images/delete.png' title='cancel the upload'/>
				</div>
			</div>
			<hr/>
			<button id='select_file' class='ok_button'>Select File(s)</button>
			<button id='delete_file' class='delete_button'>Delete Selected File(s)</button>
			<button id='close_window' class='cancel_button'>Close Window</button>
		</div>
		<!-- required div layout ends -->

		<hr/>
		Logger:<br/>
		<div id='logger'></div>

		<?php
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
				'onAfterAction'=>"function(viewer,action,file_ids, ok, response) { 
					if(action == 'select'){ // actions: select | delete
						$.each(file_ids, function(i, item){ 
							$('#logger').append('file_id='+item.file_id 
								+ ', <img src=\''+item.url+'&size=full\'><br/>');
						});
					}
				}",
				// 'onBeforeLaunch'=>"function(_viewer){ }",
				'onClientSideUploaderError'=>
					"function(messages){ 
						$(messages).each(function(i,m){ 
							alert(m); 
						}); 
					}
				",
				'onClientUploaderProgress'=>"function(status, progress){
					// $('#logger').append('progress: '+status+' '+progress+'%<br/>');
				}",
			));
		?>

		<!-- end of protected/views/site/index.php -->

##jQuery-UI

It is very simple to display this widget into a jQueryUI based dialog, the same applies to a different UI
providers.

![using jQuery-UI][2]

		<div>Select a Background image: <a href='#' id='file-picker'>click here</a>
			<img src='' width='50%' id='selected-image' />
		</div>

		<!-- required div layout begins - 
			DO NOT INSERT NESTED INTO AN EXISTING FORM TAG. 
				ie: <FORM>..here?NO..</FORM>-->
		<div id='file-picker-viewer'>
			<div class='body'></div>
			<hr/>
			<div id='myuploader'>
				<label rel='pin'><b>Upload Files <img style='float: left;' src='images/pin.png'></b></label>
				<br/>
				<div class='files'></div>
				<div class='progressbar'>
					<div style='float: left;'>Uploading your file(s), please wait...</div>
					<img style='float: left;' src='images/progressbar.gif' />
					<div style='float: left; margin-right: 10px;'class='progress'></div>
					<img style='float: left;' class='canceljob' src='images/delete.png' title='cancel the upload'/>
				</div>
			</div>
			<!-- THIS BUTTONS ARE NOT REQUIRED WHEN jQUERY-UI IS ACTIVE !
			<hr/>
			<button id='select_file' class='ok_button'>Select File(s)</button>
			<button id='delete_file' class='delete_button'>Delete Selected File(s)</button>
			<button id='close_window' class='cancel_button'>Close Window</button>
			-->
		</div>
		<!-- required div layout ends -->

		<hr/>
		Logger:<br/>
		<div id='logger'></div>

		<?php
			// -- example using jquery ui ---
			$cs = Yii::app()->getClientScript();
			$cs->registerCoreScript('jquery.ui');
			// download a theme and install in your myapplication/themes/ directory
			$cs->registerCssFile("themes/sunny/jquery-ui.min.css"); // REQUIRE A THEME
			// --

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
				'onAfterAction'=>"function(viewer,action,file_ids, ok, response) { 
					if(action == 'select'){
						$.each(file_ids, function(i, item){ 
							$('#logger').append('file_id='+item.file_id 
								+ ', <img src=\''+item.url+'&size=full\'><br/>');
						});
						// required for jqueryUI
						viewer.dialog('close');// remove this line if you're not using jqueryui
					}
				}",
			
				'onBeforeLaunch'=>"function(_viewer){
					// example: using jQueryUI to present into a dialog box.
					_viewer.dialog({ 
						width: '800px',
						heigth: '800px',
						position: { my: 'center' , at: 'top' , of: window },
						buttons: [ 
							{ text: 'Select' , click: $.fn.yiiFilemanDialog_select },
							{ text: 'Delete' , click: $.fn.yiiFilemanDialog_delete },
							{ text: 'Cancel' , click: function(){ $(this).dialog('close'); } }
						] 
					});
					$('#myuploader input[name=submit]').button();
				}",
				/*
				'onClientSideUploaderError'=>
					"function(messages){ 
						$(messages).each(function(i,m){ 
							alert(m); 
						}); 
					}
				",
				*/
			));
		?>



[1]:https://bitbucket.org/christiansalazarh/yiifilemanagerfilepicker/downloads/snapshot.png
[2]:https://bitbucket.org/christiansalazarh/yiifilemanagerfilepicker/downloads/snapshot-2.png

<style>
	img {
		width: 50%;
	}
</style>
