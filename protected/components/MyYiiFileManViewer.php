<?php
/**
 	
 */
class MyYiiFileManViewer 
	extends YiiFileManagerFilePicker
		implements IYiiFileManagerFilePicker
{
	/**
	 	must be defined as:
			return __CLASS_;
	 */
	public function yiifileman_classname(){
		return __CLASS__;
	}

	/**
	  	provides information to the base system and to the jquery widget.

		return array(
			'gallery_size'=>array(160,120),		// size x,y (px) for gallery
												// images are automatically
												// resized to feet this size
												// without altering the orig.

    		'identity'=>Yii::app()->user->id,	// the Identity (file's owner)
    		'fileman'=>Yii::app()->fileman,		// the file manager

			'allow_multiple_selection'=>true,	// various boolean flags passed
			'allow_rename_files'=>true,			// to the jquery widget object.
			'allow_delete_files'=>true,			//
			'allow_file_uploads'=>true,			//
    	);	

		@returns array indexed array (key=>value)
	 */
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

            'controller'=>'/project/zakaz',
            'action'=>'yiifilemanagerfilepicker',

    	);
	}

	/**
		customize the URL presented to the browser.

		example:
		You have an .htaccess rule:
		RewriteRule ^viewfile/(.*)$ 
				index.php?r=/site/yiifilemanagerfilepicker/
					&class=MyFileManViewer&method=viewer&file_id=$1

		@param string $file_id the file identificator
		@returns string "http://mywebsite.com/viewfile/".$file_id;
	*/
	public function build_file_viewer_url($file_id){
		return parent::build_file_viewer_url($file_id);
	}

	/**
	 	filtering items prior to send back to the browser viewer.  you are
		required to select which items ($list is an array of items) must be
		retrieved to the browser based on your own rules.

		-example1: scanning files from the $list argument.
			foreach($list as $fileinfo)
				echo "REAL LOCAL PATH IS:"
					.Yii::app()->fileman->get_file_path(
						$identity, $fileinfo['file_id']);

		-example2: find out the mimetype for a given file using this class.
			$full_local_path = Yii::app()->fileman->get_file_path(
				$identity, $fileinfo['file_id']);
			$mimetype = $this->yiifileman_get_mime_type($full_local_path);

		@param array $list Array of FILEINFO (see also YiiFilemanManager::list_files)
		@return array of FILEINFO
	 */
	public function yiifileman_filter_file_list($list, $extra=array()){
        return $list;
	}

	/**
	 	use this method to retrieve the image substitution for a given file. this image
		will be used as the image miniature in the gallery front, and will be resized
		to the size specified in yiifileman_data (gallery_size).

		commonly, image files use their own thumbnail. non-image files requires
		a substitution image, provided in the default implementation.

		@param array $file_info (see also YiiFilemanManager::list_files)
		@param string $local_path (helper value)
		@param string $mimetype the detected mimetype
		@returns string the image local path.
	 */
	public function yiifileman_get_image_substitution($file_info, $local_path, $mimetype){
		return parent::yiifileman_get_image_substitution($file_info, $local_path, $mimetype);
	}

	/**
	 	do something in your own system whenever a 'select' or 'delete' action occurs.
			
		this error (if happens) can be shown in client side by implementing the
		JS event handler: onAfterAction checking for argument 'response', it
		will contain the value returned here and the dialog box will not close
		until you return exactly: true (without quotes).

	 	@param string $action 'select' or 'delete'
		@param array $file_ids array of file_id numbers
		@returns bool true or the error string. see more about in issue #4.
	 */
	public function yiifileman_on_action($action, $file_ids){
		/*
	    sample implementation:
		if($action == 'select'){
			extract($this->yiifileman_data());
			$error="";
			foreach($file_ids as $file_id){
				$csv = $fileman->get_file_path($identity, $file_id);
				if(true == Yii::app()->anyapi->validatePaymentsFile($csv,$error)){
					//ok continue next file
				}else{
					return "please fix errors: ".$error;
				}
			}
		}
		*/
		// call parent to perform default stuff
		return parent::yiifileman_on_action($action, $file_ids);
	}

	/**	called whenever a new file arrives to the server (is_server_side true) 
	  or when a browser ask if a file can be sent to the server (is_server_side false),
	  in this case expose your $reason to reject the file.

	  	example:

			if(false==_my_own_space_checker(Yii::app()->user->id, $filesize)){
				$reason="size exceded, file too large.";
				return false;
			}elseif(false==_my_mimetype_allowed(Yii::app()->user->id, $mimetype)){
				$reason="file type not supported";
				return false;
			}else
			return true;

		security:
			
			the provided arguments must have different sources: 
			when $is_server_side is TRUE then it is a safe source because are 
			detected by you, otherwise the data is detected by Browser(unsafe).

			when $is_server_side is FALSE, then it means that the request is a 
			query sent by the browser to continue or not with the upload.
	 
		@param string $filename the filename detected by the browser
		@param numerical $filesize the size in bytes
		@param string $mimetype The detected mimetype
		@param bool $is_server_side TRUE if the request is performed after file arrives.
		@param string $reason (OUTPUT) specify here the reject reason, it will be send back to browser.
		@returns bool true to accept the file, otherwise use $reason if $is_server_side is false
	*/
	public function yiifileman_accept_file($filename,$filesize, $mimetype,
		$is_server_side, &$reason){
        if(false==$this->_my_own_space_checker(Yii::app()->user->id, $filesize)){
            $reason="size exceded, file too large.";
            return false;
		}elseif(false==$this->_my_mimetype_allowed(Yii::app()->user->id, $filename)){
            $reason="file type not supported";
            return false;
		}else
			return true;
	}

	/**
	 	called whenever a file is saved into your system. the fil_id here represent the stored file

		@param string $file_id the ID of the saved file, you must handle it using your filemanager component
		@returns void
	 */
	public function yiifileman_on_file_saved($file_id){
		extract($this->yiifileman_data());
		$the_local_path = $fileman->get_file_path($identity, $file_id);
	}

    public function _my_own_space_checker($user_id, $filesize) {
       if ($filesize > 3000000)
        return false;
       else
        return true;
    }
    public function _my_mimetype_allowed($user_id, $filename) {

      $ext =  CFileHelper::getExtension($filename);

      $mime_types = array(
    	// Image formats
    	'jpg'                          => 'image/jpeg',
        'jpeg'                         => 'image/jpeg',
    	'gif'                          => 'image/gif',
    	'png'                          => 'image/png',
    	'bmp'                          => 'image/bmp',
    	'tif|tiff'                     => 'image/tiff',
    	'ico'                          => 'image/x-icon',

    	// Video formats
    	'asf|asx'                      => 'video/x-ms-asf',
    	'wmv'                          => 'video/x-ms-wmv',
    	'wmx'                          => 'video/x-ms-wmx',
    	'wm'                           => 'video/x-ms-wm',
    	'avi'                          => 'video/avi',
    	'divx'                         => 'video/divx',
    	'flv'                          => 'video/x-flv',
    	'mov|qt'                       => 'video/quicktime',
    	'mpeg|mpg|mpe'                 => 'video/mpeg',
    	'mp4|m4v'                      => 'video/mp4',
    	'ogv'                          => 'video/ogg',
    	'webm'                         => 'video/webm',
    	'mkv'                          => 'video/x-matroska',

    	// Text formats
    	'txt|asc|c|cc|h'               => 'text/plain',
    	'csv'                          => 'text/csv',
    	'tsv'                          => 'text/tab-separated-values',
    	'ics'                          => 'text/calendar',
    	'rtx'                          => 'text/richtext',
    	'css'                          => 'text/css',
        'sql'                          => 'text/sql',
    	'htm|html'                     => 'text/html',

    	// Audio formats
    	'mp3|m4a|m4b'                  => 'audio/mpeg',
    	'ra|ram'                       => 'audio/x-realaudio',
    	'wav'                          => 'audio/wav',
    	'ogg|oga'                      => 'audio/ogg',
    	'mid|midi'                     => 'audio/midi',
    	'wma'                          => 'audio/x-ms-wma',
    	'wax'                          => 'audio/x-ms-wax',
    	'mka'                          => 'audio/x-matroska',

    	// Misc application formats
    	'rtf'                          => 'application/rtf',
    	'js'                           => 'application/javascript',
    	'pdf'                          => 'application/pdf',
    	'swf'                          => 'application/x-shockwave-flash',
    	'tar'                          => 'application/x-tar',
    	'zip'                          => 'application/zip',
    	'gz|gzip'                      => 'application/x-gzip',
    	'rar'                          => 'application/rar',
    	'7z'                           => 'application/x-7z-compressed',
    	'exe'                          => 'application/x-msdownload',

    	// MS Office formats
    	'doc'                          => 'application/msword',
    	'pot|pps|ppt'                  => 'application/vnd.ms-powerpoint',
    	'wri'                          => 'application/vnd.ms-write',
    	'xla|xls|xlt|xlw'              => 'application/vnd.ms-excel',
    	'mdb'                          => 'application/vnd.ms-access',
    	'mpp'                          => 'application/vnd.ms-project',
    	'docx'                         => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    	'docm'                         => 'application/vnd.ms-word.document.macroEnabled.12',
    	'dotx'                         => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
    	'dotm'                         => 'application/vnd.ms-word.template.macroEnabled.12',
    	'xlsx'                         => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    	'xlsm'                         => 'application/vnd.ms-excel.sheet.macroEnabled.12',
    	'xlsb'                         => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
    	'xltx'                         => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
    	'xltm'                         => 'application/vnd.ms-excel.template.macroEnabled.12',
    	'xlam'                         => 'application/vnd.ms-excel.addin.macroEnabled.12',
    	'pptx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    	'pptm'                         => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
    	'ppsx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
    	'ppsm'                         => 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
    	'potx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.template',
    	'potm'                         => 'application/vnd.ms-powerpoint.template.macroEnabled.12',
    	'ppam'                         => 'application/vnd.ms-powerpoint.addin.macroEnabled.12',
    	'sldx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
    	'sldm'                         => 'application/vnd.ms-powerpoint.slide.macroEnabled.12',
    	'onetoc|onetoc2|onetmp|onepkg' => 'application/onenote',

    	// OpenOffice formats
    	'odt'                          => 'application/vnd.oasis.opendocument.text',
    	'odp'                          => 'application/vnd.oasis.opendocument.presentation',
    	'ods'                          => 'application/vnd.oasis.opendocument.spreadsheet',
    	'o dg'                          => 'application/vnd.oasis.opendocument.graphics',
    	'odc'                          => 'application/vnd.oasis.opendocument.chart',
    	'odb'                          => 'application/vnd.oasis.opendocument.database',
    	'odf'                          => 'application/vnd.oasis.opendocument.formula',

    	// WordPerfect formats
    	'wp|wpd'                       => 'application/wordperfect',

    	// iWork formats
    	'key'                          => 'application/vnd.apple.keynote',
    	'numbers'                      => 'application/vnd.apple.numbers',
    	'pages'                        => 'application/vnd.apple.pages',
        );

            if (array_key_exists($ext, $mime_types) !== false)
                return true;
            else
                return false;


    }
}
