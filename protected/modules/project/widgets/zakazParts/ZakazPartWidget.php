<?php

class ZakazPartWidget extends CWidget{
    
    public $projectId;
    public $arrDataProvider;
	public static $folder;

    public function init() {
		// --- campaign
		$c_id = Campaign::getId();
		if ($c_id) {
			$folder = '/uploads/c'.$c_id.'/parts/';
		}else{
			$folder = '/uploads/additions/';
		}
		// ---
        $this->arrDataProvider = new CArrayDataProvider(
            ZakazParts::model()->with('files')->findAllByAttributes(['proj_id'=>$this->projectId])
        );
		if (!file_exists(Yii::getPathOfAlias('webroot').$folder)){
			mkdir(Yii::getPathOfAlias('webroot').$folder, 0777);
		}
		if (!file_exists(Yii::getPathOfAlias('webroot').$folder.'temp/')){
			mkdir(Yii::getPathOfAlias('webroot').$folder.'temp/', 0777);
		}
        if (!User::model()->isCustomer()) foreach (array_diff(scandir(Yii::getPathOfAlias('webroot').$folder.'temp/'), array('..', '.')) as $k => $v)
            $temps[array_reverse(str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_'))[0]][$k]=array(
                'id'=>0,
                'part_id'=>array_reverse(str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_'))[0],
                'orig_name'=>implode('_',array_slice(str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_'),0,-1)).'.'.pathinfo($v,PATHINFO_EXTENSION),
                'file_name'=>Yii::app()->baseUrl.$folder.'temp/'.$v,
                'comment'=>0,
				'for_approved'=>'Must approved',
            );
        $tempdata = $this->arrDataProvider->getData();
        foreach ($tempdata as $k=>$v){
            if (isset($tempdata[$k]->files)) foreach ($tempdata[$k]->files as $fk=>$fv)
                $tempdata[$k]->files[$fk]->file_name=Yii::app()->baseUrl.$folder.$fv->part_id.'/'.$fv->file_name;
            if (isset($temps[$v->id])) $tempdata[$k]->files=array_merge($v->files,$temps[$v->id]);
        }
        $this->arrDataProvider->setData($tempdata);
    }

    public function run() {
        /*$this->widget('zii.widgets.CListView', array(
            'dataProvider' => $this->arrDataProvider,
            'itemView'=>'newview',
            'summaryText'=>'',
        ));*/
		$data = $this->arrDataProvider->getData();
		foreach ($data as $item)
		$this->render('newview', $item);
    }
}
