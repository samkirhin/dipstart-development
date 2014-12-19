<?php
 /**
 * YiiFileManagerFilePickerAction class file.
 *
 *	@example:

 		public function actions() { 
 			return array(
 			'yiifilemanagerfilepicker'=>
				array('class'=>
					'ext.yiifileman-filepicker.YiiFileManagerFilePickerAction'),
			); 
 		}

 *
 * @author Christian Salazar <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
include_once(dirname(__FILE__).'/YiiFileManagerFilePicker.php');
class YiiFileManagerFilePickerAction extends CAction {
	public function run(){
		$method  = $_GET['method'];
		$className = $_GET['class'];
		Yii::log(__METHOD__.
			sprintf("[ACTION CALLED][class][%s][method][%s]",
				$className,$method),'yiifilemanagerfilepicker');
		$inst = new $className();
		$inst->runAction($method);
	}
 }

