<?php
class MyYiiFileManViewer
	extends YiiFileManagerFilePicker
		implements IYiiFileManagerFilePicker
{
	public function yiifileman_classname(){
		return __CLASS__;
	}

	public function yiifileman_data(){
		return array(
			'gallery_size'=>array(100,70),
			'identity'=>Yii::app()->session['project_id'],
			'fileman'=>Yii::app()->fileman,
			'allow_multiple_selection'=>true,
			'allow_rename_files'=>true,
			'allow_delete_files'=>true,
			'allow_file_uploads'=>true,

			//optional, only change if you're not using default siteController
			//for holding the required static action (see README).

			'controller'=>'/site',
			'action'=>'yiifilemanagerfilepicker',

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

	public function yiifileman_on_action($fileaction, $file_ids){
		return parent::yiifileman_on_action($fileaction, $file_ids);
	}

	public function yiifileman_accept_file($filename,$filesize, $mimetype,
		$is_server_side, &$reason){
		if(false==$this->_my_own_space_checker(Yii::app()->user->id, $filesize)){
			$reason="size exceded, file too large.";
			return false;
		}/*elseif(false==$this->_my_mimetype_allowed($filename)){
			$reason="file type not supported";
			return false;
		}*/else
			return true;
	}

	public function yiifileman_on_file_saved($file_id){
		extract($this->yiifileman_data());
		$the_local_path = $fileman->get_file_path($identity, $file_id);
	}

	public function _my_own_space_checker($user_id, $filesize) {
	   if ($filesize > 30000000)
		return false;
	   else
		return true;
	}
	public function _my_mimetype_allowed($filename) {

		$ext =  CFileHelper::getExtension($filename);
		if (array_key_exists($ext, $this->mime_types) !== false)
			return $this->mime_types[$ext][0];
		else
			return false;
	}
}
