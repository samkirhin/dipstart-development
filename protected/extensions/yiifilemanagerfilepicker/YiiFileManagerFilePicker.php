<?php
/**
 * YiiFileManagerFilePicker
 *
 *	display a file picker. uses the YiiFileManager extension
 *

	1. a derivated class must implements this two methods:

	public function yiifileman_classname(){
   		return __CLASS__;
   	}

	public function yiifileman_data(){
		return array(
			'select_mode'=>'single',
			'identity'=>"123456",
			'fileman'=>Yii::app()->fileman,
		);	
	}

	LAYOUT:

	<!-- required div layout begins -->
	<div id='file-picker-viewer'>
		<div class='body'></div>
		<hr/>
		<div id='myuploader'>
			<label>Upload Files</label>
			<div class='files'></div>
			<div class='progressbar'>
				<div style='float: left;'>Uploading your file(s), please wait...</div>
				<img style='float: left;' src='images/progressbar.gif' />
				<div style='float: left; margin-right: 10px;'class='progress'></div>
				<img style='float: left;' class='canceljob' src='images/delete.png' title='cancel the upload'/>
			</div>
		</div>
		<button id='select_file' class='ok_button'>Select File(s)</button>
		<button id='delete_file' class='delete_button'>Delete Selected File(s)</button>
		<button id='close_window' class='cancel_button'>Close Window</button>
	</div>
	<!-- required div layout ends -->

 * @uses CWidget
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
include_once ("IYiiFileManagerFilePicker.php");
include_once ("YiiFilemanImageResizer.php");
abstract class YiiFileManagerFilePicker extends CWidget 
	/* depends on interface: IYiiFileManagerFilePicker */ {

	public $launch_selector='';		// "#file-picker" or leave empty
	public $list_selector;			// "#file-viewer" required
	public $uploader_selector;		// see also LAYOUT (id='myuploader') 
	public $file_uploaders=3;

	public $delete_confirm_message='';  // message string or empty to display nothing
	public $select_confirm_message='';
	public $no_selection_message='';
	public $upload_file_button_text='Upload';

	// the controller name and action name holding the 
	//	static action: YiiFileManagerFilePickerAction
	private $_default_action="yiifilemanagerfilepicker";
	private $_default_controller="site";

	public $onBeforeLaunch;		// launched before to start showing the viewer
	public $onBeforeAction;		// launched before the select or delete actions are to be taken
	public $onAfterAction;		// launched after select or delete action was taken
	public $onClientSideUploaderError;		// launched if files are so bigger or mime type not supported
	public $onClientUploaderProgress;

	private $_baseUrl;			// assets resource path

	public function __construct(){

		if($this->onBeforeLaunch == null)
			$this->onBeforeLaunch = 'function(_dialog){ return true; }';
		if(!($this->onBeforeLaunch instanceof CJavaScriptExpression))
				$this->onBeforeLaunch = new CJavaScriptExpression(
					$this->onBeforeLaunch);

		// file_ids:  is an array of selected file_id in this form:
		//	[{ file_id: the_id , url: the_url }, ... ]
		if($this->onBeforeAction == null)
			$this->onBeforeAction = 'function(viewer,action, file_ids){ return true; }';
		if(!($this->onBeforeAction instanceof CJavaScriptExpression))
				$this->onBeforeAction = new CJavaScriptExpression(
					$this->onBeforeAction);

		// file_ids:  is an array of selected file_id in this form:
		//	[{ file_id: the_id , url: the_url }, ... ]
		if($this->onAfterAction == null)
			$this->onAfterAction = 'function(viewer,action, file_ids,ok,response){  }';
		if(!($this->onAfterAction instanceof CJavaScriptExpression))
				$this->onAfterAction = new CJavaScriptExpression(
					$this->onAfterAction);

		if($this->onClientSideUploaderError == null)
			$this->onClientSideUploaderError = 
				"function(messages){ var str=''; $(messages).each("
					."function(i,m){ str += m; str += '\\n'; }); alert(str); }";
		if(!($this->onClientSideUploaderError instanceof CJavaScriptExpression))
				$this->onClientSideUploaderError = new CJavaScriptExpression(
					$this->onClientSideUploaderError);

		if($this->onClientUploaderProgress == null)
			$this->onClientUploaderProgress = 
				"function(status, progress){  }";
		if(!($this->onClientUploaderProgress instanceof CJavaScriptExpression))
				$this->onClientUploaderProgress = new CJavaScriptExpression(
					$this->onClientUploaderProgress);
	}

	public function init(){
		parent::init();
	}

	private function _getActionPath(){
		$data=$this->yiifileman_data();
		$controller=$this->_default_controller;
		$action=$this->_default_action;
		if(isset($data['controller']))
			$controller = $data['controller'];
		if(isset($data['action']))
			$action = $data['action'];
		return rtrim($controller,'/')."/".ltrim($action);
	}

	public function run(){
		$this->_prepareAssets();
		extract($this->yiifileman_data());

		$options = CJavaScript::encode(array(
			'ajax_handler'=>CHtml::normalizeUrl(array($this->_getActionPath(),
				"class"=>$this->yiifileman_classname(),
					"method"=>"ajax_query")),
			'ajax_file_uploader_handler'=>CHtml::normalizeUrl(array($this->_getActionPath(),
				"class"=>$this->yiifileman_classname(),
					"method"=>"ajax_file_upload")),
			'dialog_mode' => ($this->launch_selector != ''),
			'allow_multiple_selection'=>$allow_multiple_selection,
			'allow_rename_files'=>$allow_rename_files,
			'allow_delete_files'=>$allow_delete_files,
			'allow_file_uploads'=>$allow_file_uploads,
			'file_uploaders_count'=>$this->file_uploaders,
			'body_selector'=>'.body',
			'ok_button_selector' => '.ok_button',
			'cancel_button_selector' => '.cancel_button',
			'delete_button_selector' => '.delete_button',
			'uploader_selector' => $this->uploader_selector,
			'delete_confirm_message'=>$this->delete_confirm_message,
			'select_confirm_message'=>$this->select_confirm_message,
			'no_selection_message'=>$this->no_selection_message,
			'upload_file_button_text' => $this->upload_file_button_text,
			'onBeforeAction'=>new CJavaScriptExpression($this->onBeforeAction),
			'onAfterAction'=>new CJavaScriptExpression($this->onAfterAction),
			'onClientSideUploaderError'=>new CJavaScriptExpression($this->onClientSideUploaderError),
			'onClientUploaderProgress'=>new CJavaScriptExpression($this->onClientUploaderProgress),
		));

		// code when the window must be launched because a onClick event
		//	mode popup
		if($this->launch_selector != '')
		Yii::app()->getClientScript()->registerScript(
		"yiifilemanagerfilepicker_script_id",
"
	$('{$this->list_selector}').hide();
	$('{$this->launch_selector}').click(function(){
		$('{$this->list_selector}').addClass('yiifileman-dialog');
		var _fn = {$this->onBeforeLaunch};
		_fn($('{$this->list_selector}'));
		$('{$this->list_selector}').yiiFileManagerFilePickerViewer_update();
	});
	$('{$this->list_selector}').yiiFileManagerFilePickerViewer_init({$options});
",CClientScript::POS_LOAD);
	
		// code when no launch selector is available
		//  direct window mode
		if($this->launch_selector == '')
		Yii::app()->getClientScript()->registerScript(
		"yiifilemanagerfilepicker_script_id",
"
	$('{$this->list_selector}').show();
	$('{$this->list_selector}').yiiFileManagerFilePickerViewer_init({$options});
",CClientScript::POS_LOAD);


	}// end run()

	public function _prepareAssets(){
		$localAssetsDir = dirname(__FILE__) . '/assets';
		$this->_baseUrl = Yii::app()->getAssetManager()->publish(
				$localAssetsDir);
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
		foreach(scandir($localAssetsDir) as $f){
			$_f = strtolower($f);
			if(strstr($_f,".swp"))
				continue;
			if(strstr($_f,".js"))
				$cs->registerScriptFile($this->_baseUrl."/".$_f);
			if(strstr($_f,".css"))
				$cs->registerCssFile($this->_baseUrl."/".$_f);
		}
	}

	public function yiifileman_get_mime_type($local_path){
		// YOU SHOULD USE finfo INSTEAD OF mime_content_type. 
		//	mime_content_type is used here for php compatibility
		//	dont change here...! perform the change in your own derivated class
   		return mime_content_type($local_path);
   	}

	// user overridable
	public function yiifileman_get_image_substitution($file_info, $local_path, $mimetype){
		// try to check if it is an image
		$handle = @imagecreatefromstring(file_get_contents($local_path));
		if($handle != false){
			imagedestroy($handle);
			// yes it is an image..
			return $local_path; // the same image
		}else{
			// a stupid text/data file, so it requires an image substitution.
			return rtrim(dirname(__FILE__))."/not-an-image.jpg";
		}
	}

	public function yiifileman_output_file($file_info, $local_path, $mimetype,$output_size){
		// local_path can be an image file, or a data file, in the first case (image file)
		//	we can easily output this file as image, as is.  
		//  in case of data files a substitution imagen must be used in replace
		header('Content-type: '.$mimetype);
		$image_local_path = $this->yiifileman_get_image_substitution(
				$file_info, $local_path, $mimetype);
		if($output_size != null){
			$imgres = new YiiFilemanImageResizer();
			list($ow, $oh) = getimagesize($image_local_path);
			$f = fopen($image_local_path,"r");
			$newImage = $imgres->resize(fread($f,filesize($image_local_path)), 
				$output_size[0], $output_size[1], 70, $ow, $oh);
			fclose($f);
			imagepng($newImage);
			imagedestroy($newImage);
		}else
		echo file_get_contents($image_local_path);	
	}

	public function runAction($method){
		// called by the YiiFileManagerFilePickerAction
		//
		if($method == 'ajax_query'){
			header("Content-type: application/json");
			echo json_encode($this->_ajax_response($_POST));
			return;
		}
		// is the file uploader handler ?
		//
		$n=0;
		if($method == 'ajax_file_upload'){
			foreach($_FILES as $filepost){
				Yii::log(__METHOD__."\n_FILES[".$n."]:\n"
					.json_encode($filepost)."\nend\n","yiifilemanagerfilepicker");
				$this->yiifileman_on_uploaded_file($filepost);
			}
			$n++;
		}
		// none..
		$size = isset($_GET['size']) ? $_GET['size'] : "gallery";
		if($method == 'viewer')
			$this->yiifileman_viewer($_GET['file_id'], $size);
	}

	private function _ajax_response($post){
		$giveme=null;
		$action=null;
		if(isset($post['rename'])){
			// 	'file_id'  	the file to be renamed
			//	'name'		the new name for the given file_id
			return $this->yiifileman_do_rename_file($post['file_id'],$post['name']);
		}else
		if(isset($post['action'])){
			// actions: "select" or "delete", 
			//	both receiving an array of selected file_id
			$action = $post['action'];
			$file_ids = $post['file_ids'];
			// the js code waits for true(close dialogs) or false(do nothing)
			return $this->yiifileman_on_action($action, $file_ids);
		}else
		if(isset($post['canupload'])){
			return $this->yiifileman_on_pre_uploaded_file($post);
		}
		else{
			if(isset($post['giveme']))
				$giveme = $post['giveme'];
			if($giveme=='list_files')
				return $this->ajax_list_files($post);
		}
		return array();
	}
	
	public function build_file_viewer_url($file_id){
		return CHtml::normalizeUrl(array($this->_getActionPath(),
			"class"=>$this->yiifileman_classname(),
			"method"=>"viewer",
			"size"=>"gallery",
			"file_id"=>$file_id)
		);	
	}

	// if the developper does not provide this method then we
	//	return the same list, unfiltered.
	public function yiifileman_filter_file_list($list, $extra=array()){
		return $list;
	}

	public function ajax_list_files($post){
		extract($this->yiifileman_data());
		$ar=array();
		foreach($this->yiifileman_filter_file_list(
				$fileman->list_files($identity, $post), $post) as $fileinfo){
			// we must return an URL pointing to this same service
			$file_id = $fileinfo['file_id'];
				$ar[$file_id] = array('url'=>$this->build_file_viewer_url($file_id),
						'filename'=>$fileinfo['filename'],'file_id'=>$file_id);
		}
		return $ar;
	}

	// size: "gallery"(use the provided gallery_size data entry argument) or "full" for full size
	public function yiifileman_viewer($file_id, $size) {
		extract($this->yiifileman_data());
		if(!$fileman->can_read($identity, $file_id)){
			echo "[access denied]";
		}else{
			// gallery size:
			$output_size=null;
			if($size=='gallery')
				$output_size = $gallery_size;
			if($size=='full')
				$output_size = null;
			//
			$file_info = $fileman->get_file_info($identity, $file_id);
			$local_path = $fileman->get_file_path($identity, $file_id);
			$mimetype = $this->yiifileman_get_mime_type($local_path);
			if($mimetype){
				$this->yiifileman_output_file(
						$file_info, $local_path, $mimetype, $output_size);
			}else{
				echo "[the given file content is not allowed]";
			}
		}
	}

	protected function yiifileman_do_rename_file($file_id,$name){
		extract($this->yiifileman_data());
		if($allow_rename_files != true)
			return false;
		if(!$fileman->can_read($identity, $file_id)){
			throw new Exception("ACCESS DENIED");
		}else{
			if(true==$fileman->rename_file($identity, $file_id, $name)){
				return true;
			}else{
				throw new Exception("can't rename file_id [".$file_id."] to new name [".$name."]");
			}
		}
	}

	/**
		the action (select or delete) to be performed on a file_id set (array of file_id)
		
	 	@return bool true: the js component close the dialog (hide), or false: do nothing
	 */
	protected function yiifileman_on_action($action, $file_ids){
		extract($this->yiifileman_data());
		if($action == 'select')
			return true;
		if(($action == 'delete') && ($allow_delete_files==true)){
			//the remove_files method will remove only files if this files 
			// belongs to the same provided $identity
			return $fileman->remove_files($identity, $file_ids); // return the removal counter
		}
		else
		return false;	
	}

	/**
	 	this method is called when:
			first:	
				when a browser query to check if a selected file can be uploaded 
				(yiifileman_on_pre_uploaded_file)
			next:
				when a browse send the files via ajax to the server
				a server-side request (yiifileman_on_uploaded_file)
	 */
	public function yiifileman_accept_file($filename,$filesize,$mimetype,
			$is_server_side,&$reason){
		extract($this->yiifileman_data());
		$reason = '';
		return true;
	}

	public function yiifileman_on_uploaded_file($filepost){
		extract($this->yiifileman_data());
		extract($filepost); // $name, $type, $tmp_name, $error, $size
		$reason='';
		if(!$this->yiifileman_accept_file($name, $size, $type,true, $reason))
			return;
		$file_ids = $fileman->add_files($identity, $tmp_name);
		foreach($file_ids as $file_id){
			//only one file arrives here, but add_files method is always returning an array
			$fileman->rename_file($identity, $file_id, $name);
			$this->yiifileman_on_file_saved($file_id);
		}
		//sleep(3);
	}

	public function yiifileman_on_pre_uploaded_file($post){
		extract($this->yiifileman_data());
		extract($post); // filename, filesize, filemimetype
		$reason='';
		if(!$this->yiifileman_accept_file($filename, $filesize, $filemimetype,
				false, $reason))
			return array('result'=>false,'reason'=>$reason);
		return array('result'=>true);
	}

	// user must override it
	public function yiifileman_on_file_saved($file_id){
	
	}
}
