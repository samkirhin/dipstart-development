<?php
class Tools {
	static public function inlineEdit($data, $field, $type='text') {
		return '<div class="inlineEdit" id="' . $data['id'] . '" field="'.$field.'" type="'.$type.'">' . $data[$field] . '</div>';
	}
	static public function saveUploadedFile($fileupload, $dir, $old_file = '') {
		//print_r($fileupload);
		//Yii::app()->end();
        if ($fileupload instanceof CUploadedFile) {
            $mainName = $newName = STranslate::transliter($fileupload->getName());
            $i = 1;
            while (file_exists($dir . '/' . $newName)) {
                $parts = explode('.', $mainName);
                $countParts = count($parts);
                if ($countParts > 1) {
                    unset($parts[$countParts - 1]);
                    $newName = implode($parts) . '(' . $i . ').' . $fileupload->extensionName;
                } else {
                    $newName = '(' . $i . ')' . $mainName;
                }
                $i++;
            }
			if (!file_exists($dir)) mkdir($dir,0755,true);
            $fileupload->saveAs($dir . '/' . $newName);
			
            //$this->file = $newName;
            if (!empty($old_file)) {
                $delete = $dir . '/' . $old_file;
                if (file_exists($delete)) {
                    unlink($delete);
                }
            }
        }
        if (empty($newName) && !empty($old_file)) {
            $newName = $old_file;
        }
		return $newName;
	}
	static public function uploadMaterials($folder) {
		Yii::import("ext.EAjaxUpload.qqFileUploader");
		if (!file_exists($folder)) {
			mkdir($folder, 0777);
		}
		$config['allowedExtensions'] = array('png', 'jpg', 'jpeg', 'gif', 'txt', 'doc', 'docx');
		$config['disAllowedExtensions'] = array("exe");
		$sizeLimit = 50 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($config, $sizeLimit);
		if(!(User::model()->isManager())) $_GET['qqfile']='#pre#'.$_GET['qqfile'];
		$result = $uploader->handleUpload($folder,true);
		$result['fileSize']=filesize($folder.$result['filename']);//GETTING FILE SIZE
		$result['fileName']=$result['filename'];//GETTING FILE NAME
		chmod($folder.$result['fileName'],0666);
		return $result;
	}
}
?>