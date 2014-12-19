<?php
interface IYiiFileManagerFilePicker {
	// pure abstract, developper must declare
	public function yiifileman_classname();
	public function yiifileman_data();
	// base class provides default implementation
	public function yiifileman_get_mime_type($local_path);
	public function yiifileman_output_file($file_info, $local_path, $mimetype, $output_size);
	public function yiifileman_viewer($file_id, $size);
	public function yiifileman_get_image_substitution($file_info, $local_path, $mimetype);
	public function yiifileman_filter_file_list($list, $extra=array());
	public function yiifileman_on_action($action, $file_ids);
	public function yiifileman_on_uploaded_file($filepost);
	public function yiifileman_on_file_saved($file_id);
	public function yiifileman_accept_file($filename,$filesize,$mimetype,$is_server_side,&$reason);
}
